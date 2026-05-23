<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | {{ $settings->site_name }} CMS</title>
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
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }

    .login-container {
      width: 100%;
      max-width: 420px;
    }

    .login-card {
      background-color: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
    }

    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-header h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 8px;
    }

    .login-header p {
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-group label {
      display: block;
      font-size: 0.88rem;
      font-weight: 500;
      color: var(--text-muted);
      margin-bottom: 8px;
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
      transition: all 0.2s;
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      font-size: 0.88rem;
    }

    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--text-muted);
      cursor: pointer;
    }

    .checkbox-label input {
      accent-color: var(--primary);
    }

    .btn-submit {
      width: 100%;
      background-color: var(--primary);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 14px;
      font-size: 0.98rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-submit:hover {
      background-color: var(--primary-dark);
    }

    .error-msg {
      background-color: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #f87171;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 24px;
      font-size: 0.85rem;
      font-weight: 500;
      text-align: center;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: var(--text-muted);
      text-decoration: none;
      font-size: 0.88rem;
      transition: color 0.2s;
    }

    .back-link:hover {
      color: var(--text);
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <h2>PTC Admin Panel</h2>
        <p>Sign in to manage your site content</p>
      </div>

      @if($errors->any())
        <div class="error-msg">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="admin@premiumtravel.club" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="form-options">
          <label class="checkbox-label">
            <input type="checkbox" name="remember"> Remember me
          </label>
        </div>

        <button type="submit" class="btn-submit">Sign In</button>
      </form>

      <a href="{{ route('home') }}" class="back-link">← Back to website</a>
    </div>
  </div>

</body>
</html>
