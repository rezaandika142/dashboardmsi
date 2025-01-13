<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>

<body class="h-full">

    <div class="min-h-full">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <x-header>{{ $title }}</x-header>

        <!-- Main Content -->
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
                <div x-data="{
                    isChatOpen: false,
                    messages: [
                        { text: 'Hi there! How can I assist you today?', sender: 'bot' }
                    ],
                    userInput: '',
                    async sendMessage() {
                        if (this.userInput.trim() === '') return;
                
                        // Tambahkan pesan pengguna ke UI
                        this.messages.push({ text: this.userInput, sender: 'user' });
                
                        // Simpan input sebelum dihapus
                        const userMessage = this.userInput;
                        this.userInput = '';
                
                        try {
                            // Panggil API untuk mendapatkan respons bot
                            const response = await axios.post(
                                'https://generativelanguage.googleapis.com/v1beta/tunedModels/mentari-sehat-indonesia-tune-model-agahv:generateContent?key=AIzaSyATZxxBzP5e129RhkO6BkT8ykFzNkpkfMg', {
                                    contents: [{
                                        parts: [{
                                            text: userMessage
                                        }]
                                    }]
                                }
                            );
                
                            // Validasi dan tangani respons API
                            const botReply = response?.data?.candidates?.[0]?.output ||
                                'Sorry, I didn\'t understand that. Please try again with a different query.';
                
                            // Tambahkan balasan bot ke UI
                            this.messages.push({ text: botReply, sender: 'bot' });
                        } catch (error) {
                            console.error('Error fetching content:', error);
                
                            // Tampilkan pesan error di UI
                            this.messages.push({ text: 'Oops! Something went wrong. Please try again later.', sender: 'bot' });
                        }
                
                        // Scroll otomatis ke bawah
                        this.scrollToBottom();
                    },
                    scrollToBottom() {
                        // Scroll ke bagian bawah ketika pesan baru muncul
                        this.$nextTick(() => {
                            const chatContainer = this.$refs.chatContainer;
                            if (chatContainer) {
                                chatContainer.scrollTop = chatContainer.scrollHeight;
                            }
                        });
                    }
                }">
                    <!-- Chatbot Button -->
                    <div class="fixed bottom-4 right-4">
                        <button @click="isChatOpen = true"
                            class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M7.05 9.55a5 5 0 119.9 0 4.992 4.992 0 01-2.45 4.28M15 19l-3 3-3-3" />
                            </svg>
                        </button>
                    </div>

                    <!-- Chat Modal -->
                    <div x-show="isChatOpen"
                        class="fixed bottom-16 right-4 w-80 max-w-sm bg-white border border-gray-300 rounded-lg shadow-lg"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-4">

                        <!-- Modal Header -->
                        <div class="flex items-center justify-between px-4 py-2 bg-gray-800 text-white rounded-t-lg">
                            <h3 class="text-sm font-semibold">Chatbot</h3>
                            <button @click="isChatOpen = false" class="hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <div class="flex flex-col h-64 p-4">
                            <!-- Chat Messages -->
                            <div class="flex-1 overflow-y-auto space-y-3" x-ref="chatContainer">
                                <template x-for="(message, index) in messages" :key="index">
                                    <div
                                        :class="message.sender === 'user' ? 'text-sm text-blue-600 self-end text-right' :
                                            'text-sm text-gray-600'">
                                        <span x-text="message.text"></span>
                                    </div>
                                </template>
                            </div>

                            <!-- Input Field -->
                            <div class="mt-2">
                                <input type="text" x-model="userInput" @keydown.enter="sendMessage"
                                    placeholder="Type your message..."
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Axios Script -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        async sendMessage() {
            if (this.userInput.trim() === '') return;

            // Tambahkan pesan pengguna ke UI
            this.messages.push({
                text: this.userInput,
                sender: 'user'
            });

            const userMessage = this.userInput;
            this.userInput = '';

            try {
                // Panggil endpoint Laravel
                const response = await axios.post('/chatbot/generate', {
                    message: userMessage
                });

                const botReply = response.data.reply || 'Maaf, saya tidak memahami permintaan Anda.';

                // Tambahkan balasan bot ke UI
                this.messages.push({
                    text: botReply,
                    sender: 'bot'
                });
            } catch (error) {
                console.error('Error fetching content:', error);

                // Tampilkan pesan error di UI
                this.messages.push({
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    sender: 'bot'
                });
            }

            // Scroll otomatis ke bawah
            this.scrollToBottom();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
