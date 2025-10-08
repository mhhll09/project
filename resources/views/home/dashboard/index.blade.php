<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NoteTrack</title>
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
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body>
    <!-- User Card di luar container agar menempel penuh -->
    <div class="user-card" id="userCard">
        <span class="user-icon">
            <i class="fas fa-user"></i>
        </span>
        User
    </div>
    <div class="dashboard-container">
        <!-- Tambah Catatan Button -->
        <a href="{{ route('catatan.store') }}" class="btn btn-tambah-catatan mb-3">
            <i class="fas fa-plus"></i> Tambah Catatan
        </a>
        <!-- Search Bar -->
        <input type="text" class="search-bar" placeholder="&#xf002; Telusuri Catatan" style="font-family: 'Font Awesome 6 Free', Arial, sans-serif; font-weight:400;">
    </div>
    <!-- Profil Overlay -->
    <div id="profilOverlay" class="profil-overlay">
        <div class="card shadow">
            <div class="card-body p-0">
                <iframe 
                    src="{{ route('profil.index') }}" 
                    title="Profil"
                    allowtransparency="true">
                </iframe>
            </div>
        </div>
    </div>
    <script>
        // User card trigger
        document.getElementById('userCard').onclick = function() {
            document.getElementById('profilOverlay').classList.add('active');
        };
        // Terima pesan dari iframe untuk menutup overlay
        window.addEventListener('message', function(event) {
            if (event.data === 'close-profil-overlay') {
                document.getElementById('profilOverlay').classList.remove('active');
            }
        });
        // Klik di luar iframe untuk menutup overlay (opsional)
        document.getElementById('profilOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>