<?php

namespace App\Http\Controllers;


use App\Models\PenjualanEmas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanEmasController extends Controller
{
    public function index() {
        return view('web.sections.dashboard.penjualan-emas.index');
    }

    public function getData(Request $request)
    {
        $query = PenjualanEmas::query()->with('CreatedBy');

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
                "email" => 'required|unique:pelanggan,email',
                "no_hp" => 'required|unique:pelanggan,no_hp',
            ]);

            $data['created_by'] = Auth::user()->id;
            // Assuming PenjualanEmas is your model class
            $createdPenjualanEmas = PenjualanEmas::create($data);

            return response()->json($createdPenjualanEmas, 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function edit(Request $request) {
        $id = $request->id;
        $kategori_buku = PenjualanEmas::findOrFail($id);

        return response()->json($kategori_buku);
    }

    public function update(Request $request) {
        $request->validate([
            "id" => 'required|exists:jenis_emas,id',
            "nama" => 'required',
            "email" => 'required|unique:pelanggan,email,'.$request->id.',id', // Exclude current ID
            "no_hp" => 'required|unique:pelanggan,no_hp,'.$request->id.',id',
            "created_by" => 'required',
        ]);


        try {
            $PenjualanEmas = PenjualanEmas::findOrFail($request->id);

            $PenjualanEmas->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
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
            $data = PenjualanEmas::findOrFail($request->id);
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }
}
