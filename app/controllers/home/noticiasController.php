<?php

class noticiasController extends BaseController {
	
	public function index() {
		$noticias = Noticia::getNoticias();
		//retorna a la vista
		return View::make('home.noticias', ['noticias'=>$noticias]);
	}
}