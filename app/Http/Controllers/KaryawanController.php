<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index() {
        return view('web.sections.dashboard.karyawan.index');
    }

    public function getData(Request $request)
    {
        $query = Karyawan::query()
            ->with(['UserKaryawan.User.roles', 'Toko']);

        if ($request->search) {
            $query->where('nama_lengkap', 'LIKE', "%" . $request->search . "%");
        }

        $data = $query->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                    ->orderBy('created_at', 'desc') // Then order by created_at in descending order
                    ->paginate(10);

        return response()->json(['data' => $data],200);
    }


    public function store(Request $request): JsonResponse {
        try {
            $data = $request->validate([
                "nama_lengkap" => 'required',
                "nik" => 'required',
                "email" => 'required|email|unique:users,email', // Ensure email uniqueness
                "no_hp" => 'required',
                "alamat" => 'nullable',
                "toko_id" => 'required|exists:toko,id',
                "role_id" => 'required|exists:roles,id',
            ]);

            // Create a new user
            $user = User::create([
                'name' => $data['nama_lengkap'],
                'email' => $data['email'],
                'password' => Hash::make('123123123'), // Set default password
            ]);

            // Assign role to the user
            $user->roles()->attach($data['role_id']);

            // Create Karyawan
            $karyawan = Karyawan::create([
                "nama_lengkap" => $data['nama_lengkap'],
                "nik" => $data['nik'],
                "email" => $data['email'],
                "no_hp" => $data['no_hp'],
                "alamat" => $data['alamat'],
            ]);

            // Link Karyawan to User
            $karyawan->UserKaryawan()->create([
                'user_id' => $user->id
            ]);

            // Link Karyawan to Toko using KaryawanToko model
            $karyawan->Toko()->attach($data['toko_id']); // Use attach to link the Karyawan to the Toko


            return response()->json($karyawan, 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    public function edit(Request $request) {
        $id = $request->id;
        $kategori_buku = Karyawan::with(['UserKaryawan.User.roles', 'Toko'])->findOrFail($id);

        return response()->json($kategori_buku);
    }

    public function update(Request $request) {
        $request->validate([
            "id" => 'required|exists:karyawan,id',
            "nama_lengkap" => 'required',
            "nik" => 'required',
            "email" => 'required|email|unique:users,email,'.$request->user_id, // Ensure email uniqueness except for the current user
            "no_hp" => 'required',
            "alamat" => 'nullable',
            "toko_id" => 'required|exists:toko,id',
            "role_id" => 'required|exists:roles,id',
        ]);

        try {
            $karyawan = Karyawan::findOrFail($request->id);
            $user = User::findOrFail($request->user_id); // Get the associated user

            // Update the user information
            $user->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
            ]);

            // Update the karyawan information
            $karyawan->update([
                "nama_lengkap" => $request->nama_lengkap,
                "nik" => $request->nik,
                "email" => $request->email,
                "no_hp" => $request->no_hp,
                "alamat" => $request->alamat,
            ]);

            // Sync the toko
            $karyawan->Toko()->sync([$request->toko_id]);

            // Sync the roles
            $user->roles()->sync([$request->role_id]);

            return response()->json(['message' => 'Data updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $karyawan = Karyawan::findOrFail($request->id);

            // Delete associated users directly
            foreach ($karyawan->UserKaryawan as $userKaryawan) {
                $userId = $userKaryawan->user_id;
                $user = User::findOrFail($userId);
                $user->delete();
            }

            // Delete associated user records
            $karyawan->UserKaryawan()->delete();

            // Delete associated toko records
            $karyawan->Toko()->detach();

            // Delete the karyawan record
            $karyawan->delete();

            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }



    public function select(Request $request) {
        // Pluck id and nama_toko
        $query = DB::table('toko');
        $query->where('deleted_at', '='  , NULL);
        // If search parameter is not null, add where clause
        if ($request->search !== null) {
            $query->where('nama_toko', 'like', '%' . $request->search . '%');
        }

        $result = $query->select('id as id', 'nama_toko as text')->get();


        return response()->json($result);
    }


}
