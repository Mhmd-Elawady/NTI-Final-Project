
document.addEventListener('DOMContentLoaded', () => {
  loadEnrolledCourses();
});


function loadEnrolledCourses() {
  const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
  const coursesContainer = document.getElementById('enrolled-courses-container');
  coursesContainer.innerHTML = '';


  if (!loggedInUser || !loggedInUser.loggedIn) {
    showAlert('Please log in to view your enrolled courses.', 'danger');
    setTimeout(() => {
      window.location.href = '/login';
    }, 2000);
    return;
  }


  const courses = JSON.parse(localStorage.getItem('courses')) || [];
  const enrollments = JSON.parse(localStorage.getItem('enrollments')) || [];
  const userEnrollments = enrollments.filter(e => e.userEmail === loggedInUser.email);

  if (userEnrollments.length === 0) {
    coursesContainer.innerHTML = '<p class="text-center">You are not enrolled in any courses.</p>';
    return;
  }


  userEnrollments.forEach(enrollment => {
    const course = courses.find(c => c.id === enrollment.courseId);
    if (course) {
      coursesContainer.innerHTML += `
        <div class="col-md-4 mb-3">
          <div class="card border-success">
            <div class="card-body">
              <h5 class="card-title">${course.title}</h5>
              <p class="card-text">تم التسجيل بتاريخ: ${enrollment.enrolledAt.split('T')[0]}</p>
              <span class="badge bg-success">Enrolled</span>
              <button class="btn btn-danger btn-sm mt-2 unenroll-btn" data-course-id="${course.id}">Unenroll</button>
            </div>
          </div>
        </div>
      `;
    }
  });


  document.querySelectorAll('.unenroll-btn').forEach(button => {
    button.addEventListener('click', function() {
      const courseId = this.getAttribute('data-course-id');
      if (confirm('Are you sure you want to unenroll from this course?')) {
        unenrollFromCourse(courseId);
        this.closest('.col-md-4').remove();
        showAlert('Successfully unenrolled from the course.', 'success');
      }
    });
  });
}


function unenrollFromCourse(courseId) {
  const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
  let enrollments = JSON.parse(localStorage.getItem('enrollments')) || [];
  enrollments = enrollments.filter(e => !(e.courseId === courseId && e.userEmail === loggedInUser.email));
  localStorage.setItem('enrollments', JSON.stringify(enrollments));
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