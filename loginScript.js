/**
 * Initialise event listeners and functionality upon DOM content loading.
 */
document.addEventListener('DOMContentLoaded', () => {

// Select DOM elements 
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const links = document.querySelectorAll('.navbar-item');
const usernameErrorElement = document.getElementById('username-error');
const passwordErrorElement = document.getElementById('password-error');


// Hamburger menu toggle
hamburger.addEventListener('click', () => {

  // Toggle navigation menu
  navLinks.classList.toggle('active');

  // Toggle icon
  hamburger.classList.toggle('active');
  const barsIcon = hamburger.querySelector('.fa-bars');
  const timesIcon = hamburger.querySelector('.fa-times');
  barsIcon.style.display = hamburger.classList.contains('active') ? 'none' : 'inline-block';
  timesIcon.style.display = hamburger.classList.contains('active') ? 'inline-block' : 'none';

});

// Collapse menu on link click
links.forEach(link => {
  link.addEventListener('click', () => {
    navLinks.classList.remove('active');
    
    // Reset icon
    hamburger.classList.remove('active');
    const barsIcon = hamburger.querySelector('.fa-bars');
    const timesIcon = hamburger.querySelector('.fa-times');
    barsIcon.style.display = 'inline-block';
    timesIcon.style.display = 'none';
  });
});

// Handle form submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(loginForm);

            // Submit form data via fetch API
            fetch('php/login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Clear previous errors
                if (usernameErrorElement) usernameErrorElement.textContent = '';
                if (passwordErrorElement) passwordErrorElement.textContent = '';

                // Handle response dat
                if (data.location) {
                    window.location.href = data.location;
                } else {
                    // Display errors if any
                    if (data.username_err && usernameErrorElement) {
                        usernameErrorElement.textContent = data.username_err;
                    }
                    if (data.password_err && passwordErrorElement) {
                        passwordErrorElement.textContent = data.password_err;
                    }
                    if (data.error) {
                        console.error(data.error); // Handle any other errors
                    }
                }
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        });
    }

    // Handle social media link clicks
    const socialMediaLinks = document.querySelectorAll('.social a');
    socialMediaLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            // Prevent default link behavior
            event.preventDefault();
            // Show alert 
            alert('Link coming soon.');
        });
    });
});
