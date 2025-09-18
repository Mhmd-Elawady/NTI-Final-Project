<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CoursePlatform - Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h3 class="text-center mb-4">Register</h3>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Display Success Message --}}
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST" id="register-form">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
      </div>

      <div class="mb-3">
        <label for="password-confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password-confirmation" name="password_confirmation" placeholder="Confirm password" required>
      </div>

      <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" required>
          <option value="student">Student</option>
          <option value="instructor">Instructor</option>
        </select>
      </div>

      <button type="submit" class="btn register-btn w-100">Register</button>

      <p class="mt-3 text-center text-white">
        Already have an account? <a  href="{{ url('/login') }}">Login</a>
      </p>
    </form>
  </div>

  <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
