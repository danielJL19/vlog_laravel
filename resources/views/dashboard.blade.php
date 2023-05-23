<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!--CREAR PRODUCTO-->
                    <button data-modal-target="small-modal" data-modal-toggle="small-modal"
                        class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Crear Articulo
                    </button>

                    <div id="small-modal" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                        Articulo
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="small-modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <!-- Form Article -->
                                    <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-6">
                                            <label for="default-input"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                            <input type="text" id="default-input" name="nombre"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="mb-6">
                                            <label for="underline_select" class="sr-only">Underline select</label>
                                            <select id="underline_select" name="category_id"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                <option selected value="0">Selecciona una Categoría</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->nombre}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mb-6">
                                            <!-- text area -->
                                            <label for="large-input"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                                                <textarea name="descripcion" id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Escribe un comentario" required></textarea>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                for="file_input">Upload file</label>
                                            <input
                                                name="photo"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                aria-describedby="file_input_help" id="file_input" type="file">
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                id="file_input_help">Solo Admite PNG O JPG </p>
                                        </div>
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear Articulo</button>
                                    </form>
                                </div>
           

                            </div>
                        </div>
                    </div>


                    <h3 class="py-3">Todos tus Articulos</h3>
                    <x-flash/>

                    <!--TABLA ARTICULO-->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Descripción
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Categoria
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Imagen
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Creado en
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$article->nombre}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{Str::substr($article->descripcion, 0, 5) }}...
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$article->category_id}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{asset('/storage/'.$article->photo)}}" alt="dasdas"> 
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$article->created_at}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{route('article.edit',$article->id)}}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{route('article.destroy',$article->id)}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                    

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
