<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $formFields = $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',


        ]);
        // Create the user
        $user = new User;
        $user->name = $formFields['name'];
        $user->email = $formFields['email'];
        $user->password = Hash::make($formFields['password']);
        $user->save();
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
      /**
     * login.
     */
    public function showLoginForm()
    {
        return view('users/login');
    }

    public function login(Request $request)
    {
        try {
            $formFields = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
    
            $credentials = $request->only('email', 'password');
    
            if (auth()->attempt($credentials)) {
                // Authentication successful
                return redirect('/');
            } else {
                throw ValidationException::withMessages([
                    'email' => 'Invalid email or password.',
                ]);
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
