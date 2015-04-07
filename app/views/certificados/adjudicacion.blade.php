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

<table width="550">
	<tr>
		<td>&nbsp;</td>
		<td colspan="2" class="center">Certificado No.: {{ $datos->certificadoid }}</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" class="center"><br /><h3>{{ $datos->tratado }}</h3></td>
	</tr>
	<tr>
		<td colspan="4" class="center"><br /><h4>La Dirección de Administración del Comercio Exterior<br>-DACE-</h4><br /></td>
	</tr>
	<tr>
		<td colspan="4" class="size10 justify">{{ $datos->tratadodescripcion }}<br /></td>
	</tr>
</table>

<table width="550" style="border-collapse: collapse" cellpadding="5" style="font-size: 10px;">
	<tr>
		<td class="border"><strong>AUTORIZA A:</strong></td>
		<td colspan="3" class="border">{{ $datos->nombre }}</td>
	</tr>
	<tr>
		<td class="border"><strong>DOMICILIO FISCAL:</strong></td>
		<td colspan="3" class="border">{{ $datos->direccion }}</td>
	</tr>
	<tr>
		<td colspan="2" class="center border"><strong>NIT:</strong></td>
		<td colspan="2" class="center border"><strong>TELEFONO:</strong></td>
	</tr>
	<tr>
		<td colspan="2" class="center border">{{ $datos->nit }}</td>
		<td colspan="2" class="center border">{{ $datos->telefono }}</td>
	</tr>
	<tr>
		<td class="center border"><strong>VOL&Uacute;MEN AUTORIZADO (EN N&Uacute;MEROS):</strong></td>
		<td class="center border"><strong>VOL&Uacute;MEN AUTORIZADO (EN LETRAS):</strong></td>
		<td class="center border"><strong>UNIDAD DE MEDIDA:</strong></td>
		<td class="center border"><strong>VARIACI&Oacute;N:</strong></td>
	</tr>
	<tr>
		<td class="center border">{{ $datos->volumen }}</td>
		<td class="center border">{{ $datos->volumenletras }}</td>
		<td class="center border">{{ $datos->unidades }}</td>
		<td class="center border">+/- 5%</td>
	</tr>
	<tr>
		<td class="center border"><strong>FRACCION ARANCELARIA:</strong></td>
		<td colspan="3" class="center border"><strong>DESCRIPCI&Oacute;N DE LA MERCANC&Iacute;A</strong></td>
	</tr>
	<tr>
		<?php $fraccion = explode(' ', $datos->fraccion); ?>
		<td class="center border">{{ $fraccion[0] }}</td>
		<td colspan="3" class="center border">{{ end($fraccion) }}</td>
	</tr>
	<tr>
		<td colspan="2" class="center border"><strong>PA&Iacute;S DE PROCEDENCIA:</strong></td>
		<td class="center border"><strong>FECHA DE EMISI&Oacute;N</strong></td>
		<td class="center border"><strong>FECHA DE VENCIMIENTO:</strong></td>
	</tr>
	<tr>
		<td colspan="2" class="center border">{{ $datos->paisprocedencia }}</td>
		<td class="center border">{{ $datos->fecha }}</td>
		<td class="center border">{{ $datos->fechavencimiento }}</td>
	</tr>
	<tr>
		<td colspan="4" class="center border"><strong>FIRMA DE LA AUTORIDAD EMISORA DE CONTINGENTES ARANCELARIOS</strong></td>
	</tr>
	<tr>
		<td colspan="4" class="border">
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		</td>
	</tr>
</table>
<br/>
<table width="550">
	<tr>
		<td colspan="4">
			<span class="nota justify"><small><strong>NOTA:</strong> La titularidad de un Certificado no exime del cumplimiento de las regulaciones internas vigentes al momento
					de la importación y no puede ser transferido ni negociado de manera alguna.
				</small>
			</span>
		</td>
	</tr>
</table>