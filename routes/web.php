<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function(){
    return view('hello');
});

Route::get('/user/{id}', function($id){
    return 'User ID '.$id;
});

// Route::get('/produtos/{id?}', function($id = null){
//     $produtos = [
//         'Cerveja', 'Amendoin', 'Gin', 'Êxtase'
//     ];
//     if ($id) {
//     echo $produtos[$id];
//     } else {
//         print_r($produtos);
//     }
// });

//views em pastas
Route::get('/empresa', function(){
    return view('site/empresa');
});

Route::get('/minhaempresa', function(){
    return view('blog/empresa');
});

Route::get('/usuarios', function(){
    return view('usuarios/lista');
});

Route::get('/usuarios/add', function(){
    return view('usuarios/adiciona');
});
Route::get('/usuarios/edit', function(){
    return view('usuarios/edita');
});

Route::any('/any', function(){
    return "Any, qualquer coisa. Usando: ".$_SERVER['REQUEST_METHOD'];
});

//Rota para definir uma verbose
Route::match(['POST', 'GET'], '/contato', function(){
    return view('site/contato');
});

// Redirecionamento
Route::redirect('/user', '/usuarios');

// view sem verbose
Route::view('/política-de-privacidade', 'site/politica');

// rotas nomeadas
Route::get('/news', function(){
    return view('site/news');
})->name('noticias');

// rota de redirecionamento
Route::get('/novidades', function(){
    return redirect()->route('noticias');
});

// grupo de rotas
// padrão de rotas repetitivas
/* Route::get('/admin/dashboard', function(){
    return view('admin/dashboard');
});
Route::get('/admin/produtos', function(){
    return view('admin/produtos');
});
Route::get('/admin/dashboard', function(){
    return view('admin/usuarios');
}); */

//Grupo de Rotas com prefixo e namespaces
/* Route::prefix('admin')->group(function(){
    // definindo as rotas
    Route::get('dashboard', function(){
        return view('admin/dashboard');
    });
    Route::get('produtos', function(){
        return view('admin/produtos');
    });
    Route::get('usuarios', function(){
        return view('admin/usuarios');
    });
}); */

// Agrupameto por name
/* Route::name('admin.')->group(function(){

    Route::get('admin/dashboard', function(){
        return view('admin/dashboard');
    })->name('dashboard');
    
    Route::get('admin/produtos', function(){
        return view('admin/produtos');
    })->name('produtos');

    Route::get('admin/usuarios', function(){
        return view('admin/usuarios');
    })->name('usuarios');
}); */

// Agrupamento por Group
Route::group([
    "prefix" => "admin",
    "as" => "admin."
], function(){
    Route::get('dashboard', function(){
        return view('admin/dashboard');
    })->name('dashboard');
    
    Route::get('produtos', function(){
        return view('admin/produtos');
    })->name('produtos');

    Route::get('usuarios', function(){
        return view('admin/usuarios');
    })->name('usuarios');
});

// Rotas com controllers
// sintaxe -> Route::get('rota', [NomeClasse::class, 'metodo'])
// comando para criar controller : php artisan make:controller NomeController
Route::get('/produtos', [ProdutosController::class, 'index']);
Route::get('/produto/{id}', [ProdutosController::class, 'detail']);

// resources
Route::resource('/cadastro', CadastroController::class);