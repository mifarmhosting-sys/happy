<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') | {{ $settings->site_name }} CMS</title>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #10b981;
      --primary-dark: #059669;
      --bg: #0f172a;
      --card-bg: #1e293b;
      --text: #f8fafc;
      --text-muted: #94a3b8;
      --border: #334155;
      --danger: #ef4444;
      --sidebar-width: 260px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color: var(--bg);
      color: var(--text);
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar Styling */
    .sidebar {
      width: var(--sidebar-width);
      background-color: #0b0f19;
      border-right: 1px solid var(--border);
      padding: 24px 0;
      display: flex;
      flex-direction: column;
      position: fixed;
      height: 100vh;
      overflow-y: auto;
      z-index: 100;
    }

    .sidebar-brand {
      padding: 0 24px 20px;
      border-bottom: 1px solid var(--border);
      margin-bottom: 20px;
    }

    .sidebar-brand h3 {
      font-size: 1.25rem;
      color: var(--primary);
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .sidebar-menu {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 4px;
      padding: 0 12px;
      flex: 1;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      color: var(--text-muted);
      text-decoration: none;
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .sidebar-link:hover, .sidebar-link.active {
      color: var(--text);
      background-color: var(--card-bg);
    }

    .sidebar-link.active {
      border-left: 4px solid var(--primary);
    }

    .sidebar-link i {
      font-size: 1.1rem;
      width: 20px;
      text-align: center;
    }

    .sidebar-footer {
      padding: 20px 24px 0;
      border-top: 1px solid var(--border);
      margin-top: 20px;
    }

    .logout-btn {
      width: 100%;
      background: none;
      border: none;
      color: var(--danger);
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 0.95rem;
      font-weight: 500;
      cursor: pointer;
      padding: 10px 16px;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .logout-btn:hover {
      background-color: rgba(239, 68, 68, 0.1);
    }

    /* Main Content Area */
    .content-wrapper {
      margin-left: var(--sidebar-width);
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-x: hidden;
    }

    .content-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      border-bottom: 1px solid var(--border);
      padding-bottom: 15px;
    }

    .content-header h1 {
      font-size: 1.75rem;
      font-weight: 600;
    }

    .content-header .subtitle {
      font-size: 0.9rem;
      color: var(--text-muted);
      margin-top: 4px;
    }

    /* Cards and Elements */
    .card {
      background-color: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 24px;
      margin-bottom: 30px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-size: 1.15rem;
      font-weight: 600;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s;
      border: none;
    }

    .btn-primary {
      background-color: var(--primary);
      color: #fff;
    }

    .btn-primary:hover {
      background-color: var(--primary-dark);
    }

    .btn-secondary {
      background-color: #475569;
      color: #fff;
    }

    .btn-secondary:hover {
      background-color: #334155;
    }

    .btn-danger {
      background-color: var(--danger);
      color: #fff;
    }

    .btn-danger:hover {
      background-color: #dc2626;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 0.8rem;
    }

    /* Alerts */
    .alert {
      padding: 14px 20px;
      border-radius: 8px;
      margin-bottom: 24px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-success {
      background-color: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.3);
      color: #34d399;
    }

    .alert-danger {
      background-color: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #f87171;
    }

    /* Grid Layouts */
    .grid-3 {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
      margin-bottom: 30px;
    }

    .stat-box {
      background-color: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 24px;
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .stat-icon {
      width: 54px;
      height: 54px;
      border-radius: 10px;
      background-color: rgba(16, 185, 129, 0.1);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
    }

    .stat-number {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .stat-label {
      font-size: 0.85rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Form Fields Styling */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 0.88rem;
      font-weight: 500;
      margin-bottom: 8px;
      color: var(--text-muted);
    }

    .form-control {
      width: 100%;
      background-color: #0b0f19;
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 12px 16px;
      color: var(--text);
      font-size: 0.95rem;
      outline: none;
      transition: border 0.2s;
    }

    .form-control:focus {
      border-color: var(--primary);
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    textarea.form-control {
      resize: vertical;
    }

    .img-preview {
      width: 120px;
      height: 80px;
      object-fit: cover;
      border-radius: 6px;
      margin-top: 10px;
      border: 1px solid var(--border);
      background-color: #000;
    }

    /* Tables */
    .table-responsive {
      width: 100%;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    th {
      background-color: #0b0f19;
      padding: 16px 20px;
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-bottom: 1px solid var(--border);
    }

    td {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      font-size: 0.92rem;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover td {
      background-color: rgba(255, 255, 255, 0.02);
    }

    .actions-cell {
      display: flex;
      gap: 8px;
    }

    .badge {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .badge-unread {
      background-color: rgba(16, 185, 129, 0.2);
      color: #34d399;
    }

    .badge-read {
      background-color: rgba(148, 163, 184, 0.15);
      color: var(--text-muted);
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .content-wrapper {
        margin-left: 0;
        padding: 20px;
      }
      .form-row {
        grid-template-columns: 1fr;
      }
    }
  </style>
  @yield('styles')
</head>
<body>

  <!-- CMS Sidebar Navigation -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <h3>Happy Miles Control Panel</h3>
    </div>
    
    <nav class="sidebar-menu">
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i> Dashboard
      </a>
      <a href="{{ route('admin.settings') }}" class="sidebar-link {{ Request::routeIs('admin.settings') ? 'active' : '' }}">
        <i class="fas fa-cog"></i> Site Settings
      </a>
      <a href="{{ route('admin.homepage') }}" class="sidebar-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}">
        <i class="fas fa-desktop"></i> Home Page Content
      </a>
      <a href="{{ route('admin.about') }}" class="sidebar-link {{ Request::routeIs('admin.about') ? 'active' : '' }}">
        <i class="fas fa-info-circle"></i> About Page Content
      </a>
      <a href="{{ route('admin.hotels.index') }}" class="sidebar-link {{ Request::routeIs('admin.hotels.*') ? 'active' : '' }}">
        <i class="fas fa-hotel"></i> Hotels / Properties
      </a>
      <a href="{{ route('admin.destinations.index') }}" class="sidebar-link {{ Request::routeIs('admin.destinations.*') ? 'active' : '' }}">
        <i class="fas fa-map-marked-alt"></i> Destinations
      </a>
      <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ Request::routeIs('admin.testimonials.*') ? 'active' : '' }}">
        <i class="fas fa-comments"></i> Testimonials
      </a>
      <a href="{{ route('admin.benefits.index') }}" class="sidebar-link {{ Request::routeIs('admin.benefits.*') ? 'active' : '' }}">
        <i class="fas fa-gift"></i> Exclusive Benefits
      </a>
      <a href="{{ route('admin.awards.index') }}" class="sidebar-link {{ Request::routeIs('admin.awards.*') || Request::routeIs('admin.stats.*') ? 'active' : '' }}">
        <i class="fas fa-trophy"></i> Awards & Stats
      </a>
      <a href="{{ route('admin.members.index') }}" class="sidebar-link {{ Request::routeIs('admin.members.*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Registered Members
      </a>
      <a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ Request::routeIs('admin.blogs.*') ? 'active' : '' }}">
        <i class="fas fa-newspaper"></i> Blog Posts
      </a>
      <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
        <i class="fas fa-external-link-alt"></i> Visit Site
      </a>
    </nav>

    <div class="sidebar-footer">
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Content Body -->
  <div class="content-wrapper">
    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> Please correct the highlighted errors.
      </div>
    @endif

    @yield('content')
  </div>

  @yield('scripts')
</body>
</html>
