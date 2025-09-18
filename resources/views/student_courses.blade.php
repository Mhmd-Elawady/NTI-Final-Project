<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CoursePlatform - Available Courses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student_courses.css') }}">
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"> CoursePlatform</a>
      <div>
        <a href="{{ route('student.courses') }}" class="btn btn-primary me-2">Available Courses</a>
        <a href="{{ route('student.mycourses') }}" class="btn btn-outline-light">My Courses</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-danger ms-2">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h3>Available Courses</h3>


    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
      @forelse($courses ?? [] as $course)
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $course->title }}</h5>
              <p class="card-text flex-grow-1">{{ $course->description ?: 'No description available.' }}</p>
              <div class="mt-auto">
                <p class="text-muted small mb-2">
                  <strong>Start Date:</strong> {{ $course->start_date }}<br>
                  <strong>Max Students:</strong> {{ $course->max_students }}
                </p>
                <form action="{{ route('enrollments.store', $course->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-primary w-100">Enroll</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-info text-center">No courses available at the moment.</div>
        </div>
      @endforelse
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
