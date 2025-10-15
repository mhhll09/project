@extends('home.layout.app')
@extends('home.catatan.app')
@section('content')
<form method="POST" action="{{ route('catatan.store') }}" id="noteForm">
  @csrf
  <div class="relative">

    {{-- Tombol centang di pojok kanan atas --}}
    <button type="submit" 
            id="saveNoteBtn"
            class="absolute top-3 right-3 text-green-600 hover:text-green-800 text-2xl">
      <i class="fa-solid fa-check"></i>
    </button>

    <div class="note-container mt-10 px-4">
      <input type="text" name="judul" class="note-title w-full text-xl font-semibold border-none focus:outline-none" placeholder="Tulis judul di sini">

      <hr class="my-3">

      <div class="note-body min-h-[300px] border-none focus:outline-none" 
           contenteditable="true" 
           placeholder="Catatan..."></div>

      <input type="hidden" name="isi" id="hidden-content">
      <input type="hidden" name="user" id="hidden-content">
    </div>

    <div class="toolbar flex gap-2 mt-4 px-4">
      <button type="button" data-command="bold"><i class="fa-solid fa-bold"></i></button>
      <button type="button" data-command="italic"><i class="fa-solid fa-italic"></i></button>
      <button type="button" data-command="justifyLeft"><i class="fa-solid fa-align-left"></i></button>
      <button type="button" data-command="justifyCenter"><i class="fa-solid fa-align-center"></i></button>
      <button type="button" data-command="justifyRight"><i class="fa-solid fa-align-right"></i></button>
      <button type="button" data-command="justifyFull"><i class="fa-solid fa-align-justify"></i></button>
    </div>

  </div>
</form>

{{-- Script untuk toolbar dan submit --}}
<script>
document.querySelectorAll('.toolbar button').forEach(button => {
  button.addEventListener('click', () => {
    const command = button.getAttribute('data-command');
    document.execCommand(command, false, null);
  });
});

// Saat form dikirim, ambil isi dari note-body
document.getElementById('noteForm').addEventListener('submit', function() {
  const content = document.querySelector('.note-body').innerHTML;
  document.getElementById('hidden-content').value = content;
});
</script>
@endsection
