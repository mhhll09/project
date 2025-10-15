@extends('home.layout.app')
@section('content')
<!-- Konten Profil Fullscreen -->
    <div class="profile-header">
    </div>
    <a class="option-link" href="{{ route('option.index') }}">option</a>
    <a class="option-link" href="#">edit</a>
    <!-- Tombol tutup overlay di bawah -->
    <a href="#" class="user-card-bottom" onclick="parent.postMessage('close-profil-overlay','*');return false;">
        <span class="user-icon">
            <i class="fas fa-arrow-left"></i>
        </span>
        Kembali ke Dashboard
    </a>
@endsection