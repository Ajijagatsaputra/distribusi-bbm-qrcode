<!DOCTYPE html>
<html class="light" lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Pertamina - @yield('title', 'Super Admin Monitoring Dashboard')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "pertamina-blue": "#005eb8",
                        "pertamina-red": "#ed161f",
                        "pertamina-green": "#7abb3a",
                        "background-light": "#f4f7fb",
                        "background-dark": "#0f172a",
                    },
                    fontFamily: { "sans": ["Outfit", "sans-serif"] },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(0, 94, 184, 0.05)',
                        'glow-blue': '0 0 20px rgba(0, 94, 184, 0.3)',
                        'glow-red': '0 0 20px rgba(237, 22, 31, 0.3)',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 4s ease-in-out infinite',
                    }
                },
            },
        }
    </script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* Glassmorphism Classes */
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .dark .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #005eb8, #0099ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 94, 184, 0.2);
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark min-h-screen text-slate-800 dark:text-slate-100 overflow-x-hidden">

    <!-- Ambient Backgrounds -->
    <div
        class="fixed top-0 left-0 w-full h-80 bg-gradient-to-b from-pertamina-blue/10 to-transparent pointer-events-none -z-10">
    </div>
    <div
        class="fixed top-[-10%] right-[-5%] w-[40%] h-[40%] rounded-full bg-pertamina-blue/10 blur-[120px] pointer-events-none -z-10">
    </div>

    <div class="flex min-h-screen relative z-10">
        {{-- SIDEBAR --}}
        <x-superadmin.sidebar />

        {{-- MAIN --}}
        <main class="flex flex-col flex-1 min-h-screen ml-72">
            <x-superadmin.header />

            {{-- PAGE CONTENT --}}
            <div class="p-10 space-y-8 max-w-[1400px] w-full mx-auto">
                @yield('content')
            </div>

        </main>
    </div>

</body>

</html>