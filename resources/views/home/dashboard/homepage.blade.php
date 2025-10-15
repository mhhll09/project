@extends('home.layout.app')
@section('content')
    <!-- User Card di luar container agar menempel penuh -->
    <div class="user-card" id="userCard">
        <span class="">
            <img src="{{ $client->avatar }}" alt="" class="user-icon">
        </span>
        {{ $client->name }}
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
@endsection