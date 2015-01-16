<?php

class partidasController extends crudController {
	function getPartidas($aProductoId) {
		$html = '';
		$partidas = Contingentepartida::getPartidas($aProductoId);
		$html = '<select class="selectpicker form-control cmb-partida" name="partida">';
		foreach ($partidas as $partida) {
			$html .= '<option data-subtext="' . $partida->nombre . '" value="' . $partida->partidaid . '">' . $partida->partida .  '</option>';
		}
		$html .= '</select>';
		return $html;
	}
}