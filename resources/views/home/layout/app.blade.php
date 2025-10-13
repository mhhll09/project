<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoteTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff1cc;
        }
        .user-card {
            background: #c97c36;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.10);
            color: #222;
            font-size: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            padding: 0.7rem 1.2rem;
            cursor: pointer;
            transition: background 0.2s;
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            width: 100vw;
            max-width: 100vw;
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
            z-index: 20;
        }
        .user-card:hover {
            background: #a05a1c;
            color: #fff;
        }
        .user-icon {
            background: #a05a1c;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: #fff;
            font-size: 1.5rem;
        }
        .dashboard-container {
            max-width: 400px;
            margin: 2rem auto 1rem auto;
        }
        .btn-tambah-catatan {
            background: #c97c36;
            color: #222;
            border: none;
            border-radius: 16px;
            width: 100%;
            font-size: 1.7rem;
            font-weight: 500;
            padding: 1.1rem 0;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        .btn-tambah-catatan:hover {
            background: #a05a1c;
            color: #fff;
        }
        .btn-tambah-catatan i {
            font-size: 2rem;
            margin-right: 12px;
        }
        .search-bar {
            background: #d6ceb2;
            border-radius: 20px;
            border: none;
            width: 100%;
            padding: 0.7rem 1.2rem;
            font-size: 1.1rem;
            color: #7c6f4d;
            margin-bottom: 1.5rem;
        }
        /* Overlay Profil */
        .profil-overlay {
            position: fixed;
            top: -100vh;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #fff;
            z-index: 1000;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            transition: top 0.7s cubic-bezier(.68,-0.55,.27,1.55);
            display: flex;
            align-items: stretch;
            justify-content: center;
            pointer-events: none;
        }
        .profil-overlay.active {
            top: 0;
            pointer-events: auto;
        }
        .profil-overlay .card {
            width: 100vw;
            height: 100vh;
            max-width: 100vw;
            max-height: 100vh;
            border-radius: 0;
            border: none;
            display: flex;
            flex-direction: column;
        }
        .profil-overlay .card-body {
            flex: 1 1 auto;
            padding: 0;
            height: 100%;
        }
        .profil-overlay iframe {
            border: 0;
            width: 100%;
            height: 100%;
            border-radius: 0;
            overflow: hidden;
            display: block;
        }
        .profil-overlay .text-center.pb-3 {
            display: none;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: #fff1cc;
        }
        body {
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        .profile-header {
            margin-top: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        .profile-header .profile-name {
            font-size: 1.7rem;
            font-weight: bold;
            color: #a05a1c;
        }
        .profile-header .profile-email {
            font-size: 1.1rem;
            color: #7c6f4d;
        }
        .profile-card-full {
            max-width: 420px;
            margin: 0 auto 2.5rem auto;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            border-radius: 18px;
            background: #fff;
            animation: slideDown 0.8s cubic-bezier(.68,-0.55,.27,1.55) forwards;
            opacity: 0;
            transform: translateY(-60px);
            padding: 2rem 1.5rem 1.5rem 1.5rem;
        }
        @keyframes slideDown {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .user-card-bottom {
            background: #c97c36;
            border-radius: 40px 40px 0 0;
            box-shadow: 0 -4px 8px rgba(0,0,0,0.10);
            color: #222;
            font-size: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.7rem 1.2rem;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            max-width: 100vw;
            z-index: 1100;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .user-card-bottom:hover {
            background: #a05a1c;
            color: #fff;
        }
        .user-icon {
            background: #a05a1c;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: #fff;
            font-size: 1.5rem;
        }
        @media (max-width: 500px) {
            .profile-card-full {
                max-width: 98vw;
                padding: 1.2rem 0.5rem 1.2rem 0.5rem;
            }
        }
        /* Tambahkan di dalam <style> profil.blade.php */
        .option-link {
            display: inline-block;
            background: #c97c36;
            color: #222;
            font-weight: 500;
            border-radius: 16px;
            padding: 0.6rem 1.4rem;
            margin-bottom: 1.2rem;
            margin-right: 0.5rem;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: background 0.2s, color 0.2s;
        }
        .option-link:hover {
            background: #a05a1c;
            color: #fff;
            text-decoration: none;
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body>
    @yield('content')
    <script>
        // Aktifkan animasi setelah load
        window.onload = function() {
            document.querySelector('.profile-card-full').style.opacity = 1;
            document.querySelector('.profile-card-full').style.transform = 'translateY(0)';
        }
    </script>
</body>
</html>