<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Operator Dashboard')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#195de6",
                        "background-light": "#f6f6f8",
                        "background-dark": "#111621",
                    },
                    fontFamily: {
                        display: ["Inter"],
                    },
                },
            },
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;
        }
    </style>
</head>

<body class="antialiased bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <x-operator.sidebar />

    {{-- MAIN --}}
    <main class="flex flex-col flex-1 min-h-screen ml-72">

        {{-- TOPBAR --}}
        <x-operator.topbar />

        {{-- PAGE CONTENT --}}
        <div class="p-8 space-y-8">
            @yield('content')
        </div>

    </main>
</div>

</body>
</html>
