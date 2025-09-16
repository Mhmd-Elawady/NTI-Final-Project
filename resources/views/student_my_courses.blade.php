<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>📘 CoursePlatform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">📘 CoursePlatform</a>
      <div>
        <a href="{{ url('/student_courses') }}" class="btn btn-outline-light me-2">Available Courses</a>
        <a href="{{ url('/student_my_courses') }}" class="btn btn-primary">My Courses</a>
        <a href="{{ url('/login') }}" class="btn btn-danger ms-2">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h3>My Enrolled Courses</h3>
    <div id="alert-container" class="mb-3"></div> 
    <div class="row" id="enrolled-courses-container">
   
    </div>
  </div>
  
   <script src="{{ asset('js/student_my_courses.js') }}"></script>
</body>
</html>
