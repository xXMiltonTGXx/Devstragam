<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20', 'regex:/\w*$/','not_in:twiiter,editar-perfil,login,register'], 
            'email' => ['required','unique:users,email,'.auth()->user()->id, 'email', 'max:60']

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
        $usuario->email = $request->email ?? auth()->user()->email;
        $usuario->save();

        // Cambiar la contraseña
        if($request->password || $request->new_password){   
            $this->validate($request, [
                'password' => 'required|min:6',
                'new_password' => 'required|min:6'
            ]); 
            if(Hash::check($request->password, $usuario->password)){   
            
                $usuario->password = Hash::make($request->new_password); 
                $usuario->save();
                
                // Auth::logout();
                // $request->session()->invalidate();
                // $request->session()->regenerateToken();
                // return redirect()->route('login');
                    
            } else {  
                return back()->with('mensaje', 'El password antiguo no coincide.');
            } 
        }     
        //redireccionar
        return redirect()->route('posts.index', $usuario->username);

    }
}   
