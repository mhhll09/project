@extends('home.layout.app')

@section('content')
<form method="POST" action="{{ route('catatan.update', $data->id) }}" id="noteForm">
  @csrf
  @method('PUT')

  <div class="relative note-container mt-10 px-4">
    <!-- Input judul -->
    <input 
      type="text" 
      name="judul" 
      class="note-title w-full text-xl font-semibold border-none focus:outline-none" 
      placeholder="Tulis judul di sini" 
      value="{{ $data->judul }}" 
      required
    >

    <hr class="my-3">

    <!-- Isi catatan -->
    <div 
      class="note-body min-h-[300px] border-none focus:outline-none" 
      contenteditable="true"
      placeholder="Catatan..."
    >{!! $data->isi !!}</div>

    <input type="hidden" name="isi" id="hidden-content" value="{{ $data->isi }}">

    <!-- Tombol simpan -->
    <button type="submit" 
            id="saveNoteBtn"
            class="absolute top-3 right-3 text-green-600 hover:text-green-800 text-2xl">
      <i class="fa-solid fa-check"></i> Simpan
    </button>
  </div>
</form>

<!-- Tombol hapus (DI LUAR form update) -->
<form id="deleteForm" action="{{ route('catatan.destroy', $data->id) }}" method="POST" class="mt-6 px-4 inline-block">
  @csrf
  @method('DELETE')
  <button type="button" id="btnDelete" class="text-red-600 hover:text-red-800 text-lg">
    <i class="fa-solid fa-trash"></i> Hapus Catatan
  </button>
</form>

<!-- Toolbar -->
<div class="toolbar flex gap-2 mt-4 px-4">
  <button type="button" data-command="bold"><i class="fa-solid fa-bold"></i></button>
  <button type="button" data-command="italic"><i class="fa-solid fa-italic"></i></button>
  <button type="button" data-command="underline"><i class="fa-solid fa-underline"></i></button>
  <button type="button" data-command="justifyLeft"><i class="fa-solid fa-align-left"></i></button>
  <button type="button" data-command="justifyCenter"><i class="fa-solid fa-align-center"></i></button>
  <button type="button" data-command="justifyRight"><i class="fa-solid fa-align-right"></i></button>
  <button type="button" data-command="justifyFull"><i class="fa-solid fa-align-justify"></i></button>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Toolbar perintah format teks
document.querySelectorAll('.toolbar button[data-command]').forEach(button => {
  button.addEventListener('click', () => {
    const command = button.getAttribute('data-command');
    document.execCommand(command, false, null);
  });
});

// Saat form disubmit, ambil isi catatan dari contenteditable
document.getElementById('noteForm').addEventListener('submit', function() {
  const content = document.querySelector('.note-body').innerHTML;
  document.getElementById('hidden-content').value = content;
});

// Konfirmasi hapus catatan
document.getElementById('btnDelete').addEventListener('click', function(e) {
  e.preventDefault();
  Swal.fire({
    title: 'Yakin ingin menghapus catatan ini?',
    text: 'Catatan yang dihapus tidak dapat dikembalikan.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('deleteForm').submit();
    }
  });
});
</script>
@endsection
