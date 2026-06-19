<?php

namespace App\Http\Controllers\Admin;

use App\Data\PageSections;
use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use App\Services\AdminData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(): View
    {
        $registry = PageSections::defaults();
        $blocks = ContentBlock::query()->orderBy('section')->get()->keyBy('section');
        $grouped = [];

        foreach (PageSections::grouped() as $page => $sections) {
            $grouped[$page] = [];
            foreach ($sections as $meta) {
                $block = $blocks->get($meta['section']);
                $grouped[$page][] = array_merge($meta, [
                    'value' => $block?->value ?? $meta['default'],
                    'type' => $block?->type ?? $meta['type'],
                    'updated' => $block?->updated_at?->diffForHumans(short: true) ?? '—',
                ]);
            }
        }

        return view('admin.content.index', [
            'active' => 'content',
            'grouped' => $grouped,
            'badges' => AdminData::getNavBadges(),
        ]);
    }

    public function update(Request $request, ContentBlock $content): RedirectResponse
    {
        $meta = PageSections::defaults()[$content->section] ?? null;
        $type = $meta['type'] ?? $content->type;

        if ($type === 'Media') {
            $request->validate([
                'image' => 'nullable|image|max:5120',
                'value' => 'nullable|string|max:500',
            ]);

            if ($request->hasFile('image')) {
                $content->update([
                    'value' => $request->file('image')->store('content', 'public'),
                    'type' => 'Media',
                ]);
            } elseif ($request->filled('value')) {
                $content->update(['value' => $request->input('value')]);
            }

            return back()->with('success', $content->section.' updated.');
        }

        $request->validate([
            'value' => 'required|string|max:'.($type === 'Textarea' ? 5000 : 500),
        ]);

        $content->update([
            'value' => $request->input('value'),
            'type' => $type,
        ]);

        return back()->with('success', $content->section.' updated.');
    }
}
