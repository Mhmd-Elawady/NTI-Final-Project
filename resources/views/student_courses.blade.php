<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>📘 CoursePlatform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h3>Available Courses</h3>
    <div id="alert-container" class="mb-3"></div> 
    <div class="row" id="courses-container">
     
    </div>
  </div>
     <script src="{{ asset('js/student_courses.js') }}"></script>
</body>
</html>