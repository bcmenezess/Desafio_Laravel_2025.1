<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function table(){
        $admins = Admin::paginate(6);

        return view('admin.admins-table',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('admin.add-admin');
    }

    public function store(StoreAdminRequest $request)
    {
        $validatedData = $request->validated();
        $logado = usuarioLogado();

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('profiles', 'public');
        } else {
            $imagePath = null;
        }

        $admin = Admin::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf'],
            'address' => $validatedData['address'],
            'date_birth' => $validatedData['date_birth'],
            'telephone' => $validatedData['telephone'],
            'password' => Hash::make($validatedData['password']),
            'photo' => $imagePath,
            'admin_id' => $logado->id,
        ]);

        if($admin){
            return redirect()->route('admins-table');
        }

        return redirect()->back();
    }

    public function editView($id){
        $admin = Admin::findOrFail($id);
        return view('admin.edit-admin',compact('admin'));
    }

    public function edit(UpdateAdminRequest $request, $id){
        $validatedData = $request->validated();
        $admin = Admin::find($id);

        if ($request->hasFile('photo')) {
            if ($admin->photo) {
                Storage::disk('public')->delete($admin->photo);
            }

            $imagePath = $request->file('photo')->store('profiles', 'public');

            $admin->photo = $imagePath;
        }

        if($request->filled('password')){
            $admin->password = Hash::make($request->password);
        }

        $admin = $admin->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf'],
            'address' => $validatedData['address'],
            'date_birth' => $validatedData['date_birth'],
            'telephone' => $validatedData['telephone'],
        ]);

        if($admin){
            return redirect()->route('admins-table');
        }

        return redirect()->back();
    }

    public function view($id){
        $admin = Admin::findOrFail($id);
        return view('admin.view-admin',compact('admin'));
    }

    public function deleteView($id){
        $admin = Admin::find($id);
        return view('admin.delete-admin',compact('admin'));
    }

    public function delete($id){
        $admin = Admin::find($id);

        if(isset($admin->photo)){
            Storage::disk('public')->delete($admin->photo);
        }

        if(usuarioLogado() == $admin){
            Auth::logout();
        }

        $admin->delete();

        return to_route('admins-table');
    }
}
