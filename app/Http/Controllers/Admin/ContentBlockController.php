<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use Illuminate\Http\Request;

class ContentBlockController extends Controller
{
    public function index()
    {
        $blocks = ContentBlock::orderBy('group')->get()->groupBy('group');
        return view('admin.content.index', compact('blocks'));
    }

    public function edit(ContentBlock $contentBlock)
    {
        return view('admin.content.edit', compact('contentBlock'));
    }

    public function update(Request $request, ContentBlock $contentBlock)
    {
        $rules = [
            'value' => 'required',
        ];

        if($contentBlock->type === 'image') {
            $rules['value'] = 'image|max:8192';
        }

        $data = $request->validate($rules);

        if($request->hasFile('value')) {
            $path = $request->file('value')->store('content', 'public');
            $data['value'] = $path;
        }

        $contentBlock->update($data);

        return redirect()->route('admin.content.index')
            ->with('success', 'Контент обновлён');
    }
}
