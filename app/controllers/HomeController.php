<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;

class HomeController extends Controller {
    public function index()
    {
        $usuario = new Usuario();
        $data = $usuario->getUserData();

        var_dump($data);
        //retorna a view de home
        $this->view('home/index', $data);
    }

    public function contact(){
        $this->view('home/contact');
    }
}