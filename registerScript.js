/**
 * Initialise event listeners and functionality upon DOM content loading.
 */
document.addEventListener('DOMContentLoaded', () => {
    // Functionality for the hamburger menu
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const links = document.querySelectorAll('.navbar-item');

    // Toggle the 'active' class on nav-links and icons
    hamburger.addEventListener('click', function() {
        navLinks.classList.toggle('active'); // Toggle visibility of nav links
        
        // Directly toggle the display styles for icons based on 'active' class presence
        this.classList.toggle('active'); // This line is crucial for toggling the icons
        const barsIcon = this.querySelector('.fa-bars');
        const timesIcon = this.querySelector('.fa-times');
        barsIcon.style.display = this.classList.contains('active') ? 'none' : 'inline-block';
        timesIcon.style.display = this.classList.contains('active') ? 'inline-block' : 'none';
    });

    // Close nav-links when any link is clicked
    links.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            // Also reset icons to show hamburger and hide cross when a link is clicked
            const barsIcon = hamburger.querySelector('.fa-bars');
            const timesIcon = hamburger.querySelector('.fa-times');
            barsIcon.style.display = 'inline-block';
            timesIcon.style.display = 'none';
            hamburger.classList.remove('active'); // Ensure this reflects the correct state
        });
    });


    function checkUniqueness(field, value) {
        fetch('php/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=check_uniqueness&${field}=${value}`
        })
        .then(response => response.json())
        .then(data => {
            if (data[field] === 'taken') {
                alert(`${field.charAt(0).toUpperCase() + field.slice(1)} already taken.`);
                document.getElementById(field).classList.add('error');
            } else {
                document.getElementById(field).classList.remove('error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    document.getElementById('username').addEventListener('blur', (event) => {
        checkUniqueness('username', event.target.value);
    });

    document.getElementById('email').addEventListener('blur', (event) => {
        checkUniqueness('email', event.target.value);
    });

    const registrationForm = document.getElementById('registrationForm');

    registrationForm.addEventListener('submit', (event) => {
        // Prevent form submission if username or email is already taken
        const usernameError = document.getElementById('username').classList.contains('error');
        const emailError = document.getElementById('email').classList.contains('error');
        if (usernameError || emailError) {
            event.preventDefault();
            alert('Please correct the errors before submitting.');
            return;
        }

        // Getting form values
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirmPassword').value.trim();

        // Validate password
        if (!isValidPassword(password)) {
            event.preventDefault();
            alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');
            return;
        }

        // Validate confirm password
        if (password !== confirmPassword) {
            event.preventDefault();
            alert('Passwords do not match.');
            return;
        }

        // Additional checks for name, username, and email fields for completeness
        // Though these should also be validated on blur, this is a safeguard
        const name = document.getElementById('name').value.trim();
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();

        if (!name || !username || !password || !confirmPassword || !email) {
            event.preventDefault();
            alert('Please fill in all fields.');
            return;
        }

        if (!isValidEmail(email)) {
            event.preventDefault();
            alert('Please enter a valid email address.');
            return;
        }

        // If all validations pass, the form will submit normally
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPassword(password) {
        const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
        return passwordRegex.test(password);
    }
});
