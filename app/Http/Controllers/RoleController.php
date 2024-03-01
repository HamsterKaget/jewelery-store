<?php

namespace App\Http\Controllers;

// use App\Models\Permission;
use Spatie\Permission\Models\Role as RoleSpatie;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index() {
        return view('web.sections.dashboard.roles.index');
    }

    public function getData(Request $request)
    {
        $query = Role::query()->with(['Permission']);

        if ($request->search) {
            $query->where('name', 'LIKE', "%" . $request->search . "%");
        }

        $data = $query->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                    ->orderBy('created_at', 'desc') // Then order by created_at in descending order
                    ->paginate(10);

        return response()->json(['data' => $data],200);
    }

    public function store(Request $request): JsonResponse {
        try {
            $data = $request->validate([
                "name" => 'required',
                "guard_name" => 'required',
                "permissions" => 'array|required', // Assuming permissions are sent as an array
            ]);

            // Create the role
            $createdRole = RoleSpatie::create([
                'name' => $data['name'],
                'guard_name' => $data['guard_name'],
            ]);

            // Attach permissions to the role
            $permissions = Permission::whereIn('id', $data['permissions'])->get(); // Fetch permissions by IDs
            $createdRole->syncPermissions($permissions);

            return response()->json($createdRole, 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function edit(Request $request) {
        $id = $request->id;
        $kategori_buku = Role::with(['Permission'])->findOrFail($id);

        return response()->json($kategori_buku);
    }

    public function update(Request $request) {
        $request->validate([
            "id" => 'required|exists:roles,id',
            "name" => 'required',
            "guard_name" => 'required',
            "permissions" => 'array|required', // Assuming permissions are sent as an array
        ]);

        try {
            $Role = RoleSpatie::findOrFail($request->id);

            $Role->update([
                'name' => $request->name,
                "guard_name" => $request->guard_name,
            ]);

            // Attach permissions to the role
            $permissions = Permission::whereIn('id', $request->permissions)->get(); // Fetch permissions by IDs
            $Role->syncPermissions($permissions);

            return response()->json(['message' => 'Data updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $data = Role::findOrFail($request->id);
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function select(Request $request) {
        // Pluck id and name
        $query = DB::table('roles');
        // $query->where('deleted_at', '='  , NULL);
        // If search parameter is not null, add where clause
        if ($request->search !== null) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $result = $query->select('id as id', 'name as text')->get();


        return response()->json($result);
    }


}
