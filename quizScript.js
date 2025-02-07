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
});  
        // Quiz functionality script
        let quizStarted = false;
        let timeLeft;
        const totalQuestions = 20;
        const totalTime = totalQuestions * 30;
        let timer;
        let quizActive = false;
        let timerExpired = false;

        // Declare selectedQuestions in the global scope
        let selectedQuestions = [];
        
        // Expanded pool of questions
const allQuestions = [
    // Question 1 details
    {
        question: "What is the primary purpose of Charles Babbage's Analytical Engine?",
        answers: ["To serve as a calculator", "To process textual information", "To be the first programmable computer", "To enhance telecommunication"],
        correctAnswer: "To be the first programmable computer"
    },
    // Question 2 details
    {
        question: "What is the primary function of a semiconductor?",
        answers: ["To store digital data", "To conduct electricity under certain conditions", "To generate light", "To amplify sound signals"],
        correctAnswer: "To conduct electricity under certain conditions"
    },
    // Question 3 details
    {
        question: "What principle is the foundation of Quantum Computing?",
        answers: ["Superposition", "Electromagnetism", "Nuclear fusion", "Thermodynamics"],
        correctAnswer: "Superposition"
    },
    // Question 4 details
    {
        question: "The concept of 'Artificial Intelligence' was first coined in which decade?",
        answers: ["1940s", "1950s", "1960s", "1970s"],
        correctAnswer: "1950s"
    },
    // Question 5 details
    {
        question: "The first successful message sent over ARPANET, the precursor to the Internet, was?",
        answers: ["Hello World", "LOG", "LOGIN", "CONNECT"],
        correctAnswer: "LOGIN"
    },
    // Question 6 details
    {
        question: "What is the primary application of the 'Blockchain' technology?",
        answers: ["Online voting", "Social media", "Cryptocurrency transactions", "Email encryption"],
        correctAnswer: "Cryptocurrency transactions"
    },
    // Question 7 details
    {
        question: "Which scientist is credited with formulating the laws of motion and universal gravitation?",
        answers: ["Albert Einstein", "Isaac Newton", "Galileo Galilei", "Nikola Tesla"],
        correctAnswer: "Isaac Newton"
    },
    // Question 8 details
    {
        question: "What does 'Moore's Law' refer to?",
        answers: ["The doubling of computer processing speed every two years", "The reduction in size of transistors in an integrated circuit every two years", "The increase in energy efficiency of processors every year", "The halving of the cost of computers every 18 months"],
        correctAnswer: "The reduction in size of transistors in an integrated circuit every two years"
    },
    // Question 9 details
    {
        question: "Who is known for proposing the relativity theory in physics?",
        answers: ["Stephen Hawking", "Max Planck", "Albert Einstein", "Werner Heisenberg"],
        correctAnswer: "Albert Einstein"
    },
    // Question 10 details
    {
        question: "What is 'Deep Learning' primarily used for in Artificial Intelligence?",
        answers: ["Optimizing database storage", "Enhancing cybersecurity", "Creating autonomous vehicles", "Pattern recognition and data analysis"],
        correctAnswer: "Pattern recognition and data analysis"
    },
    // Question 11 details
    {
        question: "What is the primary use of Lithium-ion batteries in technology?",
        answers: ["Powering electric vehicles", "Storing solar energy", "Enabling wireless communication", "Running supercomputers"],
        correctAnswer: "Powering electric vehicles"
    },
    // Question 12 details
    {
        question: "The discovery of the structure of DNA was primarily the work of?",
        answers: ["Rosalind Franklin and Maurice Wilkins", "James Watson and Francis Crick", "Gregor Mendel and Charles Darwin", "Louis Pasteur and Marie Curie"],
        correctAnswer: "James Watson and Francis Crick"
    },
    // Question 13 details
    {
        question: "Which of these is a key feature of 'Machine Learning'?",
        answers: ["The ability to perform complex calculations", "The ability to improve automatically through experience", "The ability to store large amounts of data", "The ability to transmit data wirelessly"],
        correctAnswer: "The ability to improve automatically through experience"
    },
    // Question 14 details
    {
        question: "In computing, what does 'GUI' stand for?",
        answers: ["General User Interface", "Graphical User Interface", "Global Utility Interface", "Guided User Interaction"],
        correctAnswer: "Graphical User Interface"
    },
    // Question 15 details
    {
        question: "The concept of 'Big Data' is primarily characterized by?",
        answers: ["The speed of data processing", "The volume, variety, and velocity of data", "The complexity of data algorithms", "The security of data storage"],
        correctAnswer: "The volume, variety, and velocity of data"
    },
    // Question 16 details
    {
        question: "Who is credited with inventing the World Wide Web?",
        answers: ["Steve Jobs", "Bill Gates", "Tim Berners-Lee", "Mark Zuckerberg"],
        correctAnswer: "Tim Berners-Lee"
    },
    // Question 17 details
    {
        question: "What is the primary focus of 'Nanotechnology'?",
        answers: ["The study of space and galaxies", "Manipulating matter on an atomic or molecular scale", "The development of nuclear energy", "Enhancing digital communication"],
        correctAnswer: "Manipulating matter on an atomic or molecular scale"
    },
    // Question 18 details
    {
        question: "The 'Human Genome Project' was an international effort to?",
        answers: ["Create a new form of artificial intelligence", "Map and understand all the genes of the human species", "Develop a cure for all human diseases", "Connect the human brain to computers"],
        correctAnswer: "Map and understand all the genes of the human species"
    },
    // Question 19 details
    {
        question: "In the field of robotics, 'ASIMO' developed by Honda is known for being?",
        answers: ["The first robot to land on Mars", "An advanced humanoid robot", "A robot specialized in surgical procedures", "The first underwater exploration robot"],
        correctAnswer: "An advanced humanoid robot"
    },
    // Question 20 details
    {
        question: "What technology is central to the development of driverless cars?",
        answers: ["Solar power", "Quantum computing", "Artificial Intelligence and Machine Learning", "Blockchain"],
        correctAnswer: "Artificial Intelligence and Machine Learning"
    },
    {
        question: "'Cloud Computing' primarily allows users to?",
        answers: ["Increase their data storage capacity on personal devices", "Access and store data and programs over the Internet instead of on hard drives", "Improve the graphics of video games", "Enhance the processing power of smartphones"],
        correctAnswer: "Access and store data and programs over the Internet instead of on hard drives"
    },
    // Question 22 details
    {
        question: "What is 'Virtual Reality' primarily used for?",
        answers: ["Enhancing digital transactions", "Creating immersive computer-generated environments", "Speeding up internet connections", "Improving smartphone functionality"],
        correctAnswer: "Creating immersive computer-generated environments"
    },
    // Question 23 details
    {
        question: "The 'Curiosity Rover' is a robot sent to explore?",
        answers: ["The Moon", "Mars", "Jupiter", "Saturn"],
        correctAnswer: "Mars"
    },
    // Question 24 details
    {
        question: "Which technology is fundamental to 'Smart Homes'?",
        answers: ["Solar panels", "Internet of Things (IoT)", "Blockchain", "Quantum computing"],
        correctAnswer: "Internet of Things (IoT)"
    },
    // Question 25 details
    {
        question: "The concept of 'Cybersecurity' is essential for?",
        answers: ["Enhancing physical security", "Protecting data and networks in the digital world", "Speeding up computer processors", "Improving wireless communication"],
        correctAnswer: "Protecting data and networks in the digital world"
    }
];

        // Function to randomly select questions
        function selectRandomQuestions(allQuestions, total) {
            return allQuestions.sort(() => 0.5 - Math.random()).slice(0, total);
        }

       // Function to add questions to the quiz form dynamically
       function addQuestions() {
    const quizForm = document.getElementById('quizForm');
    selectedQuestions = selectRandomQuestions(allQuestions, totalQuestions);

    selectedQuestions.forEach((item, index) => {
        let questionDiv = document.createElement('div');
        questionDiv.className = 'question';
        questionDiv.id = `question${index + 1}`;

        let questionText = document.createElement('p');
        questionText.textContent = `${index + 1}. ${item.question}`;
        questionDiv.appendChild(questionText);

        let answersDiv = document.createElement('div');
        answersDiv.className = 'answers';
        
        // Initially hide all questions except the first one
        questionDiv.style.display = (index === 0) ? 'block' : 'none';

        let shuffledAnswers = shuffleArray(item.answers);
        shuffledAnswers.forEach(answer => {
            let label = document.createElement('label');
            let input = document.createElement('input');
            input.type = 'radio';
            input.name = `q${index + 1}`;
            input.value = answer;
            label.appendChild(input);

            let span = document.createElement('span');
            span.textContent = answer;
            label.appendChild(span);

            answersDiv.appendChild(label);
        });

        questionDiv.appendChild(answersDiv);
        quizForm.appendChild(questionDiv); // Append each questionDiv to the form
    });

    // Now, append the navigation and submit buttons after all questions
    const navButtons = document.querySelector('.navigation-buttons');
    const submitButton = document.getElementById('submitButton');

    quizForm.appendChild(navButtons);
    quizForm.appendChild(submitButton);

    // Initially hide the 'Previous' button and submit button
    document.getElementById('prevButton').style.display = 'none';
    submitButton.style.display = 'none';
}

// Function to shuffle an array (Fisher-Yates Shuffle)
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

        // Function to start the quiz
        function startQuiz() {
            if (quizStarted) return;

            document.getElementById('startButton').style.display = 'none';
            document.getElementById('quizForm').style.display = 'block';
            quizStarted = true;
            quizActive = true;
            timeLeft = totalTime;
            startTimer();

            addQuestions();
        }

        // Function to start the timer
        function startTimer() {
    const timerDisplay = document.getElementById('timer') || createTimerDisplay();
    timer = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;

        const minutesDisplay = minutes > 0 ? `${minutes} min` : '';
        const secondsDisplay = seconds > 0 ? `${seconds} sec` : '';

        timerDisplay.textContent = `Time Left: ${minutesDisplay} ${secondsDisplay}`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            timerExpired = true;
            quizActive = false;
            timeUpMessage();
        }
        timeLeft--;
    }, 1000);
}
        // Function to create the timer display
        function createTimerDisplay() {
            let timerDiv = document.createElement('div');
            timerDiv.id = 'timer';
            document.body.insertBefore(timerDiv, document.getElementById('quizForm'));
            return timerDiv;
        }

        // Function to display a time up message when the timer expires
        function timeUpMessage() {
            alert('Your time is up. Better luck next time!');
            document.getElementById('submitButton').disabled = true;
        }

     let currentQuestionIndex = 0;

     // Function to show the next question
     function showNextQuestion() {
    // Validation: check if the current question is answered
    if (!isQuestionAnswered(currentQuestionIndex)) {
        alert('Please answer the question before proceeding.');
        return;
    }

    // Hide current and show next question
    changeQuestionVisibility(currentQuestionIndex, currentQuestionIndex + 1);
    currentQuestionIndex++;

    // Update button visibility
    updateButtonVisibility();
}

    // Function to show the previous question
    function showPrevQuestion() {
    if (currentQuestionIndex > 0) {
        // Hide current and show previous question
        changeQuestionVisibility(currentQuestionIndex, currentQuestionIndex - 1);
        currentQuestionIndex--;

        // Update button visibility
        updateButtonVisibility();
    }
}

    // Function to change the visibility of questions
    function changeQuestionVisibility(currentIndex, nextIndex) {
    let currentQuestion = document.getElementById(`question${currentIndex + 1}`);
    let nextQuestion = document.getElementById(`question${nextIndex + 1}`);

    if (currentQuestion) currentQuestion.style.display = 'none';
    if (nextQuestion) nextQuestion.style.display = 'block';
}

// Function to update the visibility of navigation buttons
     function updateButtonVisibility() {
    // Show 'Previous' button only if not on the first question
    document.getElementById('prevButton').style.display = (currentQuestionIndex > 0) ? 'block' : 'none';
    
    // Show 'Next' button only if not on the last question
    document.getElementById('nextButton').style.display = (currentQuestionIndex < totalQuestions - 1) ? 'block' : 'none';

    // Show 'Submit' button only on the last question
    document.getElementById('submitButton').style.display = (currentQuestionIndex === totalQuestions - 1) ? 'block' : 'none';
}

// Function to check if a question is answered
   function isQuestionAnswered(index) {
    const questionKey = `q${index + 1}`;
    const userAnswer = new FormData(document.getElementById('quizForm')).get(questionKey);
    return userAnswer !== null;
}

   // Function to submit the quiz
   function submitQuiz() {
if (!quizStarted || !quizActive) return;

// Track the time left when the quiz is submitted
const timeRemaining = timeLeft;

// Gather form data and calculate the score
const formData = new FormData(document.getElementById('quizForm'));
let baseScore = 0;
let questionsAnsweredCorrectly = 0;
let allQuestionsAnswered = true;
let incorrectQuestions = []; // Array to store numbers of incorrect questions

for (let i = 1; i <= totalQuestions; i++) {
    let questionKey = `q${i}`;
    let userAnswer = formData.get(questionKey);

    // Check if the user has not answered a question
    if (!userAnswer) {
        alert(`Please answer question number ${i} before submitting.`);
        allQuestionsAnswered = false;
        break; // Break out of the loop as we found an unanswered question
    }

    if (userAnswer.toLowerCase() === selectedQuestions[i - 1].correctAnswer.toLowerCase()) {
        baseScore += 5;
        questionsAnsweredCorrectly++;
    } else {
        incorrectQuestions.push(i); // Add question number to the array if the answer is incorrect
    }
}

// Only proceed if all questions have been answered
if (allQuestionsAnswered) {
    clearInterval(timer);
    quizActive = false;

    let resultsMessage = '';
    let bonusPoints = 0;

    if (questionsAnsweredCorrectly === totalQuestions) {
        // Calculate bonus points based on the time left
        bonusPoints = Math.floor((timeRemaining / totalTime) * (totalQuestions * 5));
    }

    let totalScore = baseScore + bonusPoints;
    resultsMessage = `You answered ${questionsAnsweredCorrectly} out of ${totalQuestions} questions correctly. Your score is ${baseScore}.`;

    // Append information about incorrect questions
    if (incorrectQuestions.length > 0) {
        resultsMessage += ` Incorrect answers for questions: ${incorrectQuestions.join(', ')}.`;
    }

    if (bonusPoints > 0) {
        resultsMessage += ` You also earned ${bonusPoints} bonus points. Your total score is ${totalScore} points. Congratulations!`;
    } else {
        resultsMessage += ` Keep practicing to improve!`;
    }

    // Show the results message
    document.getElementById('results').textContent = resultsMessage;

    // Prepare the data to send via Fetch API
    let scoreData = new FormData();
    scoreData.append('score', totalScore);

    // Use Fetch API to send the score to the server
    fetch('php/submit_score.php', {
        method: 'POST',
        body: scoreData
    })
    .then(response => response.text())
    .then(data => {
        console.log('Server response:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    });

    document.getElementById('submitButton').disabled = true;
    quizStarted = false;
}
}
