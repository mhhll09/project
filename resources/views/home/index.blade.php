@extends('home.layout.app')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh; background: #fff1cc;">
    <div class="profile-card-full text-center" style="max-width: 400px; width: 100%; animation: slideDown 0.8s cubic-bezier(.68,-0.55,.27,1.55) forwards;">
        <h3 class="mb-4" style="color: #a05a1c; font-weight: 700;">Welcome to NoteTrack</h3>

        <form method="GET" action="{{ route('client.show') }}">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label" style="color: #7c6f4d; font-weight: 500;">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control"
                    style="background: #d6ceb2; border: none; border-radius: 20px; padding: 0.8rem 1rem; font-size: 1rem; color: #7c6f4d;"
                    required>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label" style="color: #7c6f4d; font-weight: 500;">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control"
                    style="background: #d6ceb2; border: none; border-radius: 20px; padding: 0.8rem 1rem; font-size: 1rem; color: #7c6f4d;"
                    required>
            </div>

            <div class="form-check mb-4 text-start">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember" style="color: #7c6f4d;">Remember me</label>
            </div>

            <button type="submit" 
                class="btn-tambah-catatan"
                style="font-size: 1.3rem;">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Login
            </button>
        </form>

        <div class="mt-3">
            <a href="{{ route('client.create') }}" 
               class="option-link"
               style="font-size: 1rem;">
               <i class="fa-solid fa-user-plus me-1"></i> Register
            </a>
            <a href="{{ route('google.login') }}" class="btn btn-danger w-100">
                <i class="fab fa-google me-2"></i> Login dengan Google
            </a>
        </div>
    </div>
</div>
@endsection
