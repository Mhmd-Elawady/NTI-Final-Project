
document.addEventListener('DOMContentLoaded', () => {
  loadCourseAndStudents();
});


function loadCourseAndStudents() {
  console.log('Loading course and students...');

  const urlParams = new URLSearchParams(window.location.search);
  const courseId = urlParams.get('courseId');
  console.log('Course ID from URL:', courseId);

  if (!courseId) {
    showAlert('No course ID provided.', 'danger', 'alert-container-table');
    return;
  }


  const courses = JSON.parse(localStorage.getItem('courses')) || [];
  console.log('Courses:', courses);
  const course = courses.find(c => c.id === courseId);
  if (!course) {
    showAlert('Course not found.', 'danger', 'alert-container-table');
    return;
  }

 
  document.getElementById('course-title').value = course.title || 'Unknown Course';
  document.getElementById('course-start-date').value = course.startDate || '';
  document.getElementById('table-course-title').textContent = course.title || 'Unknown Course';


  const enrollments = JSON.parse(localStorage.getItem('enrollments')) || [];
  const users = JSON.parse(localStorage.getItem('users')) || [];
  console.log('Enrollments:', enrollments);
  console.log('Users:', users);
  const courseEnrollments = enrollments.filter(e => e.courseId === courseId);
  console.log('Course Enrollments:', courseEnrollments);

  const studentsTbody = document.getElementById('students-tbody');
  if (!studentsTbody) {
    console.error('students-tbody element not found!');
    showAlert('Error loading table.', 'danger', 'alert-container-table');
    return;
  }
  studentsTbody.innerHTML = '';

  if (courseEnrollments.length === 0) {
    studentsTbody.innerHTML = '<tr><td colspan="6" class="text-center">No students enrolled.</td></tr>';
    return;
  }


  courseEnrollments.forEach((enrollment, index) => {
    const user = users.find(u => u.email === enrollment.userEmail) || { id: 'N/A', name: 'Unknown', email: enrollment.userEmail };
    console.log('Rendering user:', user);
    studentsTbody.innerHTML += `
      <tr data-student-email="${enrollment.userEmail}">
        <td>${index + 1}</td>
        <td>${user.id}</td>
        <td>${user.name}</td>
        <td>${user.email}</td>
        <td>${enrollment.enrolledAt.split('T')[0]}</td>
        <td>
          <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editStudentModal" data-student-id="${user.id}" data-student-email="${user.email}" data-student-name="${user.name}">Edit</button>
          <button class="btn btn-danger btn-sm delete-btn" data-student-email="${user.email}">Delete</button>
        </td>
      </tr>
    `;
  });

  
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
      const studentId = this.getAttribute('data-student-id');
      const studentEmail = this.getAttribute('data-student-email');
      const studentName = this.getAttribute('data-student-name');
      console.log('Editing student:', { studentId, studentEmail, studentName });
      document.getElementById('edit-student-id').value = studentId;
      document.getElementById('edit-student-email').value = studentEmail;
      document.getElementById('edit-student-new-email').value = studentEmail;
      document.getElementById('edit-student-name').value = studentName;
    });
  });

  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
      const studentEmail = this.getAttribute('data-student-email');
      if (confirm('Are you sure you want to delete this student?')) {
        console.log('Deleting student with email:', studentEmail);
        deleteStudent(studentEmail, courseId);
        this.closest('tr').remove();
        showAlert('Student removed successfully!', 'success', 'alert-container-table');
      }
    });
  });
}


document.getElementById('add-student-form').addEventListener('submit', function(event) {
  event.preventDefault();

  const studentName = document.getElementById('student-name').value.trim();
  const studentEmail = document.getElementById('student-email').value.trim();
  const urlParams = new URLSearchParams(window.location.search);
  const courseId = urlParams.get('courseId');

  console.log('Adding student:', { studentName, studentEmail, courseId });


  if (!studentName || !studentEmail) {
    showAlert('Please fill in name and email correctly.', 'danger', 'alert-container');
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(studentEmail)) {
    showAlert('Please enter a valid email.', 'danger', 'alert-container');
    return;
  }


  const courses = JSON.parse(localStorage.getItem('courses')) || [];
  const course = courses.find(c => c.id === courseId);
  if (!course) {
    showAlert('Course not found.', 'danger', 'alert-container');
    return;
  }


  let enrollments = JSON.parse(localStorage.getItem('enrollments')) || [];
  let users = JSON.parse(localStorage.getItem('users')) || [];


  const courseEnrollments = enrollments.filter(e => e.courseId === courseId);
  if (courseEnrollments.length >= course.maxStudents) {
    showAlert('Cannot add student: Maximum student limit reached.', 'danger', 'alert-container');
    return;
  }


  if (users.some(u => u.email === studentEmail)) {
    showAlert('Student with this email already exists.', 'warning', 'alert-container');
    return;
  }

  if (enrollments.some(e => e.courseId === courseId && e.userEmail === studentEmail)) {
    showAlert('Student is already enrolled in this course.', 'warning', 'alert-container');
    return;
  }


  const newUser = {
    id: generateId(),
    name: studentName,
    email: studentEmail,
    role: 'student',
    createdAt: new Date().toISOString()
  };
  users.push(newUser);
  localStorage.setItem('users', JSON.stringify(users));
  console.log('Updated users:', users);


  enrollments.push({
    courseId,
    userEmail: studentEmail,
    enrolledAt: new Date().toISOString()
  });
  localStorage.setItem('enrollments', JSON.stringify(enrollments));
  console.log('Updated enrollments:', enrollments);


  showAlert('Student added and enrolled successfully!', 'success', 'alert-container');

  this.reset();
  loadCourseAndStudents();
});


document.getElementById('edit-student-form').addEventListener('submit', function(event) {
  event.preventDefault();

  const oldId = document.getElementById('edit-student-id').value;
  const oldEmail = document.getElementById('edit-student-email').value;
  const newName = document.getElementById('edit-student-name').value.trim();
  const newEmail = document.getElementById('edit-student-new-email').value.trim();

  console.log('Updating student:', { oldId, oldEmail, newName, newEmail });


  if (!newName || !newEmail) {
    showAlert('Please fill in all fields correctly.', 'danger', 'alert-container');
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(newEmail)) {
    showAlert('Please enter a valid email.', 'danger', 'alert-container');
    return;
  }

  let users = JSON.parse(localStorage.getItem('users')) || [];
  const userIndex = users.findIndex(u => u.id === oldId);

  if (userIndex === -1) {
    showAlert('Student not found.', 'danger', 'alert-container');
    return;
  }


  if (users.some(u => u.email === newEmail && u.id !== oldId)) {
    showAlert('Email already in use by another student.', 'danger', 'alert-container');
    return;
  }


  users[userIndex] = { ...users[userIndex], id: oldId, name: newName, email: newEmail };
  localStorage.setItem('users', JSON.stringify(users));
  console.log('Updated users after edit:', users);


  let enrollments = JSON.parse(localStorage.getItem('enrollments')) || [];
  enrollments = enrollments.map(e => e.userEmail === oldEmail ? { ...e, userEmail: newEmail } : e);
  localStorage.setItem('enrollments', JSON.stringify(enrollments));
  console.log('Updated enrollments after edit:', enrollments);

  showAlert('Student updated successfully!', 'success', 'alert-container');
  document.getElementById('edit-student-form').reset();
  bootstrap.Modal.getInstance(document.getElementById('editStudentModal')).hide();
  loadCourseAndStudents();
});


function deleteStudent(studentEmail, courseId) {
  console.log('Deleting student:', { studentEmail, courseId });
  let enrollments = JSON.parse(localStorage.getItem('enrollments')) || [];
  enrollments = enrollments.filter(e => !(e.courseId === courseId && e.userEmail === studentEmail));
  localStorage.setItem('enrollments', JSON.stringify(enrollments));
  console.log('Updated enrollments after delete:', enrollments);
}


function generateId() {
  return Math.random().toString(36).substr(2, 9);
}


function showAlert(message, type, containerId = 'alert-container') {
  const alertContainer = document.getElementById(containerId);
  if (!alertContainer) {
    console.error(`Alert container with ID ${containerId} not found!`);
    return;
  }
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