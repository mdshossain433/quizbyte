/**
 * Initialise event listeners and functionality upon DOM content loading.
 */
document.addEventListener('DOMContentLoaded', () => {
// Select DOM elements 
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const links = document.querySelectorAll('.navbar-item');

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

    // Functionality for the dynamic FAQ section
    const faqData = [
        {
            question: "How does QuizByte work?",
            answer: "QuizByte offers a series of multiple-choice quizzes on computing."
        },
        {
            question: "Is QuizByte free to use?",
            answer: "Yes, QuizByte is completely free for learners."
        },
        {
            question: "What kind of topics can I find quizzes on?",
            answer: "QuizByte primarily focuses on Computer Science, covering topics like programming, algorithms, data structures, and more."
        },
        {
            question: "Do I need an account to use QuizByte?",
            answer: "While anyone can browse QuizByte, an account is needed for full access to all features."
        },
        {
            question: "How can I track my progress?",
            answer: "Your progress is tracked automatically once you're logged into your account."
        },
        {
            question: "Are there any age restrictions for using QuizByte?",
            answer: "QuizByte is suitable for all ages, but we recommend children under 13 use it under parental guidance."
        },
        {
            question: "Can I contribute a quiz to QuizByte?",
            answer: "Currently, quiz contributions are by invite only, but we plan to open up to public contributions soon."
        },
        
    ];

    // Create FAQ section dynamically
    const faqContainer = document.getElementById('faq-container');
    faqData.forEach(faq => {
        const faqElement = document.createElement('div');
        faqElement.classList.add('faq-item');

        const questionElement = document.createElement('h4');
        questionElement.textContent = faq.question;
        questionElement.addEventListener('click', () => {
            answerElement.style.display = answerElement.style.display === 'none' ? 'block' : 'none';
        });

        const answerElement = document.createElement('p');
        answerElement.textContent = faq.answer;
        answerElement.style.display = 'none';

        faqElement.appendChild(questionElement);
        faqElement.appendChild(answerElement);
        faqContainer.appendChild(faqElement);
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

