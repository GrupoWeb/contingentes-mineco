<?php
class certificadosController extends BaseController {

	public function generarPDF() {
		PDF::SetTitle('Certificado');
		PDF::AddPage();
		PDF::Write(0, 'Detalle del certificado');

		//$certificate = 'file://' . app_path() . '/cert/tcpdf.crt';
		$certificate = DB::table('authusuarios')->where('usuarioid',Auth::id())->pluck('certificado');
		PDF::Image(public_path() . '/images/logo-menu.png', 176, 4, 30, 10, 'PNG');
		PDF::SetSignature($certificate, $certificate, 'cservice');
		PDF::Output('certificado.pdf');
	}

}