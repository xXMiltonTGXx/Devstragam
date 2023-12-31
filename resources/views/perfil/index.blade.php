@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection



@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store', auth()->user()->username)}}" enctype="multipart/form-data" class="mt-10 md:mt-0" method="POST" >
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username"name="username" placeholder="Tu nombre de usuario"
                    class="border p-3 w-full rounded-lg @error('username')
                    border-red-500                        
                    @enderror"
                    value="{{auth()->user()->username}}"                    
                    >
                    @error('username')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input type="file" id="imagen"name="imagen"
                    class="border p-3 w-full rounded-lg" accept=".jpg, .jpeg, .png"
                    value=""> 
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> email</label>
                    <input type="email" id="email"name="email" placeholder="Tu Email de Registro"
                    class="border p-3 w-full rounded-lg @error('email')
                    border-red-500                       
                    @enderror"
                    value="{{auth()->user()->email}}"  
                    >
                    @error('email')
                    <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror 
                </div>

                
                <div class="mb-5">
                    @if (session('mensaje'))
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
                    @endif
                    
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> Ingrese la contraseña anterior</label>
                    <input type="password" id="password"name="password" placeholder="Tu Password de Registro"
                    class="border p-3 w-full rounded-lg" 
                    >
                    @error('password')
                    <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror

                </div>
                
                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">Ingese la contraseña nueva</label>
                    <input type="password" id="new_password"name="new_password" placeholder="Ingrese el nuevo Password"
                    class="border p-3 w-full rounded-lg">
                    
                </div>  

                <input type="submit" value="Guardar Datos" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
        
    </div>

@endsection