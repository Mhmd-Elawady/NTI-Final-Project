<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>📘 CoursePlatform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      {{-- بدل href="index.html" بخليها route --}}
      <a class="navbar-brand" href="{{ route('home') }}">📘 CoursePlatform</a>
      <div>
        <a href="{{ route('instructor.dashboard') }}" class="btn btn-outline-light">Dashboard</a>
        <a href="{{ route('logout') }}" class="btn btn-danger ms-2">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-5" style="max-width: 600px;">
    <h3>Create Course</h3>
    <div id="alert-container"></div>
    
    <form id="course-form" method="POST" action="{{ route('courses.store') }}">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
      </div>

      <div class="mb-3">
        <label for="start-date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="start-date" name="start_date" required>
      </div>

      <div class="mb-3">
        <label for="max-students" class="form-label">Max Students</label>
        <input type="number" class="form-control" id="max-students" name="max_students" min="1" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Save</button>
    </form>
  </div>

  <script src="{{ asset('js/create_course.js') }}"></script>
</body>
</html>
