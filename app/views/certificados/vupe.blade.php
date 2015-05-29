<?php
	$ancho = 500;
?>

<style>
	body {
		font-size: 14px;
	}
  
	.nota {
		font-style: italic;
	}

	.center {
		text-align: center;
	}

	.justify {
		text-align: justify;
	}

	.size10 {
		font-size: 10px;
	}

	.size12 {
		font-size: 12px;
	}

	.border {
		border: 1px solid black;
	}
</style>
<br/><br/><br/><br/><br/>
<table width="{{ $ancho }}" align="center">
	<tr>
		<td>&nbsp;</td>
		<td colspan="2" class="center">Licencia No.: {{ $datos->numerocertificado }}<br /><br /></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" class="center"><br /><h3>LICENCIA DE EXPORTACION<br>{{ strtoupper($datos->producto) }}</h3></td>
	</tr>
	<tr>
		<td colspan="4" class="center"><h4>La Dirección de Administración del Comercio Exterior<br>-DACE-</h4></td>
	</tr>
	<tr>
		<td colspan="4" class="size10 justify">{{ $datos->tratadodescripcion }}<br /></td>
	</tr>
</table>

<table width="{{ $ancho }}" style="border-collapse: collapse" cellpadding="5" style="font-size: 10px;">
	<tr>
		<td class="border"><strong>AUTORIZA A:</strong></td>
		<td colspan="3" class="border">{{ $datos->nombre }}</td>
	</tr>
	<tr>
		<td class="border"><strong>DOMICILIO FISCAL:</strong></td>
		<td colspan="3" class="border">{{ $datos->direccion }}</td>
	</tr>
	<tr>
		<td colspan="1" class="center border"><strong>NIT:</strong></td>
		<td colspan="2" class="center border"><strong>CODIGO VUPE:</strong></td>
		<td colspan="1" class="center border"><strong>TELEFONO:</strong></td>
	</tr>
	<tr>
		<td colspan="1" class="center border">{{ $datos->nit }}</td>
		<td colspan="2" class="center border">{{ $datos->codigovupe }}</td>
		<td colspan="1" class="center border">{{ $datos->telefono }}</td>
	</tr>
	<tr>
		<td class="center border" colspan="3"><strong>VOL&Uacute;MEN AUTORIZADO</strong></td>
		<td class="center border" rowspan="2"><strong>UNIDAD DE MEDIDA:</strong></td>
	</tr>
	<tr>
		<td class="center border"><strong>EN N&Uacute;MEROS:</strong></td>
		<td colspan="2" class="center border"><strong>EN LETRAS:</strong></td>
	</tr>
	<tr>
		<td class="center border">{{ $datos->volumen }}</td>
		<td colspan="2" class="center border">{{ $datos->volumenletras }}</td>
		<td class="center border" colspan="2">{{ $datos->unidades }}</td>
	</tr>
	<tr>
		<td class="center border"><strong>FRACCION ARANCELARIA:</strong></td>
		<td colspan="3" class="center border"><strong>DESCRIPCI&Oacute;N DE LA MERCANC&Iacute;A</strong></td>
	</tr>
	<tr>
		<?php $fraccion = explode(' ', $datos->fraccion); ?>
		<td class="center border">{{ $fraccion[0] }}</td>
		<td colspan="3" class="center border">
			<?php $descipcion = ''; ?>
			@for($i=1;$i<count($fraccion);$i++)
				<?php $descipcion .= $fraccion[$i]. ' '; ?>
			@endfor
			{{ $descipcion }}
		</td>
	</tr>
	<tr>
		<td colspan="2" class="center border"><strong>FECHA DE EMISI&Oacute;N:</strong></td>
		<td colspan="2" class="center border"><strong>FECHA DE VENCIMIENTO:</strong></td>
	</tr>
	<tr>
		<td colspan="2" class="center border">{{ $datos->fecha }}</td>
		<td colspan="2" class="center border">{{ $datos->fechavencimiento }}</td>
	</tr>
	<tr>
		<td colspan="4" class="center border"><strong>FIRMA Y SELLO DE LA AUTORIDAD EMISORA DE CONTINGENTES ARANCELARIOS</strong></td>
	</tr>
	<tr>
		<td colspan="4" class="border">
			<br/><br/><br/><br/><br/><br/>
		</td>
	</tr>
</table>
<br/>
<table width="{{ $ancho }}">
	<tr>
		<td colspan="4">
			<span class="nota justify"><small><strong>NOTA:</strong> Esta licencia de Exportación es válida únicamente por la cantidad aquí descrita y para una sola exportación, bajo ningún motivo puede ser transferida, negociada o cedida. La presentación de ésta Licencia no exime al exportador de cumplir con las obligaciones establecidas en la legislación guatemalteca.
				</small>
			</span>
		</td>
	</tr>
</table>