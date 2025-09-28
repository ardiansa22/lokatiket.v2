{{-- resources/views/layouts/chatbot.blade.php --}}
<div id="chatbot-widget">
    <!-- Tombol Toggle -->
    <button id="chatbot-toggle" onclick="toggleChatbot()">
        🤖
    </button>

    <!-- Jendela Chatbot -->
    <div id="chatbot-window" class="d-none">
        <div class="chatbot-header">
            <span>🤖 Chatbot Wisata Garut</span>
            <button class="close-btn" onclick="toggleChatbot()">✖</button>
        </div>

        <div id="chatbox" class="chatbot-body">
            <div class="initial-message">
                Halo kak 👋 Saya adalah Chatbot Wisata Garut.<br>
                Tanyakan tentang rekomendasi tempat, rute, atau penginapan di Garut!
            </div>
        </div>

        <div class="chatbot-footer">
            <input id="message" type="text" placeholder="Tulis pesan..." onkeydown="if(event.key === 'Enter') sendMessage()">
            <button onclick="sendMessage()">Kirim</button>
        </div>
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
/* Container widget */
#chatbot-widget {
    position: fixed;
    bottom: 80px;   /* lebih naik agar tidak terlalu nempel ke bawah */
    right: 20px;
    z-index: 9999;
}

/* Tombol toggle bulat */
#chatbot-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: none;
    background: #17a2b8;
    color: white;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: transform 0.2s;
}
#chatbot-toggle:hover {
    transform: scale(1.1);
    background: #138496;
}

/* Jendela chatbot */
#chatbot-window {
    position: absolute;
    bottom: 70px;
    right: 0;
    width: 350px;
    height: 500px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

/* Header */
.chatbot-header {
    background: #17a2b8;
    color: white;
    padding: 12px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.chatbot-header .close-btn {
    background: transparent;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
}

/* Body */
.chatbot-body {
    flex: 1;
    padding: 10px;
    background: #f8f9fa;
    overflow-y: auto;
    font-size: 14px;
}
.user-message {
    background: #17a2b8;
    color: white;
    border-radius: 15px 15px 0 15px;
    padding: 8px 12px;
    max-width: 75%;
    margin: 5px 0;
    align-self: flex-end;
}
.bot-message {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 15px 15px 15px 0;
    padding: 8px 12px;
    max-width: 75%;
    margin: 5px 0;
    align-self: flex-start;
}
.initial-message {
    text-align: center;
    color: #6c757d;
    margin: 10px 0;
}

/* Footer */
.chatbot-footer {
    display: flex;
    border-top: 1px solid #ddd;
}
.chatbot-footer input {
    flex: 1;
    border: none;
    padding: 10px;
    outline: none;
}
.chatbot-footer button {
    border: none;
    background: #17a2b8;
    color: white;
    padding: 10px 15px;
    cursor: pointer;
}
.chatbot-footer button:hover {
    background: #138496;
}

/* Responsif Mobile */
@media (max-width: 576px) {
    #chatbot-window {
        width: calc(100vw - 20px);
        height: calc(100vh - 100px);
        left: 50%;
        right: auto;
        transform: translateX(-50%);
    }
    #chatbot-toggle {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}
</style>

{{-- ================= SCRIPT ================= --}}
<script>
function toggleChatbot() {
    document.getElementById("chatbot-window").classList.toggle("d-none");
    let chatbox = document.getElementById("chatbox");
    chatbox.scrollTop = chatbox.scrollHeight;
}

async function sendMessage() {
    let input = document.getElementById("message");
    let chatbox = document.getElementById("chatbox");
    let msg = input.value.trim();
    if (!msg) return;

    // hapus initial message
    const init = chatbox.querySelector('.initial-message');
    if (init) init.remove();

    // tampilkan pesan user
    chatbox.innerHTML += `<div class="user-message">${msg}</div>`;
    input.value = "";
    chatbox.scrollTop = chatbox.scrollHeight;

    // tampilkan loading
    let loading = document.createElement('div');
    loading.className = 'bot-message';
    loading.innerHTML = 'Mengetik... ⏳';
    chatbox.appendChild(loading);
    chatbox.scrollTop = chatbox.scrollHeight;

    try {
        let res = await fetch("{{ route('customer.chatbot.send') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                message: msg,
                session_id: "WEB-USER-001"
            })
        });
        let data = await res.json();

        loading.remove();
        let reply = data.output ?? data.reply ?? data.message ?? "Bot tidak merespon.";
        chatbox.innerHTML += `<div class="bot-message">${reply}</div>`;
        chatbox.scrollTop = chatbox.scrollHeight;

    } catch (e) {
        loading.remove();
        chatbox.innerHTML += `<div class="bot-message">❌ Error koneksi.</div>`;
    }
}
</script>
