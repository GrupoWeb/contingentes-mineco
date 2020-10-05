<?php

class periodosasignacionesController extends BaseController
{

    public function index()
    {
        //captura periodoid
        $periodoid = Input::get('periodo');
        //consulta periodo segun $periodoid
        $periodo = Periodo::getPeridoAsignacion(Crypt::decrypt($periodoid));

        //retorna datos a la vista

        return View::make('asignaciones/periodos')
            ->with('periodo', $periodo)
            ->with('periodoid', $periodoid);
    }

    public function store()
    {
        //captura periodoid
        $periodoid = Crypt::decrypt(Input::get('periodo'));

        //guarda datos a las tablas de db
        DB::transaction(function () use ($periodoid) {
            $movimiento                   = new Movimiento;
            $movimiento->tipomovimientoid = DB::table('tiposmovimiento')->where('nombre', 'Cuota')->pluck('tipomovimientoid');
            $movimiento->periodoid        = $periodoid;
            $movimiento->cantidad         = Input::get('txCantidad');
            $movimiento->comentario       = Input::get('txComentario');
            $movimiento->created_by       = Auth::id();
            $movimiento->save();

            $const = Input::file('constancia');
            if ($const) {
                $nombre = date('Ymdhis') . mt_rand(1, 1000) . '.' . strtolower($const->getClientOriginalExtension());
                $res    = $const->move(public_path() . '/archivos/constancias', $nombre);

                $constancia               = new Constancia;
                $constancia->movimientoid = $movimiento->movimientoid;
                $constancia->archivo      = $nombre;
                $constancia->save();
            }
        });

        //muestra mensaje
        Session::flash('message', 'Asignación realizada exitosamente');
        Session::flash('type', 'success');

        //retorna la vista

        return Redirect::to('periodos');
    }
}
