<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/create_course.css') }}">
</head>
<body class="bg-light">

  <div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4"> Create a New Course</h2>

    {{-- Flash messages --}}
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('courses.store') }}">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Course Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="max_students" class="form-label">Max Students</label>
        <input type="number" name="max_students" id="max_students" class="form-control" min="1" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Create Course</button>
    </form>
  </div>

</body>
</html>
