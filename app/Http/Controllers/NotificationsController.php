<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class   NotificationsController extends Controller
{
    public function index(Request $request) {
        $posts = auth()->user()->notificationsPost()->orderBy('created_at', 'desc')->paginate();
        return view('notifications.index', compact('posts'));
    }
}
