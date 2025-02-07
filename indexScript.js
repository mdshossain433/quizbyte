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


    // Social media links functionality
    const socialMediaLinks = document.querySelectorAll('.social a');
    socialMediaLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Prevent default link behavior
            event.preventDefault();
            // Show alert 
            alert('Link coming soon.');
        });
    });
});
