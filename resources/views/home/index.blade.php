@extends('home.layout.app')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh; background: #fff1cc;">
    <div class="profile-card-full text-center" style="max-width: 400px; width: 100%; animation: slideDown 0.8s cubic-bezier(.68,-0.55,.27,1.55) forwards;">
        <h3 class="mb-4" style="color: #a05a1c; font-weight: 700;">Welcome to NoteTrack</h3>
            <a href="{{ route('google.login') }}" class="btn btn-danger w-100">
                <i class="fab fa-google me-2"></i> Login dengan Google
            </a>
        </div>
    </div>
</div>
@endsection
