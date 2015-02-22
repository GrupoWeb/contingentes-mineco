<div class="form-group nuevos" id="file{{Input::get('id')}}">
  <label for="file{{Input::get('id')}}" class="col-sm-12">{{Input::get('nombre')}}</label>
  <div class="col-sm-12">
	  {{ Form::file('file' . Input::get('id'), array(
			'data-bv-notEmpty'         => 'true',
			'data-bv-notEmpty-message' => 'El archivo es requerido',
			'class'                    => 'file'
	  	)) }}
  	</div>
</div>