<style>
	body {
		font-size: 14px;
	}
  tr.border-bottom td {
  	border-bottom:1px solid black;
	}
	.nota {
		font-style: italic;
	}
</style>
<table width="550">
	<tr>
		<td width="100">
			<img src="/images/logo-menu.png">
		</td>
		<td width="350" align="center">
			<h3>CERTIFICADO DE ADJUDICACI&Oacute;N</h3>
		</td>
		<td width="100" align="center">
			No. <?php echo $datos->certificadoid ?>
		</td>
	</tr>
	<tr class="border-bottom">
		<td colspan="3" align="center">
			<h3><?php echo $datos->tratado ?></h3><br>
		</td>
	</tr>
</table>
<br><br>
<table>
	<tr>
		<td align="right">Guatemala, <?php echo $datos->fecha ?><br><br></td>
	</tr>
	<tr>
		<td>
			<strong>La Dirección de Administración del Comercio Exterior-DACE-</strong> autoriza a:<br><br><strong><?php echo $datos->nombre ?></strong><br>
			Domicilio fiscal: <strong><?php echo $datos->direccion ?></strong><br>
			NIT: <strong><?php echo $datos->nit ?></strong><br>
			Teléfono: <strong><?php echo $datos->telefono ?></strong><br><br>
			a importar un volúmen de:<br>
			<strong><?php echo $datos->volumenletras ?>(<?php echo $datos->volumen ?>) +/- 5% de variación</strong><br><br>
			bajo la fracción arancelaria: <br>
			<strong><?php echo $datos->fraccion ?></strong><br><br>
			<?php echo $datos->tratadodescripcion ?> <br><br>
			País de procedencia: <strong><?php echo $datos->paisprocedencia ?></strong><br><br>
			Vencimiento: <strong><?php echo $datos->fechavencimiento ?></strong><br><br>
			<span class="nota"><small><strong>Nota:</strong> La titularidad de un Certificado no exime del cumplimiento de las regulaciones internas vigentes al momento
					de la importación y no puede ser transferido ni negociado de manera alguna.
				</small>
			</span>
		</td>
	</tr>
</table>