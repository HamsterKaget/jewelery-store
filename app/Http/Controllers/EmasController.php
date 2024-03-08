<?php

namespace App\Http\Controllers;

use App\Models\Emas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class EmasController extends Controller
{
    public function index() {
        return view('web.sections.dashboard.emas.index');
    }


    public function getData(Request $request)
    {
        $query = Emas::with(['Toko', 'User', 'JenisEmas', 'JenisBarang']);

        if ($request->search) {
            $query->where('nama_produk', 'LIKE', "%" . $request->search . "%");
        }

        $data = $query->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                    ->orderBy('created_at', 'desc') // Then order by created_at in descending order
                    ->paginate(5);

        return response()->json(['data' => $data], 200);
    }

    public function store(Request $request): JsonResponse {
        // Validate the request data and store in variables
        $validatedData = $request->validate([
            'thumbnail' => 'required|mimes:png,jpg,jpeg,webp',
            'toko_id' => 'required|exists:toko,id',
            'user_id' => 'required|exists:users,id',
            'nama_produk' => 'required',
            'tanggal_dibuat' => 'required',
            'tanggal_terjual' => 'nullable',
            'berat' => 'required|min:0',
            'tukeran' => 'required|min:0',
            'kadar' => 'required|min:0',
            'persentase' => 'required|min:0',
            'harga_beli' => 'required|min:0',
            'harga_jual' => 'required|min:0',
            'status_stok' => 'required|in:y,n',
            'EL_HAU' => 'required|in:y,n',
            'jenis_emas_id' => 'required|exists:jenis_emas,id',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'stok' => 'required|min:0',
        ]);

        // Generate unique code for kode
        $code = date('YmdHis') . Emas::latest('id')->first()->id + 1;

        // Rename and save thumbnail
        $thumbnailPath = $request->file('thumbnail')->storeAs('emas', $code . '.' . $request->file('thumbnail')->getClientOriginalExtension(), 'public');

        // Apply logic for status_stok and stok
        $stok = $validatedData['stok'];
        if ($validatedData['status_stok'] === 'y') {
            $stok = max(1, $stok);
        } else {
            $stok = max(0, $stok);
        }

        // Create new emas instance with validated data
        $emas = new Emas($validatedData);
        $emas->kode = $code;
        $emas->thumbnail = $thumbnailPath;
        $emas->stok = $stok;

        // Save the emas record
        $emas->save();

        return response()->json($emas, 200);
    }


    public function edit(Request $request) {
        $id = $request->id;
        $data = Emas::with(['Toko', 'User', 'JenisEmas', 'JenisBarang'])->findOrFail($id);

        return response()->json($data);
    }

    public function update(Request $request) {
        $validatedData = $request->validate([
            'thumbnail' => 'required|mimes:png,jpg,jpeg,webp',
            'toko_id' => 'required|exists:toko,id',
            'user_id' => 'required|exists:users,id',
            'nama_produk' => 'required',
            'tanggal_dibuat' => 'required',
            'tanggal_terjual' => 'nullable',
            'berat' => 'required|min:0',
            'tukeran' => 'required|min:0',
            'kadar' => 'required|min:0',
            'persentase' => 'required|min:0',
            'harga_beli' => 'required|min:0',
            'harga_jual' => 'required|min:0',
            'status_stok' => 'required|in:y,n',
            'EL_HAU' => 'required|in:y,n',
            'jenis_emas_id' => 'required|exists:jenis_emas,id',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'stok' => 'required|min:0',
        ]);

        try {
            // Find the Buku model by id or fail
            $buku = Emas::findOrFail($request->id);

            $slug = Str::slug($request->input('penulis')).'/'.Str::slug($request->input('judul'));


            // Save thumbnail to storage if provided
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('buku', 'public');
                // Delete old thumbnail if exists
                if ($buku->thumbnail) {
                    Storage::disk('public')->delete($buku->thumbnail);
                }
            } else {
                $thumbnailPath = $buku->thumbnail; // Keep the existing thumbnail if no new thumbnail is provided
            }

            // Update the model attributes
            $buku->update([
                'slug' => $slug,
                'judul' => $request->input('judul'),
                'sinopsis' => $request->input('sinopsis'),
                'stok' => $request->input('stok'),
                'penulis' => $request->input('penulis'),
                'penerbit' => $request->input('penerbit'),
                'tahun_terbit' => $request->input('tahun_terbit'),
                'thumbnail' => $thumbnailPath, // Assign thumbnail path to the model
            ]);

            // Process kategori_id[]
            $kategoriIds = $request->input('kategori_id', []);
            $existingKategoriIds = $buku->kategoriBukuRelasi()->pluck('kategori_id')->toArray();

            // Delete records that exist in the database but not in the new array
            $deleteIds = array_diff($existingKategoriIds, $kategoriIds);
            KategoriBukuRelasi::whereIn('kategori_id', $deleteIds)->where('buku_id', $buku->id)->delete();

            // Add new records from the array that do not exist in the database
            $newIds = array_diff($kategoriIds, $existingKategoriIds);
            foreach ($newIds as $newId) {
                KategoriBukuRelasi::create([
                    'kategori_id' => $newId,
                    'buku_id' => $buku->id,
                ]);
            }

            // Return a JSON response indicating success
            return response()->json(['message' => 'Data updated successfully']);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., model not found)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Emas::findOrFail($request->id);
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }
}
