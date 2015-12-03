<?php

class noticiasController extends BaseController {
	
	public function index() {
		$noticias = Noticia::getNoticias();
		//retorna a la vista
		return View::make('home.noticias', ['noticias'=>$noticias]);
	}

	public function show($id) {
		$noticia = Noticia::getNoticiaFromSlug($id);

		return View::make('home.noticia', ['noticia'=>$noticia]);
	}
}