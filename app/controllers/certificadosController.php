<?php
class certificadosController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setTitulo('Certificados');
		Crud::setTabla('certificados');
		Crud::setTablaId('certificadoid');

		Crud::setLeftJoin('authusuarios AS u', 'u.usuarioid', '=', 'certificados.usuarioid'); 

		Crud::setCampo(array('nombre'=>'No.','campo'=>'certificados.certificadoid'));
		Crud::setCampo(array('nombre'=>'Fecha','campo'=>'certificados.fecha','tipo'=>'date'));
		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'certificados.nombre'));
		Crud::setCampo(array('nombre'=>'Volúmen','campo'=>'certificados.volumen'));
		
	 	Crud::setBotonExtra(array('url'=>'c/{id}','icon'=>'fa fa-file-pdf-o','titulo'=>'Generar','class'=>'primary'));
	 	Crud::setBotonExtra(array('url'=>'certificados/anular/{id}','icon'=>'fa fa-minus-square-o','titulo'=>'Anular','class'=>'danger'));

		Crud::setPermisos(array('edit'=>false,'add'=>false,'delete'=>false));
	}

	public function generarPDF($id) {
		$elId  = Crypt::decrypt($id);
		$datos = Certificado::getCertificado($elId);

		if($datos->anulado == 1){
			return "El certificado ha sido anulado";
		}

		PDF::SetTitle('Certificado');
		PDF::AddPage();

		$certificate = $datos->certificado;
		PDF::SetSignature($certificate, $certificate, 'cservice');

		$html = View::make('certificados.adjudicacion')
			->with('datos', $datos);
		//return $html;

		PDF::writeHTML($html, true, false, true, false, '');

		//PDF::Image(public_path() . '/images/firma1.jpg', 105, 220, 70, 35, 'JPG','','N');
		PDF::Image('@' . $datos->firma, 105,220,70,35,'JPG','','N');

		PDF::line(80,245, 200,245);
		PDF::writeHTMLCell(0,0, 80, 250, 
			$datos->nombrecompleto . '<br>' . $datos->puesto, 0, 1, 0, true,'C', true);
		PDF::write2DBarcode(url('c/' . $id),'QRCODE,M',10,233,25,25);

		PDF::Output('certificado.pdf');
	}

	public function anular($id){
		$certificadoid = Crypt::decrypt($id);


	}
}