<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>.editor-wrap {
    background: #fff6dc;
    border: 1px solid rgba(0,0,0,0.03);
    position: relative;
}

.editor-title {
    display: block;
    width: 100%;
    border: none;
    background: transparent;
    font-size: 1.9rem;
    font-weight: 600;
    color: #a05a1c;
    padding: 6px 8px;
    outline: none;
    border-bottom: 1px solid rgba(0,0,0,0.04);
    margin-bottom: 8px;
    font-family: Georgia, "Times New Roman", serif;
}

.editor-body {
    min-height: 52vh;
    max-height: 70vh;
    overflow: auto;
    padding: 8px;
    color: #4b3a26;
    font-size: 1.05rem;
    line-height: 1.7;
    outline: none;
    white-space: pre-wrap;
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
}

/* Placeholder untuk contenteditable */
.editor-body:empty:before {
    content: attr(data-placeholder);
    color: rgba(75,58,38,0.45);
    pointer-events: none;
    display: block;
}

/* Toolbar di bawah editor */
.editor-toolbar {
    position: sticky;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    padding: 8px 10px;
    background: linear-gradient(180deg, rgba(255,255,255,0.6), rgba(255,255,255,0.9));
    border-top: 1px solid rgba(0,0,0,0.04);
}

.btn-toolbar {
    background: transparent;
    border: none;
    padding: 8px;
    border-radius: 8px;
    cursor: pointer;
    color: #4b3a26;
    font-size: 1.05rem;
}

.btn-toolbar:hover {
    background: rgba(0,0,0,0.03);
}
</style>
</head>
<body>
    @yield('content')
</body>
</html>