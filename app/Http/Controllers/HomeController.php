<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;//MEDIANTE LOS MODELOS PODEMOS LLAMAR A SU TABLA 

class HomeController extends Controller
{
    public function index(){
        //LLAMAR AL ARTICULO 
        $articles=Article::all();
        return view('home',compact('articles'));
    }
    
    public function show($id){
        //buscar articulo
        $article = Article::findOrFail($id);
        return view('show',compact('article'));
    }
}
