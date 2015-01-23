{{Form::open(array('class'=>'form-horizontal','role'=>'form', 'target'=>'_blank'))}}
  <div class="panel panel-default">
    <br>
    @if (in_array('fechaini', $filters) )
      <div class="form-group">
        <label class="col-sm-2 control-label" for="fechaini">Fecha Ini</label>
        <div class="col-sm-10">
          <?php 
            $iniciomes = date('01/m/Y');
          ?>
          <div class="input-group date catalogoFecha">
            {{ Form::text('fechaini', $iniciomes , array('class' => 'form-control', 'data-date-language'=>'es', 
            'data-date-pickTime'=>false)) }}
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
          </div>
        </div>
      </div>
    @endif
    @if (in_array('fechafin', $filters) )
      <div class="form-group">
        <label class="col-sm-2 control-label" for="fechafin">Fecha Fin</label>
        <div class="col-sm-10">
          <?php 
            $hoy = date('d/m/Y');
          ?>
          <div class="input-group date catalogoFecha">
            {{ Form::text('fechafin', $hoy , array('class' => 'form-control', 'data-date-language'=>'es', 
            'data-date-pickTime'=>false)) }}
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
          </div>
        </div>
      </div>
    @endif








    @if (in_array('productos', $filters) )
      <div class="form-group">
        <label class="col-sm-2 control-label" for="productoid">Productos</label>
        <div class="col-sm-10">
          <select name="productoid" class="selectpicker">    
            <option value="0">(Todos)</option>       
            @foreach ($productos as $producto)
              <option value="{{$producto->productoid}}">{{$producto->nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
    @endif


    
    <div class="form-group">
      <label class="col-sm-2 control-label" for="formato">Formato</label>
      <div class="col-sm-10">
        <div class="radio">
          <label>
            <input type="radio" name="formato" id="formatoHTML" value="html" checked>
            HTML
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="formato" id="formatoExcel" value="excel">
            Excel
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2">&nbsp;</div>
      <div class="col-sm-10"> 
        <button class="btn btn-success" type="submit">Generar</button>
      </div>
    </div>
  </div>
{{Form::close()}}
<script type="text/javascript">
		$(function() {
			$('.catalogoFecha').datetimepicker();
      $('.selectpicker').selectpicker();
		});
	</script>