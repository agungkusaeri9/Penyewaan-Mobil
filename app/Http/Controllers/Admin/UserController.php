<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::role('customer')->orderBy('name', 'ASC')->get();
        return view('admin.pages.user.index', [
            'title' => 'Customer',
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        $user = User::role('customer')->where('id', '!=', auth()->id())->where('id', $id)->firstOrFail();
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.pages.user.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        request()->validate([
            'name' => ['required', 'min:3'],
            'nomor_telepon' => ['required'],
            'nomor_sim' => ['required', 'numeric'],
            'alamat' => ['required'],
            'avatar' => ['image', 'mimes:jpg,jpeg,png,svg', 'max:2048']
        ]);

        if (request('password')) {
            request()->validate([
                'password' => ['min:5', 'confirmed'],
            ]);
        }

        DB::beginTransaction();
        try {
            $roles = request('roles');
            $data = request()->only(['name', 'nomor_telepon', 'nomor_sim', 'alamat', 'email']);
            request('password') ? $data['password'] = bcrypt(request('password')) : NULL;
            request()->file('avatar') ? $data['avatar'] = request()->file('avatar')->store('users', 'public') : NULL;
            $user->update($data);
            DB::commit();
            return redirect()->route('admin.customer.index')->with('success', 'Customer berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return redirect()->route('admin.customer.index')->with('success', 'Customer berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
