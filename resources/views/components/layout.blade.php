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

                {{-- <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                {{ __("You're logged in!") }}
            
                                <x-chatbot></x-chatbot> Menambahkan komponen chatbot di sini 
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- <script>
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
                        const response = await axios.post('{{ route('chatbot.generate') }}', {
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
                        this.scrollToBottom();
    
                    } catch (error) {
                        console.error('Error fetching content:', error);
                        this.messages.push({
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            sender: 'bot'
                        });
                        this.scrollToBottom();
                    }
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
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
