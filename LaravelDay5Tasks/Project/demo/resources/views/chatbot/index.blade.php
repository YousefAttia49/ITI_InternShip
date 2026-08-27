<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Assistant - {{ config('app.name', 'Laravel') }}</title>
    <x-bootstrap-Css></x-bootstrap-Css>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .chat-container {
            max-width: 800px;
            margin: 30px auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: #fff;
            overflow: hidden;
        }
        .chat-header {
            background-color: #0d6efd;
            color: #fff;
            padding: 16px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .chat-box {
            height: 420px;
            overflow-y: auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .message-bubble {
            max-width: 75%;
            margin-bottom: 15px;
            padding: 12px 16px;
            border-radius: 18px;
            font-size: 0.95rem;
            line-height: 1.5;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .message-bot {
            background-color: #e9ecef;
            color: #212529;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
        }
        .message-user {
            background-color: #0d6efd;
            color: #ffffff;
            margin-left: auto;
            border-bottom-right-radius: 4px;
        }
        .message-error {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            margin-left: auto;
            margin-right: auto;
        }
        .quick-btn {
            font-size: 0.825rem;
            margin-right: 6px;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
    <x-navbar></x-navbar>

    <div class="container">
        <div class="chat-container border">
            <div class="chat-header">
                <div>
                    <span>🤖 Assistant Chatbot</span>
                    @if(Auth::user()->role === 'admin')
                        <span class="badge bg-warning text-dark ms-2">Admin Mode</span>
                    @else
                        <span class="badge bg-light text-dark ms-2">User Mode</span>
                    @endif
                </div>
                <small class="text-white-50">Online</small>
            </div>

            <div class="chat-box d-flex flex-column" id="chatBox">
                <div class="message-bubble message-bot">
                    @if(Auth::user()->role === 'admin')
                        Hello Admin <strong>{{ Auth::user()->name }}</strong>! 🤖<br>
                        How can I help you today? You can ask about products, your cart, or system statistics (users, categories, summary).
                    @else
                        Hello <strong>{{ Auth::user()->name }}</strong>! 🤖<br>
                        How can I help you today? Ask me about available products or your shopping cart.
                    @endif
                </div>
            </div>

            <div class="p-3 bg-white border-top">
                <div class="mb-2">
                    <small class="text-muted">Quick Actions:</small><br>
                    <button class="btn btn-outline-primary btn-sm quick-btn" onclick="sendQuick('Show products')">📦 Show Products</button>
                    <button class="btn btn-outline-success btn-sm quick-btn" onclick="sendQuick('Show my cart')">🛒 My Cart</button>
                    @if(Auth::user()->role === 'admin')
                        <button class="btn btn-outline-danger btn-sm quick-btn" onclick="sendQuick('Summary')">📊 Summary</button>
                        <button class="btn btn-outline-dark btn-sm quick-btn" onclick="sendQuick('Show users')">👥 Users</button>
                        <button class="btn btn-outline-secondary btn-sm quick-btn" onclick="sendQuick('Show categories')">📂 Categories</button>
                    @endif
                </div>

                <form id="chatForm" class="d-flex gap-2">
                    <input type="text" id="userInput" class="form-control" placeholder="Type your message..." autocomplete="off" required>
                    <button type="submit" class="btn btn-primary px-4" id="sendBtn">Send</button>
                </form>
            </div>
        </div>
    </div>

    <x-bootstrap-js></x-bootstrap-js>

    <script>
        const chatBox = document.getElementById('chatBox');
        const chatForm = document.getElementById('chatForm');
        const userInput = document.getElementById('userInput');
        const sendBtn = document.getElementById('sendBtn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function appendMessage(text, type) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('message-bubble', `message-${type}`);
            msgDiv.innerText = text;
            chatBox.appendChild(msgDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        async function sendMessage(text) {
            if (!text.trim()) return;

            appendMessage(text, 'user');
            userInput.value = '';
            sendBtn.disabled = true;

            try {
                const response = await fetch('{{ route("chatbot.message") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ message: text })
                });

                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }

                const data = await response.json();
                if (data.success === false) {
                    appendMessage(data.message, 'error');
                } else {
                    appendMessage(data.message, 'bot');
                }
            } catch (err) {
                appendMessage('An error occurred. Please try again.', 'error');
            } finally {
                sendBtn.disabled = false;
                userInput.focus();
            }
        }

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            sendMessage(userInput.value);
        });

        function sendQuick(text) {
            sendMessage(text);
        }
    </script>
</body>
</html>
