<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('admin/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <!-- Optional: Custom CSS for additional styling -->
  <style>
    body {
      background-color: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-container {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }
    .login-container h3 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    .btn-primary {
      width: 100%;
    }
    .form-label {
      font-weight: bold;
    }
    .input-group-text {
      background-color: #e9ecef;
    }
    .login-container .form-control:focus {
      box-shadow: none;
      border-color: #007bff;
    }
    body{
        background-image: url('{{ asset("bgimage.jpg")}}');
        background-size: cover;

    }
  </style>
</head>
<body>
  <div class="login-container">

    <h3>Login</h3>
    <form action="{{route('loginuser')}}" method="post">
        @csrf
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" class="form-control" name="email" id="username" placeholder="Enter your username">
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="mt-3 text-center">
        <a href="{{ route('forgot-password.form') }}" class="text-decoration-none">Forgot your password?</a>
      </div>
  </div>

  <!-- Bootstrap JS and Icons -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
