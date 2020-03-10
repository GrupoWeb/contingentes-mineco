<?php

class certificadosempresasController extends BaseController
{

    public function index()
    {
        //retorna valores a la vista
        return View::make('reportes/filtros')
            ->with('titulo', 'Certificados por empresa')
            ->with('contingentes', Contingente::getContingentesCuota())
            ->with('tratados', Tratado::getTratados())
            ->with('filters', ['tratados', 'contingentes', 'periodos', 'formato', 'fechaini', 'fechafin', 'columnas'])
            ->with('todos', ['empresas']);
    }

    public function store()
    {
        //asigna valores ingresado en formulario
        try {
            $periodoid     = Crypt::decrypt(Input::get('cmbPeriodo'));
            $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
            $contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
        } catch (\Exception $e) {
            return View::make('cancerbero::error')
                ->with('mensaje', 'Tratado, período, contingente o empresa inválidos.');
        }

        $fechaini = Components::fechaHumanoAMySql(Input::get('fechaini'), '/') . ' 00:00';
        $fechafin = Components::fechaHumanoAMySql(Input::get('fechafin'), '/') . ' 23:59';
        $formato  = Input::get('formato');
        $campos   = Input::get('campos');

        if (!$campos) {
            $campos = [];
        }

        //consulta en db segun parametros
        $certificados = Movimiento::getCertificadosPorEmpresa($periodoid, $fechaini, $fechafin);
        //consulta en db segun parametro
        $tratado = Tratado::getNombre($tratadoid);
        //consulta en db segun parametros
        $producto = Contingente::getProducto($contingenteid);

        //ingresa datos si formato es pdf
        if ($formato == 'pdf') {
            PDF::SetTitle('Certificados por Empresa');
            PDF::AddPage();
            PDF::setLeftMargin(20);

            //retorna datos a la vista
            $html = View::make('reportes.certificadosporempresapdf', [
                'titulo'       => 'Certificados por empresa',
                'certificados' => $certificados,
                'tratado'      => $tratado,
                'producto'     => $producto,
                'formato'      => $formato,
            ]);

            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output('Consolidado-utilizacion-Contingente.pdf');
        }

        //retorna datos en vista

        return View::make('reportes.certificadosporempresa', [
            'titulo'       => 'Certificados por empresa',
            'certificados' => $certificados,
            'tratado'      => $tratado,
            'producto'     => $producto,
            'formato'      => $formato,
            'campos'       => $campos,
        ]);
    }
}
