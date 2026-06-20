<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'SuperAdmin') {

            $urls = ShortUrl::with(['user', 'company'])
                ->latest()
                ->get();

        } elseif ($user->role === 'Admin') {

            $urls = ShortUrl::with(['user', 'company'])
                ->where('company_id', $user->company_id)
                ->latest()
                ->get();

        } elseif ($user->role === 'Member') {

            $urls = ShortUrl::with(['user', 'company'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();

        } else {

            abort(403, 'Unauthorized Role');
        }

        return view('dashboard', compact('urls'));
    }

    public function store(Request $request)
    {
        if ($request->user()->role === 'SuperAdmin') {
            abort(403, 'SuperAdmin cannot create short urls.');
        }

        $request->validate([
            'original_url' => 'required|url'
        ]);

        ShortUrl::create([
            'user_id'      => $request->user()->id,
            'company_id'   => $request->user()->company_id,
            'original_url' => $request->original_url,
            'short_code'   => Str::random(6),
        ]);

        return back()->with('success', 'URL Created Successfully!');
    }

    public function redirect($short_code)
    {
        $url = ShortUrl::where('short_code', $short_code)->firstOrFail();
        return redirect()->away($url->original_url);
    }
}