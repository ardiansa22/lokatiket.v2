<style>
    /* 🔹 Default Desktop */
    #chatbot-widget {
        bottom: 20px;
        right: 15px;
        z-index: 1050;
    }

    #chatbot-toggle {
        background-color: #17a2b8; /* Teal */
        border-color: #17a2b8;
        width: 60px;
        height: 60px;
        font-size: 24px;
        transition: transform 0.3s ease;
    }

    #chatbot-toggle:hover {
        transform: scale(1.1);
        background-color: #138496;
        border-color: #138496;
    }

    #chatbot-window {
        width: 380px;
        height: 550px;
        position: absolute;
        bottom: 80px;
        right: 0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        background: #fff;
    }

    /* 🔹 Header & Chat Style */
    #chatbot-window .card-header {
        background-color: #17a2b8 !important;
        color: white;
        font-weight: bold;
        padding: 1rem;
    }
    #chatbox {
        padding: 15px;
        background-color: #f8f9fa;
        height: 100%;
        font-size: 14px;
    }
    .user-message {
        background-color: #17a2b8;
        color: white;
        border-radius: 15px 15px 0 15px;
        padding: 8px 12px;
        max-width: 80%;
        display: inline-block;
        word-wrap: break-word;
    }
    .bot-message {
        background-color: white;
        color: #343a40;
        border: 1px solid #dee2e6;
        border-radius: 15px 15px 15px 0;
        padding: 8px 12px;
        max-width: 80%;
        display: inline-block;
        word-wrap: break-word;
    }

    /* 🔹 Mobile: Fullscreen */
    @media (max-width: 576px) {
        #chatbot-widget {
            bottom: 0;
            right: 0;
            left: 0;
            width: 100%;
        }

        #chatbot-toggle {
            position: fixed;
            bottom: 90px;
            right: 15px;
            width: 55px;
            height: 55px;
            font-size: 22px;
            z-index: 1100;
        }

        #chatbot-window {
            position: fixed !important;
            bottom: 0 !important;
            right: 0 !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            height: 100% !important;
            max-width: 100% !important;
            border-radius: 0 !important;
            z-index: 1099;
        }

        #chatbot-window .card-body {
            height: calc(100% - 130px);
        }
    }
</style>

<div id="chatbot-widget" class="position-fixed">
    <!-- 🔘 Tombol Toggle -->
    <button id="chatbot-toggle"
        class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center shadow-lg"
        onclick="toggleChatbot()">
        🤖
    </button>

    <!-- 🪟 Chat Window -->
    <div id="chatbot-window" class="card shadow-xl d-none">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <span style="font-size: 20px; margin-right: 10px;">🤖</span>
                <span>Chatbot Wisata Garut</span>
            </div>
            <button type="button" class="btn-close btn-close-white" aria-label="Tutup" onclick="toggleChatbot()"></button>
        </div>

        <div id="chatbox" class="card-body overflow-auto flex-grow-1">
            <div class="text-muted text-center mb-3 initial-message">
                Halo kak 👋 Saya adalah Chatbot Wisata Garut.<br>
                Tanyakan tentang rekomendasi tempat, rute, atau penginapan di Garut!
            </div>
        </div>

        <div class="card-footer p-2">
            <div class="input-group">
                <input id="message" type="text" class="form-control" placeholder="Tulis pesan..." 
                    onkeydown="if(event.key === 'Enter') sendMessage()">
                <button class="btn btn-primary" onclick="sendMessage()">
                    <span>Kirim</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleChatbot() {
        document.getElementById("chatbot-window").classList.toggle("d-none");
        let chatbox = document.getElementById("chatbox");
        if (!document.getElementById("chatbot-window").classList.contains("d-none")) {
            chatbox.scrollTop = chatbox.scrollHeight;
        }
    }

    async function sendMessage() {
        let messageInput = document.getElementById("message");
        let chatbox = document.getElementById("chatbox");
        let message = messageInput.value.trim();

        if (!message) return;

        const initialMessage = chatbox.querySelector('.initial-message');
        if (initialMessage) initialMessage.remove();

        // User message
        chatbox.innerHTML += `
            <div class="d-flex justify-content-end mb-3">
                <div class="user-message shadow-sm">${message}</div>
            </div>`;
        messageInput.value = "";
        chatbox.scrollTop = chatbox.scrollHeight;

        // Loading indicator
        const loadingIndicator = document.createElement('div');
        loadingIndicator.id = 'loading-indicator';
        loadingIndicator.className = 'd-flex justify-content-start mb-3';
        loadingIndicator.innerHTML = '<div class="bot-message shadow-sm"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Mengetik...</div>';
        chatbox.appendChild(loadingIndicator);
        chatbox.scrollTop = chatbox.scrollHeight; 

        try {
            let res = await fetch("{{ route('customer.chatbot.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    message: message,
                    session_id: "WEB-USER-001"
                })
            });

            let data = await res.json();
            console.log("Response dari server:", data);

            let reply = data.output ?? data.reply ?? data.answer ?? data.message ?? "Maaf, bot tidak merespons saat ini.";

            // Remove loading
            loadingIndicator.remove();

            // Bot reply
            chatbox.innerHTML += `
                <div class="d-flex justify-content-start mb-3">
                    <div class="bot-message shadow-sm">${reply}</div>
                </div>`;
            chatbox.scrollTop = chatbox.scrollHeight;

        } catch (error) {
            console.error("Error:", error);
            loadingIndicator.remove();

            chatbox.innerHTML += `
                <div class="text-center text-danger mb-3">❌ Error koneksi ke server. Silakan coba lagi.</div>`;
            chatbox.scrollTop = chatbox.scrollHeight;
        }
    }
</script>
