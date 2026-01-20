<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Sistem Informasi Distribusi BBM</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style type="text/tailwindcss">
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
        }

        @layer base {
            body {
                @apply font-['Inter'] antialiased;
            }
        }
    </style>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2563eb",
                        "dark-blue": "#1e3a8a",
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-gradient-to-br from-[#f8fafc] to-[#e2e8f0] min-h-screen flex overflow-hidden">
    {{ $slot }}
</body>
</html>
