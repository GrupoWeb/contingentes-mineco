<?php namespace Csgt\Login;

use BaseController, View, Auth, Redirect, Config, 
Validator, Input, Password, Session, Hash, DB, Crypt;

class signupController extends BaseController {
	public function index() {
    $camposExtra = Config::get('login::camposextraregistro');
    $camposHTML  = '';

    foreach($camposExtra as $campo => $values) {
      switch($values['tipo']) {
        case 'string':
          $camposHTML .= '<div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="'.$values['icono'].'"></span></span><input type="text" id="'.$campo.'" name="'.$campo.'" class="form-control" placeholder="'.$values['titulo'].'" ></div></div>';
          break;
        case 'combobox':
          $camposHTML .= '<div class="form-group"><label><span class="'.$values['icono'].'"></span>'.$values['titulo'].'</label><select id="'.$campo.'" name="'.$campo.'" class="form-control">';
          $data = DB::table($values['combotabla']);
          if($values['combowhere'] <> '')
            $data->whereRaw($values['combowhere']);
          $data = $data->get();
          foreach ($data as $d){
            $camposHTML .= '<option value="'.$d->$values['combokey'].'">'.$d->$values['comboval'].'</option>';
          }
          $camposHTML .= "</select></div>";
          break;
        case 'tinyint':
          $camposHTML .= '<div class="checkbox"><label><input type="checkbox" name="'.$campo.'" id="'.$campo.'" /> '.$values['titulo'].'</label></div>';
          break;
        case 'lista':
          $camposHTML .= '<div class="form-group"><label><span class="'.$values['icono'].'"></span>'.$values['titulo'].'</label><select id="'.$campo.'" name="'.$campo.'" class="form-control">';
          foreach($values['valores'] as $key => $val)
            $camposHTML .= '<option value="'.$key.'">'.$val.'</option>';
          $camposHTML .= "</select></div>";
          break;
      }      
    }

    dd('here');

		return View::make('login::login')
			->with('route', 'signup.store')
			->with('mainPartial', 'signupPartial')
			->with('footerPartial', 'signupPartialFooter')
      ->with('extraFields', $camposHTML);
	}

	public function validateEmail() {
    $aEmail = Input::get(Config::get('login::usuario.campo'));
		$result = DB::table(Config::get('login::tabla'))->where('email', $aEmail)->first();
    if ($result) $val='false';
    else $val='true';
    return json_encode(array('valid'=>$val));
	}

	public function store() {
        //dd(Input::file());

    $usuario = DB::table('authusuarios');
   
    $arr = array(
      'email'      => Input::get('email'),
      'nombre'     => Input::get('txNombre'),
      'password'   => Hash::make(Input::get('txPassword')),
      'rolid'      => 3,
      'activo'     => 0,
      'created_at' => date_create(),
      'updated_at' => date_create()
    );
    $usuarioId = $usuario->insertGetId($arr);

    DB::table('usuarioproductos')->insert(array(
      'usuarioid'=>$usuarioId, 
      'productoid'=>Crypt::decrypt(Input::get('cmbProductos'))
    ));

    foreach (Input::file() as $key=>$val) { 
      if ($key=='txArchivo') continue;
    	if ($val) {
				$arch   = Input::file($key);
				$nombre = date('YmdHis') . '.' . $arch->getClientOriginalExtension();
				$res    = $arch->move(public_path() . '/archivos/' . $usuarioId, $nombre);
				DB::table('usuariorequerimientos')->insert(array(
					'usuarioid'=>$usuarioId,
					'requerimientoid'=>substr($key,4),
					'archivo' => $nombre,
					'created_at' => date_create(),
      		'updated_at' => date_create()
				));
			}
    }


    return Redirect::to('/login')
      ->with('flashMessage',Config::get('login::signupexitoso'))
      ->with('flashType','success');
	}
}