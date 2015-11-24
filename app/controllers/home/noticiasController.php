<?php

class noticiasController extends BaseController {
	
	public function index() {
		$noticias = Noticia::getNoticias();

		return View::make('home.noticias', ['noticias'=>$noticias]);
	}
}