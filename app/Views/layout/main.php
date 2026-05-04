<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megavision Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="text-gray-800 antialiased">

    <!-- Area Konten Utama -->
    <div class="min-h-screen flex">
        
        <!-- Sidebar (Diperlebar jadi w-64 agar teks muat) -->
        <aside class="w-16 bg-gray-900 text-white hidden md:flex flex-col">
            <!-- Brand / Logo -->
            <div class="p-4 border-b border-gray-800">
                <span class="text-2xl font-bold tracking-wider">M</span>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 px-2 py-6 space-y-2">
                <!-- Menu 1 (Aktif) -->
                <a href="#" class="flex justify-center mb-4 mb-4 px-3 py-2 rounded-lg bg-primary text-white hover:bg-blue-600 transition-colors">
                    <i class="fas fa-home w-5 text-center"></i>
                </a>

                <!-- Menu 2 -->
                <a href="#" class="flex justify-center mb-4 mb-4 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                    <i class="fas fa-users w-5 text-center"></i>
                </a>

                <!-- Menu 3 -->
                <a href="#" class="flex justify-center mb-4 mb-4 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                    <i class="fas fa-cog w-5 text-center"></i>
                </a>
            </nav>

            <!-- Footer Sidebar (Opsional, untuk tombol logout dll) -->
            <div class="p-2 border-t border-gray-800">
                <a href="<?= base_url('/logout') ?>" class="flex items-center gap-3 px-4 py-2 text-gray-400 hover:text-red-400 transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col bg-gray-50 min-w-0 overflow-x-hidden">
            <!-- Navbar -->
            <header class="h-16 bg-white shadow-sm flex items-center px-6 border-b border-gray-200">
                <span class="font-semibold text-lg text-gray-700">Dashboard Utama</span>
            </header>

            <!-- Bagian ini akan otomatis diisi oleh halaman yang dipanggil -->
            <div class="p-6">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
        
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1d4ed8', // Warna biru untuk menu aktif
                    }
                }
            }
        }
   </script>

</body>
</html>