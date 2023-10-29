@extends("layouts.app")

@section('titulo')
   Principal
@endsection

@section('contenido')
   {{-- @if ($posts->count())
        <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:px-20">
        @foreach ( $posts as $post )
            <div>
                <a href="{{route('posts.show', ['post'=>$post, 'user' =>$post->user])}}">
                    <img src="{{ asset('uploads') . '/' . $post->imagen}}" alt="Imagende del post {{$post->titulo}}"  >
                </a>
            </div>   
        @endforeach
        </div>
        {{-- para paginar anterior y siguiente con links --}}
        {{-- <div class="my-10">
            {{$posts->links('pagination::tailwind')}}
        </div>
   @else    
        <p class="text-center">No hay Posts, sigue a alguien para poder mostrar sus posts</p>
   @endif --}}




   <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo> 
        <h1>Mostrando post desde slot</h1>
   </x-listar-post>


@endsection