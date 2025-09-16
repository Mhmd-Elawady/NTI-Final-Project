
document.addEventListener('DOMContentLoaded', () => {
  loadCourses();
});


function loadCourses() {

  const coursesContainer = document.getElementById('courses-container');
  coursesContainer.innerHTML = '';

  if (courses.length === 0) {
    coursesContainer.innerHTML = '<p class="text-center">No courses available.</p>';
    return;
  }

  courses.forEach(course => {
    coursesContainer.innerHTML += `
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">${course.title}</h5>
            <p class="card-text">${course.description || 'No description available.'}</p>
            <button class="btn btn-primary w-100 enroll-btn" data-course-id="${course.id}">Enroll</button>
          </div>
        </div>
      </div>
    `;
  });


  document.querySelectorAll('.enroll-btn').forEach(button => {
    button.addEventListener('click', function() {
      const courseId = this.getAttribute('data-course-id');
      enrollInCourse(courseId);
    });
  });
}


function enrollInCourse(courseId) {

  const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
  if (!loggedInUser || !loggedInUser.loggedIn) {
    showAlert('Please log in to enroll in a course.', 'danger');
    setTimeout(() => {
      window.location.href = '/login';
    }, 2000);
    return;
  }


  const courses = JSON.parse(localStorage.getItem('courses')) || [];
  const course = courses.find(c => c.id === courseId);
  let enrollments = JSON.parse(localStorage.getItem('enrollments')) || [];


  if (enrollments.some(e => e.courseId === courseId && e.userEmail === loggedInUser.email)) {
    showAlert('You are already enrolled in this course.', 'warning');
    return;
  }

  enrollments.push({
    courseId,
    userEmail: loggedInUser.email,
    enrolledAt: new Date().toISOString()
  });
  localStorage.setItem('enrollments', JSON.stringify(enrollments));


  showAlert(`Successfully enrolled in ${course.title}!`, 'success');
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