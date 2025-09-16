
document.addEventListener('DOMContentLoaded', () => {
  loadCourses();
});


function loadCourses() {
  const courses = JSON.parse(localStorage.getItem('courses')) || [];
  const coursesTbody = document.getElementById('courses-tbody');
  coursesTbody.innerHTML = '';

  if (courses.length === 0) {
    coursesTbody.innerHTML = '<tr><td colspan="4" class="text-center">No courses available.</td></tr>';
    return;
  }

  courses.forEach(course => {
 
    if (!course.id) {
      course.id = generateId();
    }

    coursesTbody.innerHTML += `
      <tr data-course-id="${course.id}">
        <td>${course.title}</td>
        <td>${course.startDate}</td>
        <td>${course.maxStudents}</td>
        <td>
          <a href="/edit_course/${course.id}" class="btn btn-sm btn-warning">Edit</a>
          <a href="/course_students?courseId=${course.id}" class="btn btn-sm btn-info">Students</a>
          <button class="btn btn-sm btn-danger delete-btn">Delete</button>
        </td>
      </tr>
    `;
  });


  localStorage.setItem('courses', JSON.stringify(courses));


  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
      const courseId = this.closest('tr').getAttribute('data-course-id');
      if (confirm('Are you sure you want to delete this course?')) {
        deleteCourse(courseId);
        this.closest('tr').remove();
        showAlert('Course deleted successfully!', 'success');
      }
    });
  });
}


function deleteCourse(courseId) {
  let courses = JSON.parse(localStorage.getItem('courses')) || [];
  courses = courses.filter(course => course.id !== courseId);
  localStorage.setItem('courses', JSON.stringify(courses));
}

function generateId() {
  return Math.random().toString(36).substr(2, 9);
}


function showAlert(message, type) {
  const alertContainer = document.getElementById('alert-container');
  alertContainer.innerHTML = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
  setTimeout(() => {
    alertContainer.innerHTML = '';
  }, 3000);
}