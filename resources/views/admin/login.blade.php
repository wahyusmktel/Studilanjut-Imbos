<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Administrator - Studi Lanjut IMBOS Pringsewu</title>
    <meta name="description" content="Login to Studi Lanjut IMBOS Pringsewu Admin Dashboard" />
    
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for immediate high-quality styles) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>

    <!-- SweetAlert2 for modern alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .pattern-bg {
            background-color: #f8fafc;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9; 
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }
    </style>
</head>
<body class="pattern-bg min-h-screen flex items-center justify-center p-4 sm:p-8">

    <div class="max-w-5xl w-full bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-100">
        
        <!-- Left Side - Branding / Graphic -->
        <div class="md:w-5/12 text-white flex flex-col justify-between relative overflow-hidden group">
            <!-- Background Image overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-brand-600 to-brand-900 z-0"></div>
            
            <!-- Abstract decorative elements -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-white opacity-10 blur-3xl transition-transform duration-700 group-hover:scale-110"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 rounded-full bg-brand-400 opacity-20 blur-2xl transition-transform duration-700 group-hover:scale-110"></div>
            
            <!-- Content -->
            <div class="relative z-10 p-10 lg:p-12 h-full flex flex-col justify-between">
                <div>
                    <img src="{{ asset('img/logo-imbos.png') }}" alt="Logo IMBOS" class="h-14 mb-8 bg-white/20 p-2.5 rounded-2xl backdrop-blur-md border border-white/30" onerror="this.style.display='none'">
                    
                    <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-4 tracking-tight">
                        Portal Administrator
                    </h1>
                    <p class="text-brand-100 text-base font-light leading-relaxed opacity-90">
                        Sistem Informasi Manajemen Studi Lanjut Terpadu. Kelola data siswa dan laporan secara efisien.
                    </p>
                </div>
                
                <div class="mt-12">
                    <div class="flex items-center space-x-4 glass p-4 rounded-2xl">
                        <div class="p-3 bg-white/20 rounded-xl shadow-inner">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm tracking-wide">Secure Connection</h4>
                            <p class="text-xs text-brand-100 mt-1 opacity-80">Enkripsi data berlapis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="md:w-7/12 p-8 sm:p-12 lg:p-16 bg-white flex flex-col justify-center">
            
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Login Akun</h2>
                <p class="mt-2 text-gray-500 text-sm font-medium">Silakan masukkan kredensial Anda untuk masuk.</p>
            </div>

            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-1">
                    <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-brand-500 text-gray-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="username" name="username" required 
                            class="block w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 bg-gray-50/50 hover:bg-gray-50 focus:bg-white transition-all duration-300 outline-none shadow-sm" 
                            placeholder="Ketik username Anda"
                            autocomplete="username">
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-brand-500 text-gray-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                            class="block w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 bg-gray-50/50 hover:bg-gray-50 focus:bg-white transition-all duration-300 outline-none shadow-sm" 
                            placeholder="Ketik password Anda"
                            autocomplete="current-password">
                        
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors" onclick="togglePassword()">
                            <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                            class="h-4.5 w-4.5 text-brand-600 focus:ring-brand-500/50 border-gray-300 rounded cursor-pointer transition-colors bg-gray-50">
                        <label for="remember" class="ml-2 block text-sm font-medium text-gray-600 cursor-pointer select-none">
                            Ingat sesi saya
                        </label>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-500/30 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transform transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">
                        Masuk Dashboard
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center md:text-left border-t border-gray-100 pt-6">
                <p class="text-xs text-gray-400 font-medium tracking-wide">&copy; {{ date('Y') }} Studi Lanjut IMBOS Pringsewu. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Script for Toggling Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>

    <!-- Beautiful SweetAlert2 Error Messages -->
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Gagal Login!',
                text: 'Periksa kembali username atau password Anda.',
                icon: 'error',
                confirmButtonText: 'Coba Lagi',
                buttonsStyling: false,
                customClass: {
                    popup: 'rounded-[2rem] p-6',
                    title: 'text-2xl font-bold text-gray-800',
                    htmlContainer: 'text-gray-500',
                    confirmButton: 'mt-6 w-full flex justify-center py-3 px-4 rounded-xl text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 transition duration-200 shadow-md shadow-brand-500/20'
                }
            });
        });
    </script>
    @endif

</body>
</html>
