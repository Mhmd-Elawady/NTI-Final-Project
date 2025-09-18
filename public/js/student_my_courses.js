document.addEventListener("DOMContentLoaded", () => {
    loadEnrolledCourses();
});

function loadEnrolledCourses() {
    const coursesContainer = document.getElementById(
        "enrolled-courses-container"
    );
    coursesContainer.innerHTML = "";

    coursesContainer.innerHTML =
        '<p class="text-center">You are not enrolled in any courses.</p>';
}

function unenrollFromCourse(courseId) {}

function showAlert(message, type) {
    const alertContainer = document.getElementById("alert-container");
    alertContainer.innerHTML = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
    setTimeout(() => {
        alertContainer.innerHTML = "";
    }, 3000);
}
