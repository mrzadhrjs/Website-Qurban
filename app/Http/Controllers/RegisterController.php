<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register', [
            
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email:rfc|unique:user',
            'username' => 'required|min:2|max:255|unique:user',
            'name' => 'required|max:100',
            'phone' => 'required',
            'alamat' => 'required|min:5|max:255',
            'password' => 'required|min:5|max:255'
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/');
    }
}