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
            event.preventDefault();
            alert('Link coming soon.');
        });
    });
function updateScoreboard() {
    fetch('php/get_top_scores.php')
        .then(response => response.json())
        .then(scores => {
            const scoreboard = document.getElementById('dynamicScoreboard');
            scoreboard.innerHTML = ''; // Clear existing scores

           scores.forEach(score => {
    const player = document.createElement('li');
    player.className = 'player';
    player.innerHTML = `<span class="player-name">${score.Username}</span> 
                        <span class="player-score">Score: ${score.Score}</span>`;
    scoreboard.appendChild(player);
});

        })
        .catch(error => console.error('Error:', error));
}
  // Call updateScoreboard() initially
    updateScoreboard();
// Call updateScoreboard() at regular intervals
setInterval(updateScoreboard, 30000); // Update every 30 seconds

});