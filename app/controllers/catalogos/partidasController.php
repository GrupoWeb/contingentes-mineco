<?php

class partidasController extends crudController {

	function getPartidas($aProductoId) {
		$html = '';
		//consulta en db segun $aProductoId
		$partidas = Contingentepartida::getPartidas(Crypt::decrypt($aProductoId));
		$html     = '<select class="selectpicker form-control cmb-partida" name="partida">';

		//concatena $html con los datos
		foreach ($partidas as $partida) {
			$html .= '<option data-subtext="' . $partida->nombre . '" value="' . $partida->partidaid . '">' . $partida->partida .  '</option>';
		}
		$html .= '</select>';
		
		return $html;
	}
}