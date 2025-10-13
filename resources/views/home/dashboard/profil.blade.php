@extends('home.layout.app')
@section('content')
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
@endsection