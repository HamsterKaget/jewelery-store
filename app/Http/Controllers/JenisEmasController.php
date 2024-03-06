<?php

namespace App\Http\Controllers;

use App\Models\JenisEmas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JenisEmasController extends Controller
{
    public function index() {
        return view('web.sections.dashboard.jenis-emas.index');
    }

    public function getData(Request $request)
    {
        $query = JenisEmas::query()->with('CreatedBy');

        if ($request->search) {
            $query->where('nama', 'LIKE', "%" . $request->search . "%");
        }

        $data = $query->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                    ->orderBy('created_at', 'desc') // Then order by created_at in descending order
                    ->paginate(10);

        return response()->json(['data' => $data],200);
    }

    public function store(Request $request): JsonResponse {
        try {
            $data = $request->validate([
                "nama" => 'required',
                // "created_by" => 'required',
            ]);

            $data['created_by'] = Auth::user()->id;
            // Assuming JenisEmas is your model class
            $createdJenisEmas = JenisEmas::create($data);

            return response()->json($createdJenisEmas, 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function edit(Request $request) {
        $id = $request->id;
        $kategori_buku = JenisEmas::findOrFail($id);

        return response()->json($kategori_buku);
    }

    public function update(Request $request) {
        $request->validate([
            "id" => 'required|exists:jenis_emas,id',
            "nama" => 'required',
            "created_by" => 'required',
        ]);

        try {
            $JenisEmas = JenisEmas::findOrFail($request->id);

            $JenisEmas->update([
                'nama' => $request->nama,
                'created_by' => $request->created_by,
            ]);

            return response()->json(['message' => 'Data updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = JenisEmas::findOrFail($request->id);
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function select(Request $request) {
        // Pluck id and nama_toko
        $query = DB::table('toko');
        // $query->where('deleted_at', '='  , NULL);
        // If search parameter is not null, add where clause
        if ($request->search !== null) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $result = $query->select('id as id', 'nama as text')->get();


        return response()->json($result);
    }


}
