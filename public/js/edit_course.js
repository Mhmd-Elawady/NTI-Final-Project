
document.addEventListener('DOMContentLoaded', () => {
  loadCourseData();
});


function loadCourseData() {

  const urlParams = new URLSearchParams(window.location.search);
  const courseId = urlParams.get('id');

  if (!courseId) {
    showAlert('No course ID provided.', 'danger');
    return;
  }


  const courses = JSON.parse(localStorage.getItem('courses')) || [];
  const course = courses.find(course => course.id === courseId);

  if (!course) {
    showAlert('Course not found.', 'danger');
    return;
  }


  document.getElementById('course-id').value = course.id;
  document.getElementById('title').value = course.title;
  document.getElementById('description').value = course.description;
  document.getElementById('start-date').value = course.startDate;
  document.getElementById('max-students').value = course.maxStudents;
}


document.getElementById('edit-course-form').addEventListener('submit', function(event) {
  event.preventDefault(); 


  const courseId = document.getElementById('course-id').value;
  const title = document.getElementById('title').value.trim();
  const description = document.getElementById('description').value.trim();
  const startDate = document.getElementById('start-date').value;
  const maxStudents = parseInt(document.getElementById('max-students').value);


  if (!title || !description || !startDate || isNaN(maxStudents) || maxStudents < 1) {
    showAlert('Please fill in all fields correctly and ensure Max Students is a positive number.', 'danger');
    return;
  }


  const updatedCourse = {
    id: courseId,
    title,
    description,
    startDate,
    maxStudents,
    updatedAt: new Date().toISOString()
  };


  let courses = JSON.parse(localStorage.getItem('courses')) || [];
  const courseIndex = courses.findIndex(course => course.id === courseId);
  if (courseIndex !== -1) {
    courses[courseIndex] = updatedCourse;
  } else {
    courses.push(updatedCourse); 
  }
  localStorage.setItem('courses', JSON.stringify(courses));


  showAlert('Course updated successfully!', 'success');

  
  setTimeout(() => {
    window.location.href = '/instructor_dashboard';
  }, 2000);
});


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