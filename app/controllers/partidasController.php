<?php
class partidasController extends crudController {
	function getPartidas($aProductoId) {
		$html = '';
		$partidas = Productopartida::getPartidas(Crypt::decrypt($aProductoId));
		$html = '<select class="selectpicker form-control cmb-partida" name="partida[]">';
		foreach ($partidas as $partida) {
			$html .= '<option data-subtext="' . $partida->partida . '" value="' . Crypt::encrypt($partida->partidaid) . '">' . $partida->nombre .  '</option>';
		}
		$html .= '</select>';
		return $html;
	}
}