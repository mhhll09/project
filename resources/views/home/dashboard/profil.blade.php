<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - NoteTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
    <!-- Konten Profil Fullscreen -->
    <div class="profile-header">
        <div class="profile-name">John Doe</div>
        <div class="profile-email">johndoe@email.com</div>
    </div>
    <a class="option-link" href="{{ route('option.index') }}">option</a>
    <a href="#">edit</a>
    <!-- Tombol tutup overlay di bawah -->
    <a href="#" class="user-card-bottom" onclick="parent.postMessage('close-profil-overlay','*');return false;">
        <span class="user-icon">
            <i class="fas fa-arrow-left"></i>
        </span>
        Kembali ke Dashboard
    </a>
    <script>
        // Aktifkan animasi setelah load
        window.onload = function() {
            document.querySelector('.profile-card-full').style.opacity = 1;
            document.querySelector('.profile-card-full').style.transform = 'translateY(0)';
        }
    </script>
</body>
</html>