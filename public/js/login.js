
document.getElementById('login-form').addEventListener('submit', function(event) {
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
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