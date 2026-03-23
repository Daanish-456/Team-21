<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Stone & Soul')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/logo-stone-soul.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/chatbot.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/productcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/footer.css') }}">

    @stack('styles')
</head>
<body>
    @include('components.navbar')

    @if(request()->routeIs('home'))
        @yield('content')
    @else
        <div class="content-container">
            @yield('content')
        </div>
    @endif

    @include('components.footer')

    <div id="chat-toggle">💬</div>

    <div id="chatbot">
        <div class="chat-header">
            <span>Stone & Soul</span>
        </div>

        <div class="chat-body">
            <div class="bot-message">
                Thank you for visiting Stone & Soul. I'm here to help
            </div>
        </div>

        <div class="chat-input-area">
            <input id="chat-input" type="text" placeholder="Enter your message..." />
            <button id="send-btn" type="button">➤</button>
        </div>
    </div>

    <script>
        (function () {
            const root = document.documentElement;

            function applyTheme(theme) {
                root.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);

                const toggle = document.getElementById('themeToggle');
                if (toggle) {
                    toggle.checked = (theme === 'dark');
                }
            }

            const saved = localStorage.getItem('theme');
            applyTheme(saved || 'light');

            window.addEventListener('DOMContentLoaded', () => {
                const toggle = document.getElementById('themeToggle');
                if (!toggle) return;

                toggle.addEventListener('change', () => {
                    applyTheme(toggle.checked ? 'dark' : 'light');
                });
            });
        })();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById("chat-toggle");
            const chatbot = document.getElementById("chatbot");
            const input = document.getElementById("chat-input");
            const body = document.querySelector(".chat-body");
            const sendBtn = document.getElementById("send-btn");

            if (!toggle || !chatbot || !input || !body || !sendBtn) return;

            toggle.addEventListener("click", function () {
                if (chatbot.style.display === "flex") {
                    chatbot.style.display = "none";
                } else {
                    chatbot.style.display = "flex";
                }
            });

            function sendMessage() {
                const msg = input.value.trim();
                if (!msg) return;

                body.innerHTML += `<div class="user-message">${msg}</div>`;

                let reply = "I'm not sure, but we can help!";

                if (msg.toLowerCase().includes("delivery")) {
                    reply = "UK delivery takes 3–5 days.";
                } else if (msg.toLowerCase().includes("return")) {
                    reply = "You can return items within 14 days.";
                } else if (msg.toLowerCase().includes("ring size")) {
                    reply = "We can help you choose the right ring size from our guide.";
                } else if (msg.toLowerCase().includes("contact")) {
                    reply = "You can contact our team through the contact page or email customer care.";
                }

                setTimeout(() => {
                    body.innerHTML += `<div class="bot-message">${reply}</div>`;
                    body.scrollTop = body.scrollHeight;
                }, 500);

                body.scrollTop = body.scrollHeight;
                input.value = "";
            }

            sendBtn.addEventListener("click", sendMessage);

            input.addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                    sendMessage();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>