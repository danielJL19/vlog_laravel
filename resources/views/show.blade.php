@extends('layouts.home')
@section('content')
    <!--ARTICULOS ELEGIDO-->
    <div class="md:container mx-auto">
      <div class="articulo">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white text-center py-5">{{$article->nombre}}</h1>
            <div class="articulo-imagen">
                <img class="h-auto max-w-full mx-auto w-full articulo-imagen" src="{{asset('storage/'.$article->photo)}}" alt="image description">
            </div>

        <div class="articulo-descripcion">
            <p class="text-4xl font-thin text-gray-900 dark:text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente, voluptate.</p>
        </div>
      </div>

    </div>
@endsection