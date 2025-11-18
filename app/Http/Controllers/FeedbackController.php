<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\FeedbackReply;
use App\Models\User;

class FeedbackController extends Controller
{
    // Show public feedback form (users or guests)
    public function create()
    {
        return view('feedback.create');
    }

    // Store feedback
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        $userId = session('user_id') ?? null;
        $user = $userId ? User::find($userId) : null;

        // Use logged-in user's data if available, otherwise use form input or default to Guest
        $name = $user?->name ?? $request->input('name', 'Guest');
        $email = $user?->email ?? $request->input('email', '');

        $feedback = Feedback::create([
            'user_id' => $userId,
            'name' => $name,
            'email' => $email,
            'message' => $request->input('message'),
            'status' => 'open',
        ]);

        // allow the submitting user (including guests) to view their feedback immediately
        session([
            'last_feedback_id' => $feedback->id,
            'last_feedback_email' => $feedback->email,
        ]);

        return redirect()->route('feedback.show', $feedback->id)->with('success', 'Thank you for your feedback!');
    }

    // Admin: list feedbacks
    public function index()
    {
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Get admin user IDs and emails
        $adminUsers = User::where('role', 'admin')->pluck('id');
        $adminEmails = User::where('role', 'admin')->pluck('email');

        // Get admin feedback (shown at top)
        $adminFeedbacks = Feedback::where(function ($query) use ($adminUsers, $adminEmails) {
            $query->whereIn('user_id', $adminUsers)
                ->orWhereIn('email', $adminEmails);
        })
            ->orderBy('created_at', 'desc')
            ->get();

        // Get user feedback (main list)
        $feedbacks = Feedback::whereNotIn('user_id', $adminUsers)
            ->where(function ($query) use ($adminUsers) {
                // Also exclude feedback where email belongs to an admin
                $adminEmails = User::where('role', 'admin')->pluck('email');
                $query->whereNotIn('email', $adminEmails);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin-feedbacks', compact('feedbacks', 'adminFeedbacks'));
    }

    // User: list all feedbacks (public view for all users)
    public function userIndex()
    {
        // Show all feedbacks ordered by newest first
        $feedbacks = Feedback::with('replies')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('feedback.index', compact('feedbacks'));
    }

    // User: list only my feedbacks
    public function myFeedbacks()
    {
        $userId = session('user_id');
        $userEmail = session('user_email');

        $query = Feedback::with('replies');
        if ($userId) {
            $query->where('user_id', $userId);
        } elseif ($userEmail) {
            $query->where('email', $userEmail);
        } else {
            // Not logged in - show empty collection
            $feedbacks = collect();
            return view('feedback.my', compact('feedbacks'));
        }

        $feedbacks = $query->orderBy('created_at', 'desc')->get();
        return view('feedback.my', compact('feedbacks'));
    }

    // Admin: view feedback detail with replies
    public function show($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return redirect()->route('dashboard')->with('error', 'Feedback not found.');
        }

        $replies = $feedback->replies()->orderBy('created_at', 'asc')->get();

        // Admin can view any feedback
        if (session('role') === 'admin') {
            // Mark feedback as viewed by admin
            if (!$feedback->viewed_at) {
                $feedback->update(['viewed_at' => now()]);
            }
            return view('admin-feedback-detail', compact('feedback', 'replies'));
        }

        // All users can view any feedback (public view)
        return view('feedback.show', compact('feedback', 'replies'));
    }

    // Admin: store reply to feedback
    public function storeReply(Request $request, $id)
    {
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $feedback = Feedback::find($id);
        if (!$feedback) {
            return redirect()->route('admin.feedbacks')->with('error', 'Feedback not found.');
        }

        // Prevent admins from replying to their own feedback
        if ($feedback->user_id === session('user_id') || $feedback->email === session('user_email')) {
            return redirect()->back()->with('error', 'You cannot reply to your own feedback.');
        }

        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        FeedbackReply::create([
            'feedback_id' => $feedback->id,
            'admin_id' => session('user_id'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Reply sent!');
    }

    // Admin: close feedback
    public function close($id)
    {
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $fb = Feedback::find($id);
        if (!$fb) {
            return redirect()->route('admin.feedbacks')->with('error', 'Feedback not found.');
        }

        $fb->update(['status' => 'closed']);
        return redirect()->route('admin.feedbacks')->with('success', 'Feedback closed.');
    }

    // Admin: delete feedback
    public function destroy($id)
    {
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $feedback = Feedback::find($id);
        if (!$feedback) {
            return redirect()->back()->with('error', 'Feedback not found.');
        }

        // Delete associated replies first
        FeedbackReply::where('feedback_id', $feedback->id)->delete();
        
        // Delete the feedback
        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }
}
