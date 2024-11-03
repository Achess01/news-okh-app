<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'file' => ['required', 'file'],
        ]);

        $path = $request->file('file')->storePublicly('attachments', ['disk' => 'public']);

        return [
            'url' => $url = Storage::disk('public')->url($path),
            'href' => $url,
        ];
    }
}
