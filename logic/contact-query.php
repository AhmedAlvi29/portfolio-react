<?php
 require "../php-db/db.config.php";
 
 if(isset($_POST['submit'])) {
     // Process the form data here
    $name    = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Name'])));
$company = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Company'])));
$email   = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['E-mail'])));
$phone   = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Phone'])));
$message = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Message'])));


$contact_query = "INSERT INTO contact_form (name, company_name, email, phone, message) VALUES ('$name', '$company', '$email', '$phone', '$message')";
if (mysqli_query($db, $contact_query)) {
    echo '
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap");
        
        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: #fff;
            font-family: "Orbitron", monospace;
            animation: fadeIn 0.5s ease-in;
        }
        
        .success-container {
            text-align: center;
            padding: 40px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            max-width: 500px;
            animation: slideUp 0.8s ease-out;
        }
        
        .success-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
            color: #ffffff;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        }
        
        .success-title {
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 15px;
            background: linear-gradient(45deg, #ffffff, #cccccc, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .success-message {
            font-size: 16px;
            margin-bottom: 30px;
            color: #cccccc;
            font-weight: 400;
            line-height: 1.6;
        }
        
        .countdown-container {
            margin-top: 30px;
        }
        
        .countdown-text {
            font-size: 14px;
            color: #999;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .countdown-number {
            font-size: 48px;
            font-weight: 900;
            color: #ffffff;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            animation: countdownPulse 1s infinite;
        }
        
        .loading-bar {
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            margin: 20px auto;
            overflow: hidden;
        }
        
        .loading-progress {
            height: 100%;
            background: linear-gradient(90deg, #ffffff, #cccccc);
            width: 0%;
            border-radius: 2px;
            animation: loadingAnimation 6s linear forwards;
        }
        
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #ffffff;
            border-radius: 50%;
            animation: float 6s infinite linear;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                transform: translateY(50px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        @keyframes countdownPulse {
            0%, 100% { 
                transform: scale(1);
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            }
            50% { 
                transform: scale(1.2);
                text-shadow: 0 0 30px rgba(255, 255, 255, 1);
            }
        }
        
        @keyframes loadingAnimation {
            from { width: 0%; }
            to { width: 100%; }
        }
        
        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(0px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10px) translateX(100px);
                opacity: 0;
            }
        }
        
        @media (max-width: 768px) {
            .success-container {
                margin: 20px;
                padding: 30px 20px;
            }
            
            .success-title {
                font-size: 24px;
            }
            
            .success-icon {
                font-size: 60px;
            }
            
            .countdown-number {
                font-size: 36px;
            }
        }
    </style>
    
    <div class="success-overlay">
        <div class="particles"></div>
        <div class="success-container">
            <div class="success-icon">✓</div>
            <h1 class="success-title">Message Submited</h1>
            <p class="success-message">Your contact request has been successfully transmitted to our servers. We will get back to you soon!</p>
            
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
            
            <div class="countdown-container">
                <p class="countdown-text">Redirecting in</p>
                <div class="countdown-number" id="countdown">6</div>
            </div>
        </div>
    </div>
    
    <script>
        // Create floating particles
        function createParticles() {
            const particles = document.querySelector(".particles");
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement("div");
                particle.className = "particle";
                particle.style.left = Math.random() * 100 + "%";
                particle.style.animationDelay = Math.random() * 6 + "s";
                particle.style.animationDuration = (Math.random() * 3 + 3) + "s";
                particles.appendChild(particle);
            }
        }
        
        // Countdown timer
        let timeLeft = 6;
        const countdownElement = document.getElementById("countdown");
        
        const countdown = setInterval(() => {
            timeLeft--;
            countdownElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                countdownElement.textContent = "0";
                
                // Add fade out effect before redirect
                document.querySelector(".success-overlay").style.animation = "fadeIn 0.5s ease-out reverse";
                
                setTimeout(() => {
                    window.location.href = "http://ahmedportfolio.infinityfreeapp.com/";
                }, 300);
            }
        }, 1000);
        
        // Initialize particles
        createParticles();
        
        // Prevent scrolling
        document.body.style.overflow = "hidden";
    </script>
    ';
    
} else {
    echo '<div style="
        padding: 15px;
        margin: 15px 0;
        border: 2px solid #f44336;
        background-color: #ffeaea;
        color: #c62828;
        font-family: Arial, sans-serif;
        border-radius: 8px;
        box-shadow: 0px 3px 8px rgba(0,0,0,0.15);
    ">
        ❌ <strong>Error:</strong> ' . htmlspecialchars(mysqli_error($db)) . '
    </div>';
}
}
?>