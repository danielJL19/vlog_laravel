@extends('layouts.home')
@section('content')
    <!--LISTA DE ARTICULOS-->
    <div class="md:container mx-auto">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 my-8">
            @foreach ($articles as $article)
                <figure
                    class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                    <a href="{{route('article.cliente.show',$article->id)}}">
                        <img class="rounded-lg"
                            src="{{asset('storage/'.$article->photo)}}"
                            alt="image description">
                    </a>
                    <figcaption class="absolute px-4 text-lg text-white bottom-6">
                        <p class="text-center">{{$article->nombre}}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>

    </div>
@endsection
