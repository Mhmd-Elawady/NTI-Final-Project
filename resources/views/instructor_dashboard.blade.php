<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>📘 CoursePlatform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">📘 CoursePlatform</a>
      <div>
        <a href="{{ url('/instructor_dashboard') }}" class="btn btn-outline-light">Dashboard</a>
        <a href="{{ url('/login') }}" class="btn btn-danger ms-2">Logout</a>
      </div>
    </div>
  </nav>

  {{-- Content --}}
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>My Courses</h3>
      <a href="{{ url('/create_course') }}" class="btn btn-success">+ Create Course</a>
    </div>
   
    <div id="alert-container" class="mb-3"></div>

    <table class="table table-bordered" id="courses-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Start Date</th>
          <th>Max Students</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="courses-tbody">
       
      </tbody>
    </table>
  </div>

  {{-- JS --}}
    <script src="{{ asset('js/my_courses.js') }}"></script>
</body>
</html>
