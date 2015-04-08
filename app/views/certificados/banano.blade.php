<style>
	.size14 {
		font-size: 14px;
	}

	.size12 {
		font-size: 12px;
	}

	.size6 {
		font-size: 6px;
	}

	.underline {
		text-decoration: underline;
	}

	.italics {
		font-style: italic;
	}

	.center {
		text-align: center;
	}

	.border {
		border: 1px solid black;
	}

</style>
<table width="500" cellpadding="5" cellspacing="10" style="font-size: 8px; line-height: 7px">
	<tr>
		<td colspan="6" align="left">
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		</td>
	</tr>
	<tr>
		<td colspan="6" align="center">
			<strong><h2>CERTIFICADO DE EXPORTACI&Oacute;N DE BANANO A LA UNI&Oacute;N EUROPEA<sup>*</sup></h2></strong>
			<h3>(Cl&aacute;usula de Estabilización)</h3>
		</td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2" class="border">
			<strong>1. AUTORIDAD EMISORA DEL CERTIFICADO:</strong><br/>
			<p class="underline center">Dirección de Administración del Comercio Exterior Ministerio de Economía</p>
		</td>
		<td rowspan="2">&nbsp;</td>
		<td colspan="2" class="border">
			<strong>2. NUMERO DE CERTIFICADO:</strong><br/>
			<h2 class="underline center">{{ $datos->certificadoid }}</h2>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="border">
			<strong>3. AÑO CALENDARIO PARA USO DE ESTE CERTIFICADO:</strong><br/>
			<p class="underline center">{{ date('Y') }}</p>
		</td>
	</tr>
	<tr>
		<td colspan="6" class="border">
			<strong>4. NOMBRE DEL EXPORTADOR:</strong><br/>
			<p class="underline">{{ $datos->nombre }}</p>
		</td>
	</tr>
	<tr>
		<td colspan="6" class="border">
			<strong>5. N&Uacute;MERO DE IDENTIFICACI&Oacute;N O DE REGISTRO TRIBUTARIO:</strong><br/>
			<p class="underline">{{ $datos->nit }}</p>
		</td>
	</tr>
	<tr>
		<td colspan="4" rowspan="2" class="border">
			<strong>6. PESO NETO (en {{ $datos->unidades }}):</strong><br/>
			<p class="underline">--{{ $datos->volumen }}--</p>			
			<p style="padding-top:10px"><strong>En letras: </strong><span class="underline">{{ $datos->volumenletras }}</span></p>
		</td>
		<td colspan="2" class="border">
			<?php $fraccion = explode(' ', $datos->fraccion); ?>
			<strong>7. CODIGO ARANCELARIO<br/><br /> (Nomenclatura Combinada Europea):</strong><br/>
			<p class="center"><strong>{{ $fraccion[0] }}</strong></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="border">
			<strong>8. PAIS EXPORTADOR:</strong><br/>
			<p class="underline center"><strong>Guatemala</strong></p>
		</td>
	</tr>
	<tr>
		<td colspan="3" class="border">
			<strong>9. SELLO AUTORIDAD EMISORA</strong><br />
			<br/><br/><br/><br/><br/>
			<br/><br/><br/><br/><br/>
		</td>
		<td colspan="3" class="border">
			<strong>10. FIRMA AUTORIZADA</strong><br/>
			<br/><br/><br/><br/><br/>
			<br/><br/><br/><br/><br/>
		</td>
	</tr>
	<tr>
		<td colspan="6" align="center" class="border">
			<strong>11. FECHA DE EMISION</strong><br />
			<p class="underline center"><strong>{{ $datos->fecha }}</strong></p>
		</td>
	</tr>
	<tr>
		<td colspan="6">
			<p class="center italics" style="line-height:7px; font-size: 6px;">* {{ $datos->tratadodescripcion }}</p>
		</td>
	</tr>
</table>