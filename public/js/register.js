
document.getElementById('register-form').addEventListener('submit', function(event) {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  const confirmPassword = document.getElementById('password-confirmation').value.trim();
  const role = document.getElementById('role').value;

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!name) {
    event.preventDefault();
    showAlert('Please enter your name.', 'danger');
    return;
  }
  if (!email || !emailRegex.test(email)) {
    event.preventDefault();
    showAlert('Please enter a valid email address.', 'danger');
    return;
  }
  if (!password || password.length < 6) {
    event.preventDefault();
    showAlert('Password must be at least 6 characters long.', 'danger');
    return;
  }
  if (password !== confirmPassword) {
    event.preventDefault();
    showAlert('Passwords do not match.', 'danger');
    return;
  }
  if (!role) {
    event.preventDefault();
    showAlert('Please select a role.', 'danger');
    return;
  }

 
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