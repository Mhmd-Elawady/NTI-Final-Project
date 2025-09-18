document.addEventListener('DOMContentLoaded', () => {
  loadCourses();
});

function loadCourses() {
  console.log('loadCourses called');
  const coursesTbody = document.getElementById('courses-tbody');
  coursesTbody.innerHTML = '';

  const data = Array.isArray(window.courses) ? window.courses : [];
  console.log('Data to process:', data);

  if (data.length === 0) {
    console.log('No courses found, showing empty message');
    coursesTbody.innerHTML = '<tr><td colspan="4" class="text-center">No courses available.</td></tr>';
    return;
  }

  console.log('Processing', data.length, 'courses');
  data.forEach((course, index) => {
    console.log(`Processing course ${index}:`, course);
    const id = course.id;
    const title = course.title ?? '';
    const startDate = course.start_date ?? '';
    const maxStudents = course.max_students ?? '';

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    coursesTbody.innerHTML += `
      <tr data-course-id="${id}">
        <td>${title}</td>
        <td>${startDate}</td>
        <td>${maxStudents}</td>
        <td>
          <a href="/edit_course/${id}" class="btn btn-sm btn-warning">Edit</a>
          <a href="/course_students/${id}" class="btn btn-sm btn-info">Students</a>
          <button class="btn btn-sm btn-danger delete-btn" data-course-id="${id}">Delete</button>
        </td>
      </tr>
    `;
  });


  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
      const courseId = this.getAttribute('data-course-id');
      if (confirm('Are you sure you want to delete this course?')) {
      
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/courses/${courseId}`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
      }
    });
  });
}
