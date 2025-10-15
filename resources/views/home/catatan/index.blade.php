@extends('home.layout.app')
@section('content')
<form method="POST" action="/notes/save" id="noteForm">
    <div class="note-container">
      <input type="text" name="title" class="note-title" placeholder="Tulis judul di sini">
      <hr>
      <div class="note-body" contenteditable="true" placeholder="Catatan..."></div>
      <input type="hidden" name="content" id="hidden-content">
    </div>

    <div class="toolbar">
      <button type="button" data-command="save"><i class="fa-solid fa-floppy-disk"></i></button>
      <button type="button" data-command="bold"><i class="fa-solid fa-bold"></i></button>
      <button type="button" data-command="italic"><i class="fa-solid fa-italic"></i></button>
      <button type="button" data-command="justifyLeft"><i class="fa-solid fa-align-left"></i></button>
      <button type="button" data-command="justifyCenter"><i class="fa-solid fa-align-center"></i></button>
      <button type="button" data-command="justifyRight"><i class="fa-solid fa-align-right"></i></button>
      <button type="button" data-command="justifyFull"><i class="fa-solid fa-align-justify"></i></button>
    </div>
@endsection
