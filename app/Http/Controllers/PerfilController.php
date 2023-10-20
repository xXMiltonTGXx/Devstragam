<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user){ 
    $this->authorize('viewAny', $user);
    return view("perfil.index");
    }  
    
    public function store(Request $request){ 
         // modificar request
         $request->request->add(['username'=> Str::slug($request['username'])]);

        $this->validate($request,[
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twiiter,editar-perfil'], 
            // Rule::unique('users', 'username')->ignore(auth()->user()), otra forma  
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
    
            $imagenPath = public_path('perfiles') .'/' . $nombreImagen;
            $imagenServidor->save($imagenPath); 
        } 

        // Guardar Cambios

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        //redireccionar
        return redirect()->route('posts.index', $usuario->username);

    }
}   
