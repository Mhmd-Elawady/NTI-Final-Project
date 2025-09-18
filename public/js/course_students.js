document.addEventListener('DOMContentLoaded', () => {
  console.log('course_students.js loaded ✅');

  
  const laravelSuccess = document.getElementById('laravel-success');
  const laravelError = document.getElementById('laravel-error');

  if (laravelSuccess) {
    showAlert(laravelSuccess.value, 'success');
  }
  if (laravelError) {
    showAlert(laravelError.value, 'danger');
  }


  const addForm = document.getElementById('add-student-form');
  if (addForm) {
    addForm.addEventListener('submit', function (e) {
      const studentName = document.getElementById('student-name').value.trim();
      const studentEmail = document.getElementById('student-email').value.trim();

      if (!studentName || !studentEmail) {
        e.preventDefault();
        showAlert('Please fill in name and email correctly.', 'danger');
      }
    });
  }


  const editForm = document.getElementById('edit-student-form');
  if (editForm) {
    editForm.addEventListener('submit', function (e) {
      const newName = document.getElementById('edit-student-name').value.trim();
      const newEmail = document.getElementById('edit-student-new-email').value.trim();

      if (!newName || !newEmail) {
        e.preventDefault();
        showAlert('Please fill in all fields correctly.', 'danger');
        return;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(newEmail)) {
        e.preventDefault();
        showAlert('Please enter a valid email.', 'danger');
        return;
      }
    });
  }

 
  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function (e) {
      if (!confirm('Are you sure you want to remove this student?')) {
        e.preventDefault();
      }
    });
  });
});


function showAlert(message, type, containerId = 'alert-container') {
  const alertContainer = document.getElementById(containerId);
  if (!alertContainer) return;

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
