<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalSpot - @yield('title', 'Temukan Tempat Terbaik')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: #2c3e50;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .navbar-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-menu a:hover {
            color: #f39c12;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-login {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-login:hover {
            background-color: white;
            color: #2c3e50;
        }

        .btn-register {
            background-color: #f39c12;
            color: white;
        }

        .btn-register:hover {
            background-color: #e67e22;
        }

        /* Footer */
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 2rem;
            margin-top: 3rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: #f39c12;
        }

        .footer-section p {
            line-height: 1.6;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <i class="fas fa-map-marked-alt"></i>
            LocalSpot
        </a>
        <div class="navbar-menu">
            <a href="/">Explore</a>
            <a href="#">About</a>
            <div class="auth-buttons">
                <a href="/login" class="btn btn-login">Login</a>
                <a href="/register" class="btn btn-register">Join</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Alamat</h3>
                <p> Jl. Pandanaran 2 No.12, Mugassari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50249</p>
            </div>
            <div class="footer-section">
                <h3>KONTAK</h3>
                <p>Email : localspot@gmail.com</p>
                <p>No. Telp :081317690545</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; © 2025 local spot by kelompok 1</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
