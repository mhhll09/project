// ...existing code...
@extends('home.layout.app')

@section('content')
<div class="dashboard-container">
    <div class="user-card mb-3" onclick="toggleProfile()">
        <div class="user-icon">U</div>
        <div>Halo — NoteTrack</div>
    </div>

    <section class="editor-wrap card mb-3" style="border-radius:16px;overflow:hidden;padding:0;">
        <div class="editor-inner" style="background:transparent;padding:1.4rem 1.2rem 5.6rem 1.2rem;min-height:60vh;">
            <input id="editorTitle" class="editor-title" placeholder="Tulis judul di sini" autocomplete="off" aria-label="Judul catatan">
            <div id="editorBody" class="editor-body" contenteditable="true" data-placeholder="Catatan..." aria-label="Area menulis catatan"></div>
        </div>

        <div class="editor-toolbar" role="toolbar" aria-label="Toolbar format">
            <div class="toolbar-left">
                <button id="editorSave" type="button" class="btn-toolbar" title="Simpan" aria-label="Simpan catatan"><i class="fa fa-floppy-disk"></i></button>
            </div>
            <div class="toolbar-center">
                <button class="btn-toolbar" type="button" data-cmd="bold" title="Bold" aria-label="Tebalkan (Ctrl+B)"><i class="fa fa-bold"></i></button>
                <button class="btn-toolbar" type="button" data-cmd="italic" title="Italic" aria-label="Miring (Ctrl+I)"><i class="fa fa-italic"></i></button>
                <button class="btn-toolbar" type="button" data-cmd="insertUnorderedList" title="Bullet" aria-label="Daftar poin"><i class="fa fa-list-ul"></i></button>
                <button class="btn-toolbar" type="button" data-cmd="insertOrderedList" title="Numbered" aria-label="Daftar bernomor"><i class="fa fa-list-ol"></i></button>
            </div>
            <div class="toolbar-right">
                <button class="btn-toolbar" type="button" data-cmd="justifyLeft" title="Rata kiri" aria-label="Rata kiri"><i class="fa fa-align-left"></i></button>
                <button class="btn-toolbar" type="button" data-cmd="justifyCenter" title="Rata tengah" aria-label="Rata tengah"><i class="fa fa-align-center"></i></button>
                <button class="btn-toolbar" type="button" data-cmd="justifyRight" title="Rata kanan" aria-label="Rata kanan"><i class="fa fa-align-right"></i></button>
                <button id="editorClear" type="button" class="btn-toolbar" title="Bersihkan" aria-label="Bersihkan editor"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </section>

    <div id="notesList"></div>
</div>

<!-- Toast notification simple -->
<div id="nt-toast" aria-live="polite" style="position:fixed;left:50%;transform:translateX(-50%);bottom:84px;z-index:2000;display:none;background:#08203a;color:#fff;padding:10px 14px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.25);font-weight:600;"></div>

<style>
/* Editor styles (simple, mobile-first) */
.editor-wrap { background: #fff6dc; border: 1px solid rgba(0,0,0,0.03); position:relative; }
.editor-title {
    display:block;
    width:100%;
    border:none;
    background:transparent;
    font-size:1.9rem;
    font-weight:600;
    color:#a05a1c;
    padding:6px 8px;
    outline:none;
    border-bottom:1px solid rgba(0,0,0,0.04);
    margin-bottom:8px;
    font-family: Georgia, "Times New Roman", serif;
}
.editor-body {
    min-height:52vh;
    max-height:70vh;
    overflow:auto;
    padding:8px;
    color:#4b3a26;
    font-size:1.05rem;
    line-height:1.7;
    outline:none;
    white-space:pre-wrap;
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
}
/* placeholder for contenteditable */
.editor-body:empty:before{
    content:attr(data-placeholder);
    color:rgba(75,58,38,0.45);
    pointer-events:none;
    display:block;
}

/* toolbar fixed to bottom of editor */
.editor-toolbar{
    position:sticky;
    bottom:0;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    padding:8px 10px;
    background:linear-gradient(180deg,rgba(255,255,255,0.6),rgba(255,255,255,0.9));
    border-top:1px solid rgba(0,0,0,0.04);
}
.btn-toolbar{
    background:transparent;
    border:none;
    padding:8px;
    border-radius:8px;
    cursor:pointer;
    color:#4b3a26;
    font-size:1.05rem;
}
.btn-toolbar:hover{ background:rgba(0,0,0,0.03); }

/* responsive */
@media (max-width:560px){
    .editor-body{ min-height:56vh; }
    .editor-title{ font-size:1.6rem; }
}
</style>

<script>
(function(){
    const NOTES_KEY = 'notetrack_notes_v1';
    const DRAFT_KEY = 'notetrack_draft_v1';
    const $ = id => document.getElementById(id);

    function safeParse(v){ try { return JSON.parse(v||'[]'); } catch { return []; } }
    function loadNotes(){ return safeParse(localStorage.getItem(NOTES_KEY)); }
    function saveNotes(notes){ localStorage.setItem(NOTES_KEY, JSON.stringify(notes)); renderNotes(); }
    function idGen(){ return Date.now().toString(36)+Math.random().toString(36).slice(2,6); }

    // toast
    function showToast(msg, time = 1800){
        const t = $('nt-toast');
        if(!t) return;
        t.textContent = msg;
        t.style.display = 'block';
        clearTimeout(t._timeout);
        t._timeout = setTimeout(()=> t.style.display = 'none', time);
    }

    // save draft (autosave)
    function saveDraft(){
        const title = $('editorTitle')?.value || '';
        const body = $('editorBody')?.innerHTML || '';
        localStorage.setItem(DRAFT_KEY, JSON.stringify({title, body, at: Date.now()}));
    }
    function loadDraft(){
        try{
            const d = JSON.parse(localStorage.getItem(DRAFT_KEY) || '{}');
            if(d && (d.title || d.body)){
                if($('editorTitle') && $('editorBody')){
                    $('editorTitle').value = d.title || '';
                    $('editorBody').innerHTML = d.body || '';
                }
            }
        }catch{}
    }

    // render notes preview
    function esc(s){ return (s||'').replace(/[&<>"']/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[c]); }
    function renderNotes(){
        const container = $('notesList');
        if(!container) return;
        container.innerHTML = '';
        const notes = loadNotes();
        if(!notes.length){
            container.innerHTML = '<div class="card p-3 text-muted mt-3">Belum ada catatan tersimpan.</div>';
            return;
        }
        notes.slice(0,6).forEach(n=>{
            const el = document.createElement('div');
            el.className = 'card mt-3';
            el.style.borderRadius = '10px';
            el.innerHTML = `<div class="p-3">
                <div class="fw-bold">${esc(n.title||'Tanpa Judul')}</div>
                <div class="text-muted small" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${(n.text || '').replace(/<[^>]*>?/gm, '').slice(0,120)}</div>
                <div class="text-muted small mt-2">${new Date(n.created_at).toLocaleString()}</div>
            </div>`;
            container.appendChild(el);
        });
    }

    // initialize after DOM ready
    document.addEventListener('DOMContentLoaded', ()=>{
        // restore draft
        loadDraft();
        renderNotes();

        // toolbar command wiring
        document.querySelectorAll('.btn-toolbar[data-cmd]').forEach(btn=>{
            btn.addEventListener('click', (e)=>{
                const cmd = btn.getAttribute('data-cmd');
                try { document.execCommand(cmd, false, null); } catch(e){ /* noop */ }
                $('editorBody')?.focus();
            });
        });

        // save, clear handlers with element checks
        const saveBtn = $('editorSave');
        if(saveBtn){
            saveBtn.addEventListener('click', ()=>{
                const titleEl = $('editorTitle'), bodyEl = $('editorBody');
                const title = titleEl?.value.trim() || '';
                const body = bodyEl?.innerHTML.trim() || '';
                if(!title && (!body || body === '')){ showToast('Isi judul atau catatan terlebih dahulu'); return; }
                const notes = loadNotes();
                notes.unshift({ id:idGen(), title, text:body, color:'', pinned:false, created_at: Date.now() });
                saveNotes(notes);
                if(titleEl) titleEl.value = '';
                if(bodyEl) bodyEl.innerHTML = '';
                localStorage.removeItem(DRAFT_KEY);
                showToast('Catatan disimpan');
            });
        }

        const clearBtn = $('editorClear');
        if(clearBtn){
            clearBtn.addEventListener('click', ()=>{
                if(confirm('Bersihkan editor?')){ if($('editorTitle')) $('editorTitle').value=''; if($('editorBody')) $('editorBody').innerHTML=''; localStorage.removeItem(DRAFT_KEY); showToast('Editor dibersihkan'); }
            });
        }

        // autosave draft (debounced)
        let draftTimer = null;
        function scheduleDraftSave(){
            clearTimeout(draftTimer);
            draftTimer = setTimeout(saveDraft, 700);
        }
        ['input','keyup','paste','blur'].forEach(evt=>{
            if($('editorTitle')) $('editorTitle').addEventListener(evt, scheduleDraftSave);
            if($('editorBody')) $('editorBody').addEventListener(evt, scheduleDraftSave);
        });

        // keyboard shortcuts: Ctrl+S save, Ctrl+B/I formatting
        document.addEventListener('keydown', (e)=>{
            // Windows/Linux Ctrl, Mac use metaKey
            const mod = navigator.platform.toLowerCase().includes('mac') ? e.metaKey : e.ctrlKey;
            if(!mod) return;
            if(e.key.toLowerCase() === 's'){ e.preventDefault(); $('editorSave')?.click(); }
            if(e.key.toLowerCase() === 'b'){ e.preventDefault(); document.execCommand('bold'); }
            if(e.key.toLowerCase() === 'i'){ e.preventDefault(); document.execCommand('italic'); }
        });

        // make sure editor has focus styling
        if($('editorBody')){
            $('editorBody').addEventListener('focus', ()=> document.querySelector('.editor-wrap')?.classList.add('focused'));
            $('editorBody').addEventListener('blur', ()=> document.querySelector('.editor-wrap')?.classList.remove('focused'));
        }
    });

    // expose small API for other parts (optional)
    window.nt = { renderNotes };

})();
</script>
@endsection
// ...existing code...