<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $roles = \Spatie\Permission\Models\Role::all(); // ✅ Tambah ini
        return view('admin.users.create', compact('roles')); // ✅ Kirim ke view

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8', // Adjust the min length as per your requirements
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if ($user->save()) {
            $user->syncRoles($request->input('roles', [])); // ✅ Tambahan ini
            flash()->addSuccess('User created successfully.');
            return redirect()->route('admin.users.index');
        }
        flash()->addError('User create fail!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Ambil semua roles yang ada
        $roles = \Spatie\Permission\Models\Role::pluck('name', 'id');
        
        // Ambil roles yang dimiliki oleh pengguna ini
        $userRoles = $user->roles->pluck('id')->toArray();

        // Kembalikan view dengan data pengguna, roles, dan roles pengguna
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array', // Pastikan roles dipilih
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Sync roles (mengupdate roles pengguna)
        $user->syncRoles($request->input('roles'));

        flash()->addSuccess('User updated successfully.');

        return redirect()->route('admin.users.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        flash()->addSuccess('User deleted successfully.');
        return redirect()->route('admin.users.index');

    }

    public function banUnban($id, $status)
    {
        if (auth()->user()->hasRole('Guru')){
            $user = User::findOrFail($id);
            $user->status = $status;
            if ($user->save()){
                flash()->addSuccess('User status updated successfully.');
                return redirect()->back();
            }
            flash()->addError('User status update fail!');
            return redirect()->back();
        }
        return redirect(Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    
}
