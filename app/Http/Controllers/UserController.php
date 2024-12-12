<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Exception;
use App\Models\Country;
use App\Events\UserInformation;
use App\Service\DiscordWebhookService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{

            $countries = Country::all();
            $search = $request->get('search');

            if(!empty($search)){
                $users = User::where('names', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->orWhere('lastnames', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                ->orWhere('gender', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $search . '%')
                ->orWhereHas('country', function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->get();
            }
            else{
                $users = User::paginate(10);
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
            $request->merge([
                'password' => bcrypt($request->password),
            ]);

            $user = User::create($request->all());

            event(new UserInformation($user, 'create'));

            return redirect()->route('usuarios.index')->with('success', 'Usuario creado de manera exitosa');

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
            $countries = Country::all();
            $user = User::findOrFail($id);
            return view('users.show', compact('user', 'countries'));

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
        $user = User::find($id);

        $user->update($request->all());

        event(new UserInformation($user, 'update'));

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado de una manera exitosa');
        try{
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

            event(new UserInformation($user, 'delete'));

            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado de una manera exitosa');
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
