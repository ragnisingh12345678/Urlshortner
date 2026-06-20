<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        // Sirf SuperAdmin nayi company bana sakta hai
        if ($request->user()->role !== 'SuperAdmin') {
            abort(403, 'Only SuperAdmins can create companies.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Company::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Nayi company create ho gayi!');
    }
}
