<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function select(Request $request) {
        // Pluck id and nama_toko
        $query = DB::table('payment');
        // $query->where('deleted_at', '='  , NULL);
        // If search parameter is not null, add where clause
        if ($request->search !== null) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $result = $query->select('id as id', 'nama as text')->get();


        return response()->json($result);
    }

}
