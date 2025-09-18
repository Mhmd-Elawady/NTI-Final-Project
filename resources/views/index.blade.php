<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CoursePlatform</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body class="d-flex flex-column min-vh-100  ">

  <nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">CoursePlatform</a>
      <div>
        <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">Login</a>
        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-register">Register</a>
      </div>
    </div>
  </nav>

  <main class="flex-grow-1">
    {{-- Hero Section --}}
    <section class="hero text-center py-5">
      <div class="container">
        <h1 class="fw-bold"><span id="typing-text"></span></h1>
        <p class="lead mb-4 mt-3">A platform to manage courses – join as a student or instructor and easily improve your skills.</p>
        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg me-2">Get Started</a>
        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg">Login</a>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
  <defs>
    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 
    58-18 88-18 58 18 88 18 v44h-352z"></path>
  </defs>
  <g class="parallax">
    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)"></use>
    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)"></use>
    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)"></use>
    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff"></use>
  </g>
</svg>
      </div>
    </section>

    {{-- Features Section --}}
    <section class="container text-center py-5">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="feature-card">
            <div class="feature-icon">
  <i class="bi bi-book"></i>
</div>
            <h4>Browse Courses</h4>
            <p>Students can easily view all available courses and enroll in them.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="feature-card">
<div class="feature-icon">
  <i class="bi bi-person-badge"></i>
</div>


            <h4>Create Your Courses</h4>
            <p>Instructors can add courses and track students step by step.</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  
  <footer class="mt-auto bg-dark text-white text-center p-3">
    © 2025 CoursePlatform. All rights reserved.
  </footer>

  <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
