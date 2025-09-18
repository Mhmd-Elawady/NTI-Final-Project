const texts = [
  { text: 'Start your learning journey with us', icon: '<i class="fas fa-rocket"></i>' },
  { text: 'Learn easily and quickly', icon: '<i class="fas fa-book"></i>' },
  { text: 'Improve your skills with CoursePlatform', icon: '<i class="fas fa-star"></i>' }
];

let textIndex = 0;
let charIndex = 0;
let isDeleting = false;
const typingSpeed = 80;
const deletingSpeed = 40;
const delayBetweenTexts = 1500;

function type() {
  const typingText = document.getElementById('typing-text');
  typingText.classList.add('typing-cursor');
  const current = texts[textIndex];
  
  if (isDeleting) {
    typingText.innerHTML = current.text.substring(0, charIndex--);
    if (charIndex < 0) {
      isDeleting = false;
      textIndex = (textIndex + 1) % texts.length;
      setTimeout(type, 300);
    } else {
      setTimeout(type, deletingSpeed);
    }
  } else {
    typingText.innerHTML = current.text.substring(0, charIndex++);
    if (charIndex > current.text.length) {
      typingText.innerHTML = current.text + ' ' + current.icon;
      isDeleting = true;
      typingText.classList.remove('typing-cursor');
      setTimeout(type, delayBetweenTexts);
    } else {
      setTimeout(type, typingSpeed);
    }
  }
}

type();


window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    navbar.classList.add('sticky');
  } else {
    navbar.classList.remove('sticky');
  }
});


window.addEventListener('scroll', () => {
  const backToTop = document.getElementById('back-to-top');
  if (window.scrollY > 300) {
    backToTop.classList.add('show');
  } else {
    backToTop.classList.remove('show');
  }
});

document.getElementById('back-to-top').addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

document.addEventListener('DOMContentLoaded', () => {
  setTimeout(type, 500);
});


window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    navbar.classList.add('sticky');
  } else {
    navbar.classList.remove('sticky');
  }
});
