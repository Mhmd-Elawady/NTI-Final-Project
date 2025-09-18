<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CoursePlatform - Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/instructor_dashboard.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"> CoursePlatform</a>
      <div>
        <a href="{{ route('instructor.dashboard') }}" class="btn btn-outline-light">Dashboard</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-danger ms-2">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>My Courses</h3>
        <a href="{{ route('courses.create.view') }}" class="btn btn-success">+ Create Course</a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Courses Table --}}
    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Title</th>
          <th>Start Date</th>
          <th>Max Students</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($courses as $course)
          <tr>
            <td>{{ $course->title }}</td>
            <td>{{ $course->start_date }}</td>
            <td>{{ $course->max_students }}</td>
            <td>
               <a href="{{ route('courses.edit.view', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
               <a href="{{ route('course.students', $course->id) }}" class="btn btn-info btn-sm">Students</a>
              <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this course?')">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">No courses found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
