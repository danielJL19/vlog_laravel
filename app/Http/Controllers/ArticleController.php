<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
class ArticleController extends Controller

{
    /**
     *LISTADO DE TODOS LOS ARTICULOS
     */
    public function index()
    {
        //obtener todos los articles 

    }

    /**
     * MOSTRAR POR ARTICULO
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        
        $article =new Article;
        $article->nombre=$request->nombre;
        $article->descripcion=$request->descripcion;
        $article->category_id=$request->category_id;
        $article->user_id=auth()->user()->id;
        //archivo 
        if ($request->hasFile('photo')) {
            $file = $request->file('image');// hace referencia a la imagen 
            $path = Storage::put('public/images',$request->file('photo'));
            $nuevo_path = str_replace('public/','',$path);
            $article->photo = $nuevo_path;
        }
        $article->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);//buscar mediante el id , el producto elegido //error 404
        $categories = Category::all();
        //condicional 
        if ($article->user_id != auth()->user()->id ) { //1--daniel jimenez    1 es distinto a autor logeada(2)   
            abort(403,"Este articulo no te pertenece");
        }
        return view('edit_dashboard',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        
        $article1 = Article::findOrFail($article->id);//5

        //VERIFICAR SI ES EL AUTOR QUE CREO LA PUBLICACION
        if ($article1->user_id != auth()->user()->id) {
            abort(403,'No tiene permisos para acceder a este articulo');
        } 
        
        $article1->nombre= $request->nombre;
        $article1->descripcion=$request->descripcion;
        $article1->category_id= $request->category_id;
        if ($request->hasFile('photo')) {
            //SI TIENE ARCHIVOS CARGADOS
            Storage::delete('public/'.$article->photo);
            $path = Storage::put('public/images',$request->file('photo'));
            $nuevo_path = str_replace('public/','',$path);
            $article1->photo = $nuevo_path;
        }
        $article1->save();
        session()->flash('article-update','Se ha actualizado con éxito el articulo');
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        //VERIFICAR SI EL ARTICULO EXISTE
        $article = Article::findOrFail($id); // : articulo // F- error 404

        //VERIFICAR SI EL USUARIO ES EL CREADOR DEL ARTICULO 
        if (auth()->user()->id != $article->user_id) { // danieljmnz15@hotmail -> 1 == articl)
            abort(403,'No tiene permisos para acceder a este articulo');
        }
        if ($article->photo) {
            Storage::delete('public/'.$article->photo);
        }
        //borrar article 
        $article->delete();
        session()->flash('article-delete','Este producto se ha eliminado exitosamente');
        return redirect('dashboard');
    }
}
