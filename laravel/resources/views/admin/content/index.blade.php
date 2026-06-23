@extends('layouts.admin')

@php
use App\Support\StockImages;
$typeTone = ['Text' => 'neutral', 'Textarea' => 'neutral', 'Media' => 'purple', 'Promotion' => 'gold'];
@endphp

@section('content')
<div style="display:flex;justify-content:space-between;align-items:flex-end;gap:20px;flex-wrap:wrap;margin-bottom:26px;">
    <div>
        <h1 style="font-size:30px;font-weight:600;">Website content</h1>
        <p style="color:var(--muted);font-size:14.5px;margin-top:6px;">Manage copy and images for every customer page — homepage, menu, gallery, and more.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-ghost btn-sm" style="text-decoration:none;">Preview site ↗</a>
</div>

@foreach($grouped as $page => $sections)
<div class="adm-card" style="padding:0;margin-bottom:24px;overflow:hidden;">
    <div style="padding:16px 20px;border-bottom:1px solid var(--line);background:var(--ink-850);">
        <h2 style="font-size:17px;font-weight:600;margin:0;">{{ $page }}</h2>
    </div>
    <div style="padding:12px 16px 16px;">
        @foreach($sections as $c)
        <div style="padding:16px 4px;border-bottom:1px solid var(--line);{{ $loop->last ? 'border-bottom:0;' : '' }}">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;margin-bottom:10px;">
                <div>
                    <div style="font-weight:600;color:var(--cream);font-size:14px;">{{ $c['label'] }}</div>
                    <div style="font-size:12px;color:var(--muted);margin-top:2px;">{{ $c['section'] }} · updated {{ $c['updated'] }}</div>
                    @if(!empty($c['hint']))
                        <div style="font-size:12px;color:var(--muted);margin-top:4px;">{{ $c['hint'] }}</div>
                    @endif
                </div>
                @include('admin.partials.badge', ['tone' => $typeTone[$c['type']] ?? 'neutral', 'label' => $c['type']])
            </div>

            <form action="{{ route('admin.content.update', $c['section']) }}" method="POST" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:10px;">
                @csrf @method('PATCH')

                @if($c['type'] === 'Media')
                    @php $imgUrl = $c['value'] ? StockImages::resolve(null, $c['value']) : null; @endphp
                    @if($imgUrl)
                        <img src="{{ $imgUrl }}" alt="" style="max-width:220px;max-height:140px;object-fit:cover;border-radius:10px;border:1px solid var(--line);">
                    @endif
                    <input type="file" name="image" accept="image/*" style="font-size:13px;color:var(--cream);">
                    <input name="value" value="{{ $c['value'] }}" placeholder="Or paste image URL" style="background:var(--ink-800);border:1px solid var(--line);border-radius:8px;padding:8px 12px;color:var(--cream);font-size:13px;font-family:var(--sans);">
                @elseif($c['type'] === 'Textarea')
                    <textarea name="value" rows="4" style="width:100%;background:var(--ink-800);border:1px solid var(--line);border-radius:8px;padding:10px 12px;color:var(--cream);font-size:14px;font-family:var(--sans);resize:vertical;">{{ $c['value'] }}</textarea>
                @else
                    <input name="value" value="{{ $c['value'] }}" style="width:100%;background:var(--ink-800);border:1px solid var(--line);border-radius:8px;padding:8px 12px;color:var(--cream);font-size:14px;font-family:var(--sans);">
                @endif

                <div>
                    <button type="submit" class="btn btn-ghost btn-sm">Save</button>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endforeach
@endsection
