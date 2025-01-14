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
