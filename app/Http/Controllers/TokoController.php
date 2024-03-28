<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TokoController extends Controller
{
    public function index() {
        return view('web.sections.dashboard.toko.index');
    }

    public function getData(Request $request)
    {
        $query = Toko::query();

        if ($request->search) {
            $query->where('nama_toko', 'LIKE', "%" . $request->search . "%");
        }

        $data = $query->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                    ->orderBy('created_at', 'desc') // Then order by created_at in descending order
                    ->paginate(10);

        return response()->json(['data' => $data],200);
    }

    public function store(Request $request): JsonResponse {
        try {
            $data = $request->validate([
                "nama_toko" => 'required',
                "alamat" => 'required',
                "npwp" => 'nullable',
            ]);

            // Assuming Toko is your model class
            $createdToko = Toko::create($data);

            return response()->json($createdToko, 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function edit(Request $request) {
        $id = $request->id;
        $kategori_buku = Toko::findOrFail($id);

        return response()->json($kategori_buku);
    }

    public function update(Request $request) {
        $request->validate([
            "id" => 'required|exists:toko,id',
            "nama_toko" => 'required',
            "alamat" => 'required',
            "npwp" => 'nullable',
        ]);

        try {
            $Toko = Toko::findOrFail($request->id);

            $Toko->update([
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat,
                'npwp' => $request->npwp,
            ]);

            return response()->json(['message' => 'Data updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Toko::findOrFail($request->id);
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function select(Request $request) {
        // Pluck id and nama_toko
        $query = DB::table('toko');
        if ($request->search !== null) {
            $query->where('nama_toko', 'like', '%' . $request->search . '%');
        }

        $result = $query->select('id as id', 'nama_toko as text')->get();


        return response()->json($result);
    }


}
