<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }


    public function store(Request $request){ 
      
        //validacion
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //en caso que el usuario no pueda logear por email y correo incorrecto
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()-> with('mensaje','Credenciales Incorrectas');
            //retorna a view login para ingresar la credencial nuevamnete y que muestre ese mensaje error
        }
        // me aparece el mensaje en una sesion que debo crear en una view con if (session('mensaje'))

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
