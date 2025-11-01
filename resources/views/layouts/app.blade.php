<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .btn-glow {
            transition: all 0.3s ease;
            box-shadow: 0 0 0 rgba(0,123,255,0);
        }
        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(0,123,255,0.5);
        }
    </style>
</head>
<body class="animate__animated animate__fadeIn">

    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Smooth Fade Transition -->
    <script>
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', e => {
                if (link.getAttribute('href').startsWith('#')) return;
                document.body.classList.add('animate__animated', 'animate__fadeOut');
            });
        });
    </script>
</body>
</html>
