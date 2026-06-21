@extends('layouts.admin')

@php
$total = $galleryCats->sum(fn($c) => $c->images->count());
@endphp

@section('content')
<div class="adm-page-head adm-gallery-head">
    <div>
        <h1 class="adm-gallery-title">Gallery</h1>
        <p class="adm-gallery-sub">{{ $total }} images live · {{ $galleryCats->count() }} categories</p>
    </div>
</div>

<div class="adm-gallery-cats">
    @foreach($galleryCats as $c)
    <a href="{{ route('admin.gallery.index', ['category' => $c->slug]) }}" class="adm-gallery-cat{{ $activeCategory && $c->id === $activeCategory->id ? ' adm-gallery-cat--active' : '' }}">
        {{ $c->name }} <span class="adm-gallery-cat__count">{{ $c->images->count() }}</span>
    </a>
    @endforeach
</div>

@if($activeCategory)
<div class="adm-card adm-gallery-upload">
    <h3 class="adm-gallery-upload__title">Upload to {{ $activeCategory->name }}</h3>
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="adm-gallery-upload-form">
        @csrf
        <input type="hidden" name="gallery_category_id" value="{{ $activeCategory->id }}">
        <label class="adm-gallery-upload__caption">
            <span class="adm-gallery-upload__label">Caption</span>
            <input name="caption" required placeholder="Image caption" style="background:var(--ink-800);border:1px solid var(--line);border-radius:10px;padding:12px 14px;color:var(--cream);font-family:var(--sans);">
        </label>
        <div class="adm-file-field adm-gallery-upload__file">
            <span class="adm-file-field__title">Image file</span>
            <input name="image" type="file" accept="image/*" required>
            <span data-adm-file-name style="font-size:12px;color:var(--muted);">No file chosen</span>
        </div>
        <button type="submit" class="btn btn-gold btn-sm adm-gallery-upload__submit"><x-icon name="plus" :size="16"/> Upload</button>
    </form>
</div>

<div class="adm-gallery-grid">
    @foreach($activeCategory->images as $img)
    <div class="adm-gallery-item">
        <button
            type="button"
            class="adm-gallery-photo"
            data-gallery-replace
            data-action="{{ route('admin.gallery.update', $img) }}"
            data-caption="{{ $img->caption }}"
            data-src="{{ $img->image_path ? asset('storage/'.$img->image_path) : '' }}"
            aria-label="Change photo for {{ $img->caption }}"
        >
            @if($img->image_path)
                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption }}">
            @else
                <div class="ph adm-gallery-photo__ph"><span>{{ $img->caption }}</span></div>
            @endif
            <span class="adm-gallery-photo__overlay"><x-icon name="image" :size="18"/> Change photo</span>
        </button>
        <div class="adm-gallery-item__footer">
            <form action="{{ route('admin.gallery.update', $img) }}" method="POST" style="display:flex;gap:6px;">
                @csrf @method('PUT')
                <input name="caption" value="{{ $img->caption }}" style="flex:1;background:rgba(23,18,14,.8);border:1px solid var(--line);border-radius:8px;padding:6px 10px;color:var(--cream);font-size:12px;font-family:var(--sans);">
                <button type="submit" style="width:34px;height:34px;border-radius:9px;background:rgba(23,18,14,.8);border:1px solid var(--line);color:var(--sand);cursor:pointer;display:grid;place-items:center;" aria-label="Save caption"><x-icon name="edit" :size="14"/></button>
            </form>
        </div>
        <div class="adm-gallery-item__delete">
            <form action="{{ route('admin.gallery.destroy', $img) }}" method="POST" data-confirm="Delete this image?">
                @csrf @method('DELETE')
                <button type="submit" style="width:34px;height:34px;border-radius:9px;background:rgba(23,18,14,.8);border:1px solid var(--line);color:var(--sand);cursor:pointer;display:grid;place-items:center;" aria-label="Delete image"><x-icon name="trash" :size="16"/></button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@push('modals')
<dialog id="gallery-replace-dialog" class="adm-dialog" style="width:min(520px,calc(100vw - 28px));">
    <form id="gallery-replace-form" method="POST" enctype="multipart/form-data" style="padding:18px;display:grid;gap:14px;">
        @csrf
        @method('PUT')
        <input type="hidden" name="caption" id="gallery-replace-caption" value="">
        <h4 style="margin:0;font-size:19px;font-weight:600;">Replace photo</h4>
        <p id="gallery-replace-name" style="margin:0;font-size:13px;color:var(--muted);"></p>
        <div id="gallery-replace-preview" style="width:100%;aspect-ratio:1;border-radius:12px;overflow:hidden;background:var(--ink-800);border:1px solid var(--line);"></div>
        <div class="adm-file-field">
            <span class="adm-file-field__title">New image file</span>
            <span class="adm-file-field__hint">Choose a photo to replace the current one.</span>
            <input name="image" type="file" accept="image/*" required>
            <span data-adm-file-name style="font-size:12px;color:var(--muted);">No file chosen</span>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:8px;">
            <button type="button" class="btn btn-ghost btn-sm" id="gallery-replace-cancel">Cancel</button>
            <button type="submit" class="btn btn-gold btn-sm">Replace photo</button>
        </div>
    </form>
</dialog>
@endpush
@endif
@endsection
