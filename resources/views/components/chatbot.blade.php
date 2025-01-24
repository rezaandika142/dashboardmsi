<div x-data="chatBot()" class="fixed bottom-4 right-4">
    <button @click="toggleChat"
        class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M7.05 9.55a5 5 0 119.9 0 4.992 4.992 0 01-2.45 4.28M15 19l-3 3-3-3" />
        </svg>
    </button>

    <div x-show="isChatOpen"
        class="fixed bottom-16 right-4 w-80 max-w-sm bg-white border border-gray-300 rounded-lg shadow-lg"
        x-transition>
        <div class="flex items-center justify-between px-4 py-2 bg-gray-800 text-white rounded-t-lg">
            <h3 class="text-sm font-semibold">Chatbot</h3>
            <button @click="toggleChat" class="hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex flex-col h-64 p-4">
            <div class="flex-1 overflow-y-auto space-y-3" x-ref="chatContainer">
                <template x-for="(message, index) in messages" :key="index">
                    <div
                        :class="message.sender === 'user' ? 'text-sm text-blue-600 self-end text-right' : 'text-sm text-gray-600'">
                        <span x-text="message.text"></span>
                    </div>
                </template>
            </div>
            <div class="mt-2" x-url=>
                <input type="text" x-model="userInput" @keydown.enter="sendMessage"
                    placeholder="Type your message..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('chatForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const message = document.getElementById('userMessage').value;

        // Kirim permintaan ke server
        const response = await fetch('/chatbot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ message }),
        });

        const data = await response.json();
        document.getElementById('chatResponse').textContent = data.reply;
    });
</script>