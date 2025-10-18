<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Dashboard') - Pet Adoption System</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @stack('styles')
</head>

<body class="bg-gray-50">
  <div class="min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 text-white transform transition-all duration-300 ease-in-out shadow-2xl -translate-x-full lg:translate-x-0 flex flex-col">
      <!-- Decorative Background Pattern -->
      <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-40 h-40 bg-pink-500 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 bg-purple-500 rounded-full filter blur-3xl"></div>
      </div>

      <!-- Logo Section -->
      <div class="relative flex items-center justify-between h-20 px-6 bg-gradient-to-r from-purple-950/50 to-pink-950/50 backdrop-blur-sm border-b border-white/10">
        <div class="flex items-center space-x-4">
          <div class="relative">
            <div class="w-12 h-12 bg-gradient-to-br from-pink-400 via-purple-400 to-indigo-400 rounded-xl flex items-center justify-center shadow-lg transform hover:scale-110 transition-transform duration-300">
              <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </div>
            <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white animate-pulse"></div>
          </div>
          <div>
            <h1 class="text-xl font-bold bg-gradient-to-r from-white to-pink-200 bg-clip-text text-transparent">Pet Rescue</h1>
            <p class="text-xs text-purple-200">{{ session('role') === 'admin' ? 'Admin Dashboard' : 'User Dashboard' }}</p>
          </div>
        </div>
        <button id="closeSidebar" class="lg:hidden text-white/70 hover:text-white hover:bg-white/10 p-2 rounded-lg transition-all duration-200">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="relative flex-1 mt-1 px-3 overflow-hidden">
        <!-- Main Navigation -->
        <div class="mb-0.5">
          <div class="mb-0.5 px-3">
            <p class="text-xs font-bold text-purple-300 uppercase tracking-widest flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
              </svg>
              Main Menu
            </p>
          </div>
          <div>
            <a href="{{ route('dashboard') }}" class="sidebar-link group {{ request()->routeIs('dashboard') || request()->routeIs('user.dashboard') ? 'active' : '' }} mb-1 block">
              <div class="sidebar-icon-wrapper">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
              </div>
              <span class="flex-1">Dashboard</span>
              <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>

            @if(session('role') === 'admin')
            <a href="{{ route('admin.rescue.reports') }}" class="sidebar-link group {{ request()->routeIs('admin.rescue.reports') || request()->routeIs('rescue.show') ? 'active' : '' }} mb-3 block">
              <div class="sidebar-icon-wrapper">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
              <span class="flex-1">Rescue Reports</span>
              <span class="px-2 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full">{{ $pendingCount ?? 0 }}</span>
            </a>

            <a href="{{ route('admin.adoption') }}" class="sidebar-link group {{ request()->routeIs('admin.adoption') ? 'active' : '' }} block">
              <div class="sidebar-icon-wrapper">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
              </div>
              <span class="flex-1">Adoption Management</span>
              <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
            @else
            <a href="{{ route('adoption.list') }}" class="sidebar-link group {{ request()->routeIs('adoption.list') || request()->routeIs('adoption.form') ? 'active' : '' }} mb-3 block">
              <div class="sidebar-icon-wrapper">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
              </div>
              <span class="flex-1">Browse Adoptions</span>
              <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>

            <a href="{{ route('my.adoptions') }}" class="sidebar-link group {{ request()->routeIs('my.adoptions') ? 'active' : '' }} block">
              <div class="sidebar-icon-wrapper">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <span class="flex-1">My Adoptions</span>
              <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
            @endif
          </div>
        </div>

        <!-- Divider -->
        <div class="relative my-2.5">
          <div class="w-full border-t border-white/10"></div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-2">
          <div class="mb-1.5 px-3">
            <p class="text-xs font-bold text-purple-300 uppercase tracking-widest flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
              Quick Actions
            </p>
          </div>
          <div>
            <a href="{{ route('rescue.form') }}" class="sidebar-link group block">
              <div class="sidebar-icon-wrapper bg-gradient-to-br from-green-400 to-emerald-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <span class="flex-1">Report New Rescue</span>
              <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
        <!-- Stats Card (Inside Nav) -->
        <div class="mt-2.5">
          <div class="p-3 bg-gradient-to-br from-white/5 to-white/10 backdrop-blur-sm rounded-lg border border-white/10 transition-all duration-300">
            <div class="flex items-center justify-between mb-1.5">
              <p class="text-sm font-semibold text-purple-200 flex items-center">
                📊 Stats
              </p>
            </div>
            <div class="space-y-1.5">
              @if(session('role') === 'admin')
              <div class="flex items-center justify-between py-1">
                <span class="text-sm text-purple-200">Total</span>
                <span class="text-sm font-bold text-white">{{ isset($pets) ? $pets->count() : 0 }}</span>
              </div>
              <div class="flex items-center justify-between py-1">
                <span class="text-sm text-purple-200">Adopted</span>
                <span class="text-sm font-bold text-green-400">{{ isset($pets) ? $pets->where('status', 'Adopted')->count() : 0 }}</span>
              </div>
              @else
              <div class="flex items-center justify-between py-1">
                <span class="text-sm text-purple-200">Available</span>
                <span class="text-sm font-bold text-white">{{ isset($pets) ? $pets->count() : 0 }}</span>
              </div>
              <div class="flex items-center justify-between py-1">
                <span class="text-sm text-purple-200">My Adoptions</span>
                <span class="text-sm font-bold text-green-400">{{ $adoptionsCount ?? 0 }}</span>
              </div>
              @endif
            </div>
          </div>
        </div>
      </nav>

      <!-- User Info at Bottom -->
      <div class="relative mt-auto p-1.5 bg-gradient-to-r from-purple-950/80 to-pink-950/80 backdrop-blur-sm border-t border-white/10 flex-shrink-0">
        <div class="flex items-center space-x-2 mb-1 p-1.5 bg-white/5 rounded-lg transition-all duration-300">
          <div class="relative">
            <div class="w-7 h-7 bg-gradient-to-br from-purple-400 via-pink-400 to-rose-400 rounded-lg flex items-center justify-center font-bold text-white text-xs shadow-lg">
              {{ strtoupper(substr(session('user_email', 'A'), 0, 1)) }}
            </div>
            <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-purple-950"></div>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-xs font-bold text-white truncate">{{ session('role') === 'admin' ? 'Admin User' : 'User' }}</p>
            <p class="text-xs text-purple-300 truncate">{{ session('user_email', 'user@example.com') }}</p>
          </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center space-x-2 px-3 py-1.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 rounded-lg transition-all duration-300 text-xs font-bold shadow-lg">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-72">
      <!-- Top Navbar -->
      <header class="bg-gradient-to-r from-white via-purple-50 to-pink-50 backdrop-blur-sm shadow-lg border-b border-purple-100 fixed top-0 right-0 left-0 lg:left-72 z-40">
        <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
          <div class="flex items-center space-x-4">
            <!-- Mobile Menu Button -->
            <button id="openSidebar" class="lg:hidden p-2 text-purple-600 hover:text-purple-900 hover:bg-purple-100 rounded-xl transition-all duration-300 transform hover:scale-105">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>

            <!-- Page Title with Icon -->
            <div class="flex items-center space-x-3">
              <div class="hidden sm:flex w-10 h-10 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-xl items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
              </div>
              <div>
                <h1 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-rose-600 bg-clip-text text-transparent">
                  @yield('page-title', 'Dashboard')
                </h1>
                <p class="text-xs sm:text-sm text-gray-600 hidden sm:block">@yield('page-subtitle', 'Manage your pet adoption system')</p>
              </div>
            </div>
          </div>

          <!-- Right Side Actions -->
          <div class="flex items-center space-x-3">
            <!-- Search Button -->
            <button class="hidden md:flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-purple-600 bg-white hover:bg-purple-50 border border-gray-200 hover:border-purple-200 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <span class="text-sm font-medium">Search</span>
            </button>

            <!-- Notifications -->
            <button class="relative p-2.5 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-xl transition-all duration-300 group">
              <svg class="w-6 h-6 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
              </svg>
              <span class="absolute top-1 right-1 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500 border-2 border-white"></span>
              </span>
            </button>

            <!-- User Avatar & Info (Desktop) with Dropdown -->
            <div class="hidden sm:block relative" x-data="{ open: false }">
              <button @click="open = !open" class="flex items-center space-x-3 px-3 py-2 bg-white hover:bg-purple-50 rounded-xl border border-gray-200 hover:border-purple-200 transition-all duration-300 cursor-pointer group shadow-sm hover:shadow-md">
                <div class="relative">
                  <div class="w-9 h-9 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-xl flex items-center justify-center font-bold text-white text-sm shadow-lg transform group-hover:scale-105 transition-transform">
                    {{ strtoupper(substr(session('user_email', 'A'), 0, 1)) }}
                  </div>
                  <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <div class="hidden lg:block">
                  <p class="text-sm font-semibold text-gray-800">{{ session('role') === 'admin' ? 'Admin' : 'User' }}</p>
                  <p class="text-xs text-gray-500">Online</p>
                </div>
                <svg class="w-4 h-4 text-gray-400 hidden lg:block transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              <!-- Dropdown Menu -->
              <div x-show="open"
                @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 py-2 z-50"
                style="display: none;">

                <!-- User Info Header -->
                <div class="px-4 py-3 border-b border-gray-100">
                  <p class="text-sm font-semibold text-gray-800">{{ session('user_name', session('user_email')) }}</p>
                  <p class="text-xs text-gray-500 truncate">{{ session('user_email') }}</p>
                  <span class="inline-block mt-1 px-2 py-0.5 text-xs font-semibold rounded-full {{ session('role') === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ session('role') === 'admin' ? 'Administrator' : 'Regular User' }}
                  </span>
                </div>

                <!-- Menu Items -->
                <div class="py-1">
                  <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                  </a>

                  @if(session('role') !== 'admin')
                  <a href="{{ route('my.adoptions') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    My Adoptions
                  </a>
                  @endif

                  <a href="{{ route('rescue.form') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Report Rescue
                  </a>
                </div>

                <div class="border-t border-gray-100 py-1">
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                      <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                      </svg>
                      Logout
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 mt-16">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg animate-fade-in">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
          </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-fade-in">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
          </div>
        </div>
        @endif

        @if(session('status'))
        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg animate-fade-in">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-blue-800 font-medium">{{ session('status') }}</p>
          </div>
        </div>
        @endif

        @yield('content')
      </main>

      <!-- Footer -->
      <footer class="bg-white border-t border-gray-200 py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
          <p>© 2025 Pet Adoption System. All rights reserved.</p>
          <p class="mt-2 sm:mt-0">Made with ❤️ for rescued pets</p>
        </div>
      </footer>
    </div>
  </div>

  <!-- Sidebar Toggle Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('sidebar');
      const openBtn = document.getElementById('openSidebar');
      const closeBtn = document.getElementById('closeSidebar');
      const overlay = document.createElement('div');
      overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden';
      document.body.appendChild(overlay);

      openBtn?.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      });

      closeBtn?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      });

      overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      });
    });
  </script>

  @stack('scripts')

  <style>
    .sidebar-link {
      @apply relative flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 hover:text-white font-medium overflow-hidden group;
      z-index: 1;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      user-select: none;
      -webkit-tap-highlight-color: transparent;
      transform: none !important;
      scale: 1 !important;
      border: 1px solid transparent;
      height: 52px;
    }

    .sidebar-link>* {
      position: relative;
      z-index: 2;
      flex-shrink: 0;
      transform: none !important;
    }

    .sidebar-link>span.flex-1 {
      flex-shrink: 1;
      transform: none !important;
      font-weight: 500;
      letter-spacing: 0.01em;
      line-height: 52px;
      font-size: 1rem;
    }

    .sidebar-link:active,
    .sidebar-link:focus {
      transform: none !important;
      scale: 1 !important;
      outline: none;
    }

    .sidebar-link * {
      transform: none !important;
    }

    /* Hover Effects */
    .sidebar-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(236, 72, 153, 0.08) 0%, rgba(168, 85, 247, 0.08) 50%, rgba(99, 102, 241, 0.08) 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
      pointer-events: none;
      border-radius: 0.75rem;
    }

    .sidebar-link:hover {
      background: linear-gradient(135deg, rgba(236, 72, 153, 0.12) 0%, rgba(168, 85, 247, 0.12) 100%);
      border-color: rgba(255, 255, 255, 0.08);
    }

    .sidebar-link:hover::before {
      opacity: 1;
    }

    /* Left Border Indicator on Hover */
    .sidebar-link::after {
      content: '';
      position: absolute;
      left: 0;
      top: 20%;
      height: 60%;
      width: 3px;
      background: linear-gradient(180deg, #ec4899, #a855f7, #6366f1);
      border-radius: 0 4px 4px 0;
      opacity: 0;
      transition: opacity 0.3s ease;
      pointer-events: none;
    }

    .sidebar-link:hover::after {
      opacity: 0.7;
    }

    /* Active State */
    .sidebar-link.active {
      background: linear-gradient(135deg, rgba(236, 72, 153, 0.18) 0%, rgba(168, 85, 247, 0.18) 50%, rgba(99, 102, 241, 0.18) 100%);
      @apply text-white;
      box-shadow:
        0 4px 20px rgba(236, 72, 153, 0.25),
        0 2px 8px rgba(168, 85, 247, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.15),
        inset 0 -1px 0 rgba(0, 0, 0, 0.1);
      border-color: rgba(236, 72, 153, 0.3);
    }

    .sidebar-link.active::before {
      opacity: 1;
      background: linear-gradient(135deg, rgba(236, 72, 153, 0.15) 0%, rgba(168, 85, 247, 0.15) 50%, rgba(99, 102, 241, 0.15) 100%);
    }

    .sidebar-link.active::after {
      opacity: 1;
      width: 4px;
      box-shadow: 0 0 12px rgba(236, 72, 153, 0.8);
    }

    /* Icon Wrapper */
    .sidebar-icon-wrapper {
      width: 36px;
      height: 36px;
      min-width: 36px;
      min-height: 36px;
      border-radius: 0.5rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.06);
      backdrop-filter: blur(8px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      flex-shrink: 0;
      transform: none !important;
      border: 1px solid rgba(255, 255, 255, 0.05);
      vertical-align: middle;
    }

    .sidebar-link:hover .sidebar-icon-wrapper {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.1);
      box-shadow: 0 4px 12px rgba(236, 72, 153, 0.2);
    }

    .sidebar-link:active .sidebar-icon-wrapper,
    .sidebar-link.active .sidebar-icon-wrapper {
      transform: none !important;
    }

    .sidebar-icon-wrapper svg {
      width: 20px;
      height: 20px;
      min-width: 20px;
      min-height: 20px;
      flex-shrink: 0;
      filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.2));
      display: block;
      margin: 0;
      padding: 0;
    }

    .sidebar-link.active .sidebar-icon-wrapper {
      background: linear-gradient(135deg, #ec4899 0%, #a855f7 50%, #6366f1 100%);
      box-shadow:
        0 4px 16px rgba(236, 72, 153, 0.4),
        0 2px 8px rgba(168, 85, 247, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
      border-color: rgba(255, 255, 255, 0.2);
    }

    .sidebar-link.active .sidebar-icon-wrapper svg {
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }

    /* Badge Styling */
    .sidebar-link .rounded-full {
      flex-shrink: 0;
      min-width: fit-content;
      height: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 0.7rem;
      line-height: 1;
      padding: 0 0.5rem;
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow:
        0 2px 8px rgba(239, 68, 68, 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
      animation: pulse-badge 2s ease-in-out infinite;
      vertical-align: middle;
    }

    @keyframes pulse-badge {

      0%,
      100% {
        box-shadow:
          0 2px 8px rgba(239, 68, 68, 0.5),
          inset 0 1px 0 rgba(255, 255, 255, 0.3);
      }

      50% {
        box-shadow:
          0 2px 12px rgba(239, 68, 68, 0.7),
          0 0 16px rgba(239, 68, 68, 0.4),
          inset 0 1px 0 rgba(255, 255, 255, 0.3);
      }
    }

    /* Arrow Icon */
    .sidebar-link svg:last-child {
      flex-shrink: 0;
      width: 16px;
      height: 16px;
      min-width: 16px;
      min-height: 16px;
      transition: all 0.3s ease;
      display: inline-block;
      vertical-align: middle;
    }

    .sidebar-link:hover svg:last-child {
      transform: translateX(3px) !important;
    }

    .sidebar-link.active svg:last-child {
      opacity: 1 !important;
    }

    @keyframes fade-in {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slide-in {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .animate-fade-in {
      animation: fade-in 0.3s ease-out;
    }

    #sidebar nav>div {
      animation: slide-in 0.5s ease-out forwards;
    }

    #sidebar nav>div:nth-child(1) {
      animation-delay: 0.1s;
    }

    #sidebar nav>div:nth-child(2) {
      animation-delay: 0.2s;
    }

    #sidebar nav>div:nth-child(3) {
      animation-delay: 0.3s;
    }

    /* Custom Scrollbar */
    #sidebar nav::-webkit-scrollbar {
      width: 6px;
    }

    #sidebar nav::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
    }

    #sidebar nav::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #ec4899, #a855f7);
      border-radius: 10px;
    }

    #sidebar nav::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, #f472b6, #c084fc);
    }
  </style>
</body>

</html>