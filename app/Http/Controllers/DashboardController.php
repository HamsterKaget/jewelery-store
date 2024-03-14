<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function home(Request $request) {
        // dd(Auth::user()->getRoleNames());
        if(Auth::user()->hasRole(['owner', 'karyawan'])) {
            return view('web.sections.dashboard.home.index-owner');
        } else {
            throw new AuthorizationException('Akun anda saat ini tidak memiliki akses ke URL ini ! jika ini merupakan kesalahan harap hubungi atasan anda');
            // return response()->json(['error' => 'You are not allowed to perform this action.'], 403);
        }
    }

    public function spatie(Request $request) {
        // $role = Role::create(['name' => 'owner']);
        // $permission = Permission::create(['name' => 'crud barang']);
        // $role->givePermissionTo($permission);
        $user = Auth::user();
        $user->assignRole('owner');
    }
}
