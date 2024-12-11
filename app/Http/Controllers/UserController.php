<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Exception;
use App\Models\Country;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $users = User::paginate(10);
            $countries = Country::all();

            return view('users.index', compact('users', 'countries'));
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $user = new User();
            $countries = Country::all();

            return view('users.save', compact('user', 'countries'));
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());

            return redirect()->route('usuarios.index')->with('success', 'Usuario creado de una manera exitosa');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user = User::findOrFail($id);
            return view('users.show', compact('user'));
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $user = User::findOrFail($id);
            $countries = Country::all();

            return view('users.save', compact('user', 'countries'));
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $user = User::find($id);

            $user->update($request->all());

            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado de una manera exitosa');
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::find($id);

            $user->delete();

            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado de una manera exitosa');
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
