<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex w-full min-h-screen">
        <!-- Left Side - Brand Section -->
        <div class="relative hidden overflow-hidden lg:flex lg:w-1/2 bg-slate-900">
            <img alt="Industrial Fuel Distribution"
                class="absolute inset-0 object-cover w-full h-full opacity-60 mix-blend-overlay"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDttZvphmBuEE41WrE2vqOXHqUqs0jkQUdNiqHcT6m4wxT0rs_dDTFaaD0CeAEg_rnNw7tC254PNg3VjDOPiM6Dck3xx82LCjfyJX39X3z3BHRQqe-uslJZeDhHOQ97ViyCiFxC982fK_LDlgDrzq3jGCTRtRrppnPl-yBhF6fa1kvhnDNSxD4Atqd4D1QyPtJLuN3bPSFZVr-5T8V8BhYRqIcwDCMEn90t7dAtsvGH9nuijOXsJrVAi3gAs6oSIrFeY4E0cBe-6w" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
            <div class="relative z-10 flex flex-col justify-between w-full p-16">
                <div class="flex items-center gap-3">
                    {{-- <div class="p-2 bg-white/10 backdrop-blur-md rounded-xl">
                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 48 48"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 42.4379C4 42.4379 14.0962 36.0744 24 41.1692C35.0664 46.8624 44 42.2078 44 42.2078L44 7.01134C44 7.01134 35.0664 11.6577 24.0031 5.96913C14.0971 0.876274 4 7.27094 4 7.27094L4 42.4379Z"
                                fill="currentColor"></path>
                        </svg>
                    </div> --}}
                    {{-- <span class="text-xl font-bold tracking-tight text-white">FuelSystem v2.4</span> --}}
                </div>
                <div class="max-w-xl">
                    <h1 class="mb-6 text-5xl font-extrabold leading-tight tracking-tight text-white">
                        Sistem Informasi <br />
                        <span class="text-blue-400">Distribusi BBM</span>
                    </h1>
                    <p class="text-lg font-light leading-relaxed text-slate-300">
                        Integrated platform for managing high-efficiency fuel supply chains, monitoring inventory
                        levels, and optimizing logistics nationwide.
                    </p>
                </div>
                <div class="text-sm text-slate-400">
                    © 2025 Enterprise Fuel Distribution System • Internal Access Only
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white/80 backdrop-blur-sm lg:bg-white shadow-[-20px_0_50px_rgba(0,0,0,0.05)]">
            <div class="w-full max-w-[420px]">
                <!-- Mobile Logo -->
                <div class="flex justify-center mb-8 lg:hidden">
                    <div class="flex items-center gap-3 text-primary">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 42.4379C4 42.4379 14.0962 36.0744 24 41.1692C35.0664 46.8624 44 42.2078 44 42.2078L44 7.01134C44 7.01134 35.0664 11.6577 24.0031 5.96913C14.0971 0.876274 4 7.27094 4 7.27094L4 42.4379Z"
                                fill="currentColor"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-slate-900">SID-BBM</h2>
                    </div>
                </div>

                <!-- Header -->
                <div class="mb-10 text-left lg:text-left">
                    <h2 class="mb-3 text-3xl font-bold tracking-tight text-slate-900">Welcome back</h2>
                    <p class="font-medium text-slate-500">Please enter your credentials to access the system.</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block px-1 text-sm font-semibold text-slate-700">Email Address</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">mail</span>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full h-12 pl-12 pr-4 transition-all border shadow-sm outline-none rounded-xl border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary placeholder:text-slate-400 text-slate-900"
                                placeholder="name@company.com" />
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between px-1">
                            <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-bold transition-colors text-primary hover:text-dark-blue"
                                    href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">lock</span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="w-full h-12 pl-12 pr-12 transition-all border shadow-sm outline-none rounded-xl border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary placeholder:text-slate-400 text-slate-900"
                                placeholder="••••••••" />
                            <button
                                class="absolute transition-colors -translate-y-1/2 right-4 top-1/2 text-slate-400 hover:text-slate-600"
                                type="button"
                                onclick="togglePassword()">
                                <span class="material-symbols-outlined text-[20px]" id="toggleIcon">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between py-1">
                        <div class="flex items-center gap-3">
                            <label for="remember_me" class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" id="remember_me" name="remember" type="checkbox" />
                                <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                </div>
                            </label>
                            <span class="text-sm font-medium cursor-pointer select-none text-slate-600"
                                onclick="document.getElementById('remember_me').click()">
                                Keep me logged in
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        class="flex items-center justify-center w-full gap-2 font-bold text-white transition-all shadow-lg h-14 bg-primary hover:bg-dark-blue rounded-xl shadow-primary/25 hover:shadow-primary/40 group"
                        type="submit">
                        <span>Sign In</span>
                        <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>

                <!-- Support Link -->
                <div class="mt-10 text-center">
                    <p class="text-sm text-slate-500">
                        Facing issues? <a class="font-bold text-primary hover:underline" href="#">Contact Support</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = 'visibility';
            }
        }
    </script>
</x-guest-layout>
