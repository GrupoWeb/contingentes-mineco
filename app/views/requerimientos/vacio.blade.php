<div class="form-group nuevos" id="file{{Input::get('id')}}">
  <label class="col-sm-7 control-label">{{Input::get('nombre')}}</label>
  <div class="col-sm-5">{{ Form::file('file' . Input::get('id'), array(
  	'data-bv-notEmpty'=>'true',
  	'data-bv-notEmpty-message' => 'El archivo es requerido'
  	)) }}</div>
</div>