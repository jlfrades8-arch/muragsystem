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

        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        return view('admin-feedbacks', compact('feedbacks'));
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

        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        $feedback = Feedback::find($id);
        if (!$feedback) {
            return redirect()->route('admin.feedbacks')->with('error', 'Feedback not found.');
        }

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
}
