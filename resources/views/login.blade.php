<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>📘 CoursePlatform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h3 class="text-center mb-4">Login</h3>
    <div id="alert-container" class="mb-3"></div> 
    <form action="{{ route('login.submit') }}" method="POST" id="login-form">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
     </div>
   
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <p class="mt-3 text-center">Don’t have an account? <a href="{{ url('/register') }}">Register</a></p>
    </form>
  </div>

  {{-- JS --}}
   <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
