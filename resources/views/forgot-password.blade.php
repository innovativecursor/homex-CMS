<!-- resources/views/auth/forgot-password.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .forgot-password-container {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }
    .forgot-password-container h3 {
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
    body{
        background-image: url('{{ asset("bgimage.jpg")}}');
        background-size: cover;

    }
  </style>
</head>
<body>
  <div class="forgot-password-container">
    @if(session('status'))
    <div class="alert alert-success mt-3">{{ session('status') }} <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank">Open Gmail</a></div>
    @endif
    <h3>Forgot Password</h3>
    <form action="{{ route('forgot-password.send') }}" method="POST">
      @csrf
      <!-- Email Input -->
      <div class="mb-3">
        <label for="email" class="form-label">Enter your Email</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>

    @if ($errors->any())
      <div class="alert alert-danger mt-3">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="mt-3 text-center">
        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
      </div>
    <!-- Display Status Message -->


    <!-- Validation Errors -->

  </div>

  <!-- Bootstrap JS and Icons -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
