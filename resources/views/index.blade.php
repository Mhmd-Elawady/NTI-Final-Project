<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>📘 CoursePlatform</title>

  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body class="d-flex flex-column min-vh-100 bg-white ">

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">📘 CoursePlatform</a>
      <div>
        <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">Login</a>
        <a href="{{ url('/register') }}" class="btn btn-success">Register</a>
      </div>
    </div>
  </nav>

  {{-- Main content --}}
  <main class="flex-grow-1">
    {{-- Hero Section --}}
    <section class="hero text-center py-5">
      <div class="container">
        <h1 class="fw-bold"><span id="typing-text"></span></h1>
        <p class="lead mb-4 mt-3">A platform to manage courses – join as a student or instructor and easily improve your skills.</p>
        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg me-2">Get Started</a>
        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg">Login</a>
      </div>
    </section>

    {{-- Features Section --}}
    <section class="container text-center py-5">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="feature-card">
            <div class="feature-icon">📚</div>
            <h4>Browse Courses</h4>
            <p>Students can easily view all available courses and enroll in them.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="feature-card">
            <div class="feature-icon">👨‍🏫</div>
            <h4>Create Your Courses</h4>
            <p>Instructors can add courses and track students step by step.</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  {{-- Footer --}}
  <footer class="mt-auto bg-dark text-white text-center p-3">
    © 2025 CoursePlatform. All rights reserved.
  </footer>

  {{-- JS --}}
  <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
