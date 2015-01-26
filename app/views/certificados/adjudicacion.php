<style>
	body {
		font-size: 14px;
	}
  tr.border-bottom td {
  	border-bottom:1px solid black;
	}
	tr td {
		padding-top: 20px;
		padding-bottom: 8px;
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
	<tr>
		<td colspan="3" align="center">
			<h3><?php echo $datos->tratado ?></h3><br>
		</td>
	</tr>
	<tr class="border-bottom">
		<td colspan="3" align="center">
			<h4>La Dirección de Administración del Comercio Exterior<br>-DACE-</h4><br>
		</td>
	</tr>
</table>
<br><br>

<table>
	<tr>
		<td colspan="2">
			<strong>AUTORIZA A:</strong> <?php echo $datos->nombre ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>DOMICILIO FISCAL:</strong> <?php echo $datos->direccion ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong>NIT:</strong> <?php echo $datos->nit ?>
		</td>
		<td>
			<strong>TELEFONO:</strong> <?php echo $datos->telefono ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>VOLUMEN A IMPORTAR:</strong> <?php echo $datos->volumenletras ?>(<?php echo $datos->volumen ?>) +/- 5% de variación<br><br>
			FRACCION ARANCELARIA: <strong><?php echo $datos->fraccion ?></strong><br><br>
			<?php echo $datos->tratadodescripcion ?> <br><br>
			PAIS DE PROCEDENCIA: <strong><?php echo $datos->paisprocedencia ?></strong><br><br>
		</td>
	</tr>
	<tr>
		<td>FECHA DE EMISION: <?php echo $datos->fecha ?></td><td>VENCIMIENTO: <strong><?php echo $datos->fechavencimiento ?></strong></td>
	</tr>
	<tr>
	  <td colspan="2">
	  	<span class="nota"><small><strong>NOTA:</strong> La titularidad de un Certificado no exime del cumplimiento de las regulaciones internas vigentes al momento
					de la importación y no puede ser transferido ni negociado de manera alguna.
				</small>
			</span>
		</td>
	</tr>
</table>