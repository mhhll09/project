@extends('home.layout.app')
@section('content')
<div class="d-flex flex-column align-items-center mt-4">
    <a class="option-link w-75 text-center mb-2" href="{{ route('option.index') }}">
        <i class="fa fa-cog me-2"></i> Option
    </a>

    <button id="btnEditProfile" class="option-link w-75 text-center mb-2" type="button">
        <i class="fa fa-user-pen me-2"></i> Edit Profile
    </button>
</div>

<!-- Edit form (hidden by default) -->
<div id="editProfileCard" class="profile-card-full mt-4" style="display:none; max-width:420px; margin:16px auto;">
    <div style="padding:16px;">
        <h5 class="mb-3" style="color:#a05a1c;">Edit Profile</h5>

        <div class="mb-3">
            <label class="form-label small">Nama</label>
            <input id="editName" class="form-control" type="text" value="John Doe">
        </div>

        <div class="d-flex gap-2">
            <button id="saveProfile" class="option-link" style="flex:1;text-align:center;">Simpan</button>
            <button id="cancelEdit" class="btn btn-outline-secondary" style="flex:1;">Batal</button>
        </div>
    </div>
</div>

<!-- Tombol tutup overlay di bawah -->
<a href="#" class="user-card-bottom" onclick="parent.postMessage('close-profil-overlay','*');return false;">
    <span class="user-icon">
        <i class="fas fa-arrow-left"></i>
    </span>
    Kembali ke Dashboard
</a>

<style>

    /* Reuse option-link style from layout but ensure proper spacing */
    .option-link { display:inline-block; background:#c97c36; color:#08203a; font-weight:700; border-radius:12px; padding:12px 18px; text-decoration:none; box-shadow:0 6px 10px rgba(0,0,0,0.06); }
    .option-link:hover { background:#a05a1c; color:#fff; text-decoration:none; }

    /* Adjust edit card */
    #editProfileCard { background:#fff; border-radius:14px; box-shadow:0 8px 30px rgba(0,0,0,0.06); }
    #editProfileCard .form-control { background: #fff9f0; border:1px solid rgba(0,0,0,0.04); }

    @media (max-width:500px){
        .profile-avatar { width:88px;height:88px; }
        .option-link { padding:10px 14px; font-size:0.95rem; }
    }
</style>

<script>
(function(){
    const $ = id => document.getElementById(id);
    const btnEdit = $('btnEditProfile');
    const editCard = $('editProfileCard');
    const cancel = $('cancelEdit');
    const save = $('saveProfile');
    const avatarInput = $('editAvatar');
    const avatarPreview = $('editAvatarPreview');

    if(btnEdit){
        btnEdit.addEventListener('click', ()=> {
            editCard.style.display = editCard.style.display === 'none' ? 'block' : 'none';
            // scroll into view on small screens
            if(editCard.style.display === 'block') editCard.scrollIntoView({behavior:'smooth', block:'center'});
        });
    }
    if(cancel){
        cancel.addEventListener('click', ()=> { editCard.style.display = 'none'; });
    }

    // image preview
    if(avatarInput){
        avatarInput.addEventListener('change', (e)=>{
            const f = e.target.files && e.target.files[0];
            if(!f) return;
            const reader = new FileReader();
            reader.onload = function(ev){
                avatarPreview.src = ev.target.result;
            };
            reader.readAsDataURL(f);
        });
    }


})();
</script>
@endsection