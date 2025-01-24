<x-layout>
  <x-slot name="title">Dashboard</x-slot>
  <div class="container mx-auto px-4 py-8">
      {{-- Card Section --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
          <!-- Card Total Pasien -->
          <div class="bg-gradient-to-br from-purple-500 via-pink-400 to-orange-300 shadow-lg hover:shadow-2xl 
                      rounded-lg overflow-hidden relative transition duration-300 ease-in-out">
              <div class="absolute inset-0 flex items-center justify-center">
                  <div class="text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-white drop-shadow-lg mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4.5v15m7.5-15V3a1.5 1.5 0 00-1.5-1.5H5A1.5 1.5 0 003.5 3v18a1.5 1.5 0 001.5 1.5h15a1.5 1.5 0 001.5-1.5V4.5h-6z" />
                      </svg>
                      <h2 class="text-xl font-semibold text-white mb-1">Total Pasien</h2>
                      <p class="text-3xl font-bold text-white">{{ $dataRingkasan['total_pasien'] }}</p>
                  </div>
              </div>
              <div style="padding-top: 100%;"></div> <!-- Membuat card persegi -->
          </div>

          <!-- Card Jumlah Alamat Unik -->
          <div class="bg-gradient-to-br from-cyan-400 via-teal-300 to-green-400 shadow-lg hover:shadow-2xl 
                      rounded-lg overflow-hidden relative transition duration-300 ease-in-out">
              <div class="absolute inset-0 flex items-center justify-center">
                  <div class="text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-white drop-shadow-lg mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0l6-6" />
                      </svg>
                      <h2 class="text-xl font-semibold text-white mb-1">Jumlah Alamat Unik</h2>
                      <p class="text-3xl font-bold text-white">{{ $dataRingkasan['jumlah_alamat_unik'] }}</p>
                  </div>
              </div>
              <div style="padding-top: 100%;"></div> <!-- Membuat card persegi -->
          </div>
          <div class="bg-gradient-to-br from-yellow-400 via-red-300 to-orange-300 shadow-lg hover:shadow-2xl 
                      rounded-lg overflow-hidden relative transition duration-300 ease-in-out">
              <div class="absolute inset-0 flex items-center justify-center">
                  <div class="text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-white drop-shadow-lg mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0l6-6" />
                      </svg>
                      <h2 class="text-xl font-semibold text-white mb-1">Jumlah SSR</h2>
                      <p class="text-3xl font-bold text-white">{{ $dataRingkasan['ssr'] }}</p>
                  </div>
              </div>
              <div style="padding-top: 100%;"></div> <!-- Membuat card persegi -->
          </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Chart 1 -->
        <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-black-200 mb-4">Statistik Pasien 1</h2>
            <canvas id="myChart1" class="w-full h-80"></canvas> {{-- tinggi chart fixed --}}
        </div>
    
        <!-- Chart 2 -->
        <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-black-200 mb-4">Statistik Pasien 2</h2>
            <canvas id="myChart2" class="w-full h-80"></canvas> {{-- tinggi chart fixed --}}
        </div>
    </div>
    <div x-data="chatBot()" class="fixed bottom-4 right-4">
        <!-- Tombol untuk membuka/menutup chatbot -->
        <button @click="toggleChat"
            class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M7.05 9.55a5 5 0 119.9 0 4.992 4.992 0 01-2.45 4.28M15 19l-3 3-3-3" />
            </svg>
        </button>
    
        <!-- Kotak Chatbot -->
        <div x-show="isChatOpen"
            class="fixed bottom-16 right-4 w-80 max-w-sm bg-white border border-gray-300 rounded-lg shadow-lg"
            x-transition>
            <!-- Header Chatbot -->
            <div class="flex items-center justify-between px-4 py-2 bg-gray-800 text-white rounded-t-lg">
                <h3 class="text-sm font-semibold">Chatbot</h3>
                <button @click="toggleChat" class="hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
    
            <!-- Konten Chat -->
            <div class="flex flex-col h-64 p-4">
                <!-- Daftar Pesan -->
                <div class="flex-1 overflow-y-auto space-y-3" x-ref="chatContainer">
                    <template x-for="(message, index) in messages" :key="index">
                        <div
                            :class="message.sender === 'user' ? 'text-sm text-blue-600 self-end text-right' : 'text-sm text-gray-600'">
                            <span x-text="message.text"></span>
                        </div>
                    </template>
                </div>
    
                <!-- Input Pesan -->
                <div class="mt-2">
                    <input type="text" x-model="userInput" @keydown.enter="sendMessage"
                        placeholder="Ketik pesan Anda..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Script Alpine.js -->
    <script>
        function chatBot() {
            return {
                isChatOpen: false,
                userInput: '',
                messages: [
                    { sender: 'bot', text: 'Halo! Selamat datang di Gemini Chatbot. Ada yang bisa saya bantu?' }
                ],
                toggleChat() {
                    this.isChatOpen = !this.isChatOpen;
                },
                async sendMessage() {
                    if (this.userInput.trim() === '') return;

                    // Tambahkan pesan pengguna ke tampilan
                    this.messages.push({ sender: 'user', text: this.userInput });

                    try {
                        // Kirim pesan ke server melalui API
                        const response = await fetch('https://generativelanguage.googleapis.com/v1beta/tunedModels/number-generator-model-eaev4sr6toyj:generateContent?key=AIzaSyDyUIrVQX9287PhOLyzhQuoyBrQ4pvlLxM', {
                            method: 'POST',
                            body: JSON.stringify({
                                contents: [
                                    {
                                        parts: [
                                        {
                                            text: this.userInput
                                        }
                                        ]
                                    }
                                    ]
                                }),
                            });

                        const data = await response.json();
                        console.log(data.candidates[0].content.parts[0].text);
                        try {
                            // Tambahkan respons chatbot
                            this.messages.push({ sender: 'bot', text: data.candidates[0].content.parts[0].text });
                        } catch {
                            // Tampilkan pesan error
                            this.messages.push({ sender: 'bot', text: 'Maaf, terjadi kesalahan. Coba lagi ya!' });
                        }
                    } catch (error) {
                        // Tampilkan error jika request gagal
                        this.messages.push({ sender: 'bot', text: 'Maaf, saya tidak dapat merespon saat ini.' });
                    }

                    // Bersihkan input pengguna
                    this.userInput = '';
                },
            };
        }
    </script>   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
    
    <script>
        const chartData = @json($data);
    
        // Chart 1 (Doughnut)
        const ctx1 = document.getElementById('myChart1');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Data LTFU 1',
                    data: chartData.values,
                    backgroundColor: [
                        'rgba(255, 105, 180, 0.6)',  // HotPink
                        'rgba(255, 99, 132, 0.6)',   // Red
                        'rgba(128, 0, 128, 0.6)',    // Purple
                        'rgba(75, 0, 130, 0.6)',     // Indigo
                        'rgba(102, 51, 153, 0.6)',   // Dark Purple
                        'rgba(153, 102, 255, 0.6)'   // Lavender
                    ],
                    borderColor: [
                        'rgba(255, 105, 180, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(128, 0, 128, 1)',
                        'rgba(75, 0, 130, 1)',
                        'rgba(102, 51, 153, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'rgba(75, 85, 99, 1)'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.formattedValue;
                            },
                            title: function(context) {
                                return context[0].label;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Statistik Data LTFU 1',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
    
        // Chart 2 (Bar)
        const ctx2 = document.getElementById('myChart2');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Data LTFU 2',
                    data: chartData.values,
                    backgroundColor: [
                        'rgba(32, 178, 170, 0.6)',  // SeaGreen
                        'rgba(50, 205, 50, 0.6)',   // LimeGreen
                        'rgba(0, 123, 255, 0.6)',   // DodgerBlue
                        'rgba(60, 179, 113, 0.6)',  // MediumSeaGreen
                        'rgba(0, 255, 255, 0.6)',   // Cyan
                        'rgba(0, 191, 255, 0.6)'    // DeepSkyBlue
                    ],
                    borderColor: [
                        'rgba(32, 178, 170, 1)',
                        'rgba(50, 205, 50, 1)',
                        'rgba(0, 123, 255, 1)',
                        'rgba(60, 179, 113, 1)',
                        'rgba(0, 255, 255, 1)',
                        'rgba(0, 191, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'rgba(75, 85, 99, 1)'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.formattedValue;
                            },
                            title: function(context) {
                                return context[0].label;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Statistik Data LTFU 2 (Diagram Batang)',
                        font: {
                            size: 16
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    

</x-layout>
