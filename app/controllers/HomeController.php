<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

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