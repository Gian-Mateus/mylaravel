<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(){
        return "Produtos";
    }

    public function detail($id){
        return "Produto: ".$id;
    }
}
