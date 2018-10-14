<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('administration::test');
});

// {"ID_USUARIO":0,"USUARIO_RED":"Administrador","NOMBRE":"Administrador","APELLIDOS":"TAU PRODUCCION"}

/*
Crear un nuevo controlador en Admin fuera de API/v1 que reciba todas los metodos
para los de las vistas que devuelva la vista correspondiente
para las otras que pida los datos via command bus e inyecte los datos en la vista de la forma habitual
el nuevo controlador crearlo desde artisan module:create:controller
*/

/*
Route::get('/index', function(){
    return view('administration::index', [
        'users' => [
            new uu(['id' => 1,
            'name' => 'Nombre',
            'email' => 'correo@host.net',
            'nerd_level' => 1])
        ]
    ]);
});

Route::get('games', function () {
    return view('games', [
        'games' => [
            new uuu(['CastlevaniaA','CastlevaniaB']),
            new uuu(['GalagaA', 'GalagaB']),
            new uuu(['Ghosts n GoblinsA', 'Ghosts n GoblinsB'])
        ]
    ]);
});

class uuu {
    private $v;
    public function __construct(array $a){
        $this->v = $a;
    }
    public function a(){return $this->v[0];}
    public function b(){return $this->v[1];}
}

class uu {
    public $id;
    public $name;
    public $email;
    public $nerd_level;

    public function __construct(array $a){
        $this->id = $a['id'];
        $this->name = $a['name'];
        $this->email = $a['email'];
        $this->nerd_level = $a['nerd_level'];
    }
}*/