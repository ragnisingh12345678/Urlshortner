<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function store(Request $request)
    {
        $currentUser = auth()->user();

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'role' => 'required'
        ]);

        if ($currentUser->role === 'SuperAdmin') {

            if ($request->role !== 'Admin') {
                abort(403, 'SuperAdmin can only create Admin.');
            }

            $request->validate([
                'company_id' => 'required|exists:companies,id'
            ]);

            $companyId = $request->company_id;

        } elseif ($currentUser->role === 'Admin') {

            if ($request->role !== 'Member') {
                abort(403, 'Admin can only create Member.');
            }

            $companyId = $currentUser->company_id;

        } else {

            abort(403, 'Unauthorized');
        }

        User::create([
            'name'       => 'Invited User',
            'email'      => $request->email,
            'password'   => Hash::make('password123'),
            'role'       => $request->role,
            'company_id' => $companyId,
        ]);

        return back()->with('success', 'User invited successfully.');
    }
}