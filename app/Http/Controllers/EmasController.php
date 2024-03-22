<?php

namespace App\Http\Controllers;

use App\Models\Emas;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'nama_produk' => 'required',
            'tanggal_dibuat' => 'required',
            'tanggal_terjual' => 'nullable',
            'berat' => 'required|min:0',
            'tukeran' => 'required|min:0',
            'kadar' => 'required|min:0',
            'persentase' => 'required|min:0',
            'harga_beli' => 'required|min:0',
            'harga_jual' => 'required|min:0',
            'EL_HAU' => 'required|in:y,n',
            'jenis_emas_id' => 'required|exists:jenis_emas,id',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'stok' => 'required|min:0',
        ]);

        // Convert tanggal_dibuat to 'YYYY-MM-DD' format
        $validatedData['tanggal_dibuat'] = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_dibuat'])->format('Y-m-d');

        // Generate unique code for kode
        // $code = date('YmdHis') . Emas::latest('id')->first()->id + 1;

        // Get the latest Emas record
        $latestEmas = Emas::latest('id')->first();

        // Check if $latestEmas is not null
        if ($latestEmas) {
            // If there are existing records, generate the code based on the latest ID
            $code = date('YmdHis') . ($latestEmas->id + 1);
        } else {
            // If there are no records, start with a default ID value (e.g., 1)
            $code = date('YmdHis') . '1';
        }

        // Rename and save thumbnail
        $thumbnailPath = $request->file('thumbnail')->storeAs('emas', $code . '.' . $request->file('thumbnail')->getClientOriginalExtension(), 'public');

        // Determine status_stok based on stok value
        $statusStok = $validatedData['stok'] == 0 ? 'n' : 'y';

        // Apply logic for status_stok and stok
        $stok = $validatedData['stok'];
        if ($statusStok === 'y') {
            $stok = max(1, $stok);
        } else {
            $stok = max(0, $stok);
        }

        // Create new emas instance with validated data
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['kode'] = $code;
        $validatedData['thumbnail'] = $thumbnailPath;
        $validatedData['stok'] = $stok;
        $validatedData['status_stok'] = $statusStok; // Assign status_stok value
        $emas = new Emas($validatedData);

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
        'id' => 'required|exists:emas,id',
        'thumbnail' => 'nullable|mimes:png,jpg,jpeg,webp',
        'toko_id' => 'required|exists:toko,id',
        'nama_produk' => 'required',
        'tanggal_dibuat' => 'required|date_format:d/m/Y',
        'tanggal_terjual' => 'nullable|date_format:d/m/Y',
        'berat' => 'required|min:0',
        'tukeran' => 'required|min:0',
        'kadar' => 'required|min:0',
        'persentase' => 'required|min:0',
        'harga_beli' => 'required|min:0',
        'harga_jual' => 'required|min:0',
        'EL_HAU' => 'required|in:y,n',
        'jenis_emas_id' => 'required|exists:jenis_emas,id',
        'jenis_barang_id' => 'required|exists:jenis_barang,id',
        'stok' => 'required|min:0',
    ]);

    try {
        $emas = Emas::findOrFail($validatedData['id']);

        // Determine status_stok based on stok value
        $statusStok = $validatedData['stok'] == 0 ? 'n' : 'y';

        // Apply logic for status_stok and stok
        $stok = $validatedData['stok'];
        if ($statusStok === 'y') {
            $stok = max(1, $stok);
        } else {
            $stok = max(0, $stok);
        }

        // Update the thumbnail if provided
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail
            if ($emas->thumbnail) {
                Storage::disk('public')->delete($emas->thumbnail);
            }
            // Save the new thumbnail
            // $thumbnailPath = $request->file('thumbnail')->storeAs('emas', $emas->kode . '.' . $request->file('thumbnail')->getClientOriginalExtension(), 'public');
            $thumbnailPath = $request->file('thumbnail')->storeAs('emas', $emas->kode . '.' . $request->file('thumbnail')->getClientOriginalExtension(), 'public');

        } else {
            // Keep the existing thumbnail
            $thumbnailPath = $emas->thumbnail;
        }

        // Format tanggal_dibuat to 'Y-m-d' before updating
        $tanggalDibuat = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_dibuat'])->format('Y-m-d');

        // Update the Emas instance with validated data
        $emas->fill($validatedData);
        $emas->thumbnail = $thumbnailPath;
        $emas->tanggal_dibuat = $tanggalDibuat; // Assign formatted tanggal_dibuat
        $emas->stok = $stok;
        $emas->status_stok = $statusStok; // Assign status_stok value

        // Save the updated emas record
        $emas->save();

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

    public function select(Request $request) {
        // Pluck id, kode, and nama_produk
        $query = DB::table('emas')
                    ->where('stok', '>', 0);

        if ($request->search !== null) {
            $query->where('kode', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_produk', 'like', '%' . $request->search . '%');
        }

        $result = $query->select('id', DB::raw("CONCAT(kode, ' - ', nama_produk) AS text"))->get();

        return response()->json($result);
    }


}
