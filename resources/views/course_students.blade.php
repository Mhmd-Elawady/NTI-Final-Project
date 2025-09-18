<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CoursePlatform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="{{ asset('css/course_students.css') }}">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"> CoursePlatform</a>
      <div>
        <a href="{{ url('/instructor_dashboard') }}" class="btn btn-outline-light">Dashboard</a>
        <a href="{{ url('/login') }}" class="btn btn-danger ms-2">Logout</a>
      </div>
    </div>
  </nav>


  <div class="container mt-5" style="max-width: 600px;">
    <h3>Add New Student to Course</h3>
    <div id="alert-container" class="mb-3"></div>
   <form id="add-student-form" method="POST" action="{{ route('enrollments.addStudent', $course->id) }}">
  @csrf

 
  <div class="mb-3">
    <label for="course-title" class="form-label">Course</label>
    <input type="text" class="form-control" id="course-title" name="course_title" value="{{ $course->title }}" readonly>
  </div>

  <div class="mb-3">
    <label for="course-start-date" class="form-label">Course Start Date</label>
    <input type="date" class="form-control" id="course-start-date" name="course_start_date" value="{{ $course->start_date }}" readonly>
  </div>


  <div class="mb-3">
    <label for="student-name" class="form-label">Student Name</label>
    <input type="text" class="form-control" id="student-name" name="student_name" placeholder="Enter student name" required>
  </div>

 
  <div class="mb-3">
    <label for="student-email" class="form-label">Student Email</label>
    <input type="email" class="form-control" id="student-email" name="student_email" placeholder="Enter student email" required>
  </div>


  <div class="mb-3">
    <label for="student-password" class="form-label">Student Password</label>
    <input type="password" class="form-control" id="student-password" name="student_password" placeholder="Enter password" required>
  </div>

  <button type="submit" class="btn btn-success w-100">Add Student</button>
</form>

  </div>


  <div class="container mt-5">
    <h3>Students Enrolled in <span id="table-course-title" class="text-primary"></span></h3>
    <div id="alert-container-table" class="mb-3"></div>
    <table class="table table-bordered mt-3" id="students-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Student ID</th>
          <th>Student Name</th>
          <th>Email</th>
          <th>Enrolled At</th>
          <th>Actions</th>
        </tr>
      </thead>
    <tbody id="students-tbody">
  @foreach($students as $index => $student)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $student->id }}</td>
      <td>{{ $student->name }}</td>
      <td>{{ $student->email }}</td>
      <td>{{ $student->pivot->created_at->format('d/m/Y') }}</td>
      <td>
        <form method="POST" action="{{ route('enrollments.removeStudent', [$course->id, $student->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm delete-btn">Remove</button>
</form>

      </td>
    </tr>
  @endforeach
</tbody>

    </table>
  </div>

 
  <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="edit-student-form">
            <input type="hidden" id="edit-student-id">
            <input type="hidden" id="edit-student-email">
            <div class="mb-3">
              <label for="edit-student-name" class="form-label">Student Name</label>
              <input type="text" class="form-control" id="edit-student-name" required>
            </div>
            <div class="mb-3">
              <label for="edit-student-new-email" class="form-label">Email</label>
              <input type="email" class="form-control" id="edit-student-new-email" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/course_students.js') }}"></script>
</body>
</html>
