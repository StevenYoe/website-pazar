<!--
404.blade.php

This Blade template renders a custom 404 (Page Not Found) error page for the Laravel application.
It features a visually engaging design with animated backgrounds, floating icons, and interactive effects.
All major sections, styles, and scripts are commented to help programmers understand the structure and logic.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('errors.404_title') ?? 'Page Not Found' }}</title>
    <meta name="description" content="{{ __('errors.404_description') ?? 'The page you are looking for could not be found.' }}">
    
    <style>
        /*
         * Global and layout styles for the 404 error page.
         * Includes background, container, and responsive adjustments.
         */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .error-page-body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(139,69,19,0.3)), 
                        url({{ asset('img/Web/Error_404.gif') }}) center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .error-container {
            text-align: center;
            color: white;
            z-index: 10;
            animation: fadeInUp 1s ease-out;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            margin: 0 20px;
        }

        /*
         * Error code, title, and message styles
         */
        .error-code {
            font-size: clamp(4rem, 15vw, 8rem);
            font-weight: 900;
            background: linear-gradient(45deg, #ff6b6b, #ffa500, #ff1744);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite, bounce 2s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(255, 107, 107, 0.5);
            margin-bottom: 1rem;
            line-height: 0.9;
        }
        
        .error-title {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            animation: slideInLeft 1s ease-out 0.3s both;
        }
        
        .error-message {
            font-size: clamp(1rem, 2.5vw, 1.2rem);
            margin-bottom: 2rem;
            line-height: 1.6;
            opacity: 0.9;
            animation: slideInRight 1s ease-out 0.6s both;
        }
        
        /*
         * Button styles for navigation actions
         */
        .buttons-container {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeIn 1s ease-out 0.9s both;
        }
        
        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #764ba2, #667eea);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.6);
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
        }
        
        /*
         * Floating animated icons for visual effect
         */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .floating-element {
            position: absolute;
            font-size: 2rem;
            opacity: 0.5;
            animation: float 6s ease-in-out infinite;
        }
        
        /*
         * Each floating element has a unique position, color, and animation delay
         */
        .floating-element:nth-child(1) { top: 20%; left: 10%; animation-delay: -2s; color: #ff6b6b; }
        .floating-element:nth-child(2) { top: 60%; right: 10%; animation-delay: -4s; color: #4ecdc4; }
        .floating-element:nth-child(3) { bottom: 20%; left: 20%; animation-delay: -1s; color: #45b7d1; }
        .floating-element:nth-child(4) { top: 10%; right: 30%; animation-delay: -3s; color: #f9ca24; }
        .floating-element:nth-child(5) { top: 40%; left: 5%; animation-delay: -5s; color: #ff9ff3; }
        .floating-element:nth-child(6) { bottom: 40%; left: 20%; animation-delay: -0.5s; color: #54a0ff; }
        .floating-element:nth-child(7) { top: 85%; left: 30%; animation-delay: -2.5s; color: #5f27cd; }
        .floating-element:nth-child(8) { top: 30%; right: 5%; animation-delay: -4.5s; color: #00d2d3; }
        .floating-element:nth-child(9) { top: 10%; left: 30%; animation-delay: -1.5s; color: #ff6348; }
        .floating-element:nth-child(10) { top: 70%; right: 25%; animation-delay: -3.5s; color: #2ed573; }
        .floating-element:nth-child(11) { bottom: 5%; left: 60%; animation-delay: -0.8s; color: #ffa502; }
        .floating-element:nth-child(12) { top: 50%; left: 80%; animation-delay: -2.8s; color: #a4b0be; }
        
        /*
         * Keyframes for fade, slide, bounce, gradient, and float animations
         */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes gradientShift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
        @keyframes bounce { 0%, 20%, 50%, 80%, 100% { transform: translateY(0); } 40% { transform: translateY(-10px); } 60% { transform: translateY(-5px); } }
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 33% { transform: translateY(-20px) rotate(120deg); } 66% { transform: translateY(10px) rotate(240deg); } }
        
        /*
         * Responsive adjustments for mobile
         */
        @media (max-width: 768px) {
            .error-container { padding: 2rem 1.5rem; }
            .buttons-container { flex-direction: column; align-items: center; }
            .btn { width: 100%; max-width: 250px; }
        }
        
        /*
         * Glitch effect for the error code for extra flair
         */
        .glitch { position: relative; }
        
        .glitch::before,
        .glitch::after {
            content: '404';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.8;
        }
        
        .glitch::before { animation: glitch-1 2s infinite; color: #ff0000; z-index: -1; }
        .glitch::after { animation: glitch-2 2s infinite; color: #00ff00; z-index: -2; }
        @keyframes glitch-1 { 0%, 14%, 15%, 49%, 50%, 99%, 100% { transform: translate(0); } 15%, 49% { transform: translate(-2px, 2px); } }
        @keyframes glitch-2 { 0%, 20%, 21%, 62%, 63%, 99%, 100% { transform: translate(0); } 21%, 62% { transform: translate(2px, -2px); } }
        @keyframes sparkle { 0% { transform: scale(0) rotate(0deg); opacity: 1; } 100% { transform: scale(1) rotate(180deg); opacity: 0; } }
        
        /*
         * Dark mode adjustments for secondary button
         */
        .dark .btn-secondary { border-color: rgba(255, 255, 255, 0.7); }
        .dark .btn-secondary:hover { background: rgba(255, 255, 255, 0.2); border-color: white; }
    </style>
</head>
<body>
    <!--
        Main error page layout: floating icons, error container, and navigation buttons
    -->
    <div class="error-page-body">
        <div class="floating-elements">
            <!-- Animated floating icons for visual effect -->
            <div class="floating-element">⚠️</div>
            <div class="floating-element">🔍</div>
            <div class="floating-element">💔</div>
            <div class="floating-element">🚫</div>
            <div class="floating-element">❌</div>
            <div class="floating-element">🌐</div>
            <div class="floating-element">📄</div>
            <div class="floating-element">🔗</div>
            <div class="floating-element">⭐</div>
            <div class="floating-element">🎯</div>
            <div class="floating-element">📍</div>
            <div class="floating-element">💫</div>
        </div>
        <div class="error-container">
            <!-- Error code with glitch effect -->
            <div class="error-code glitch">404</div>
            <!-- Error title and message (localized) -->
            <h1 class="error-title">{{ __('errors.404_title') }}</h1>
            <p class="error-message">
                {{ __('errors.404_message') }}
            </p>
            <!-- Navigation buttons: go home or go back -->
            <div class="buttons-container">
                <a href="{{ route('index') }}" class="btn btn-primary">{{ __('errors.go_home') }}</a>
                <button class="btn btn-secondary" onclick="goBack()">{{ __('errors.go_back') }}</button>
            </div>
        </div>
    </div>
    <script>
        // Go back to previous page or home if no history
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '{{ route('index') }}';
            }
        }
        // Add interactive sparkle effects on mouse move
        document.addEventListener('mousemove', function(e) {
            if (Math.random() > 0.9) {
                createSparkle(e.clientX, e.clientY);
            }
        });
        function createSparkle(x, y) {
            const sparkle = document.createElement('div');
            sparkle.style.position = 'fixed';
            sparkle.style.left = x + 'px';
            sparkle.style.top = y + 'px';
            sparkle.style.width = '4px';
            sparkle.style.height = '4px';
            sparkle.style.background = '#fff';
            sparkle.style.borderRadius = '50%';
            sparkle.style.pointerEvents = 'none';
            sparkle.style.zIndex = '1000';
            sparkle.style.animation = 'sparkle 1s ease-out forwards';
            document.body.appendChild(sparkle);
            setTimeout(() => {
                sparkle.remove();
            }, 1000);
        }
        // Log a message or play a sound when the page loads (optional)
        window.addEventListener('load', function() {
            console.log('{{ __('errors.page_loaded') ?? 'Page loaded' }}');
        });
    </script>
</body>
</html>