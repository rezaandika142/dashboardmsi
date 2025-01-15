<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="h-full">

    <div class="min-h-full">
        <x-navbar></x-navbar>
        <x-header>{{ $title ?? 'Default Title' }}</x-header> {{-- Judul default jika $title tidak diset --}}

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}

                <div x-data="chatBot()" class="fixed bottom-4 right-4"> {{-- Inisialisasi di luar div --}}
                    <button @click="toggleChat"
                        class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                                    <div :class="message.sender === 'user' ? 'text-sm text-blue-600 self-end text-right' : 'text-sm text-gray-600'">
                                        <span x-text="message.text"></span>
                                    </div>
                                </template>
                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function chatBot() {
            return {
                isChatOpen: false,
                messages: [{
                    text: 'Halo saya Chatbot. Apa yang bisa saya bantu?',
                    sender: 'bot'
                }],
                userInput: '',
                toggleChat() {
                    this.isChatOpen = !this.isChatOpen;
                    if (this.isChatOpen) {
                        this.$nextTick(() => this.scrollToBottom());
                    }
                },
                async sendMessage() {
                    if (this.userInput.trim() === '') return;

                    this.messages.push({
                        text: this.userInput,
                        sender: 'user'
                    });

                    const userMessage = this.userInput;
                    this.userInput = '';

                    try {
                        const response = await axios.post('/chatbot/generate', {
                            message: userMessage
                        });

                        if (response.data && response.data.reply) {
                            this.messages.push({
                                text: response.data.reply,
                                sender: 'bot'
                            });
                        } else {
                            this.messages.push({
                                text: 'Maaf, format balasan tidak sesuai.',
                                sender: 'bot'
                            });
                            console.error('Invalid API response:', response);
                        }

                    } catch (error) {
                        console.error('Error fetching content:', error);
                        this.messages.push({
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            sender: 'bot'
                        });
                    }

                    this.scrollToBottom();
                },
                scrollToBottom() {
                    this.$nextTick(() => {
                        const chatContainer = this.$refs.chatContainer;
                        if (chatContainer) {
                            chatContainer.scrollTop = chatContainer.scrollHeight;
                        }
                    });
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
