document.getElementById('course-form').addEventListener('submit', function(event) {
  event.preventDefault(); 

  const title = document.getElementById('title').value.trim();
  const description = document.getElementById('description').value.trim();
  const startDate = document.getElementById('start-date').value;
  const maxStudents = parseInt(document.getElementById('max-students').value);

  if (!title || !description || !startDate || isNaN(maxStudents) || maxStudents < 1) {
    showAlert('Please fill in all fields correctly and ensure Max Students is a positive number.', 'danger');
    return;
  }


  const courseId = generateId();


  const course = {
    id: courseId, 
    title,
    description,
    startDate,
    maxStudents,
    createdAt: new Date().toISOString()
  };

 
  let courses = JSON.parse(localStorage.getItem('courses')) || [];
  courses.push(course);
  localStorage.setItem('courses', JSON.stringify(courses));


  showAlert('Course created successfully!', 'success');


  this.reset();
});


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