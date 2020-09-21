<?php

use Carbon\Carbon;
use GuzzleHttp\Client;

class SapController extends Controller
{
    public function enviarCertificado($id)
    {
        $c = Certificado::query()
            ->select(
                'certificadoid', 'paisid', 'nit', 'nombre', 'fecha',
                'fechavencimiento', 'numerocertificado', 'producto',
                'volumen'
            )
            ->with([
                'pais',
                'partida',
                'movimiento'                                     => function ($query) {
                    $query->select('movimientoid', 'certificadoid', 'periodoid', 'created_by');
                },
                'movimiento.creador'                             => function ($query) {
                    $query->select('usuarioid', 'nombre');
                },
                'movimiento.periodo'                             => function ($query) {
                    $query->select('periodoid', 'contingenteid');
                },
                'movimiento.periodo.contingente'                 => function ($query) {
                    $query->select('contingenteid', 'tratadoid', 'productoid');
                },
                'movimiento.periodo.contingente.tratado'         => function ($query) {
                    $query->select('tratadoid', 'paisid', 'nombrecorto', 'codigo');
                },
                'movimiento.periodo.contingente.tratado.pais'    => function ($query) {
                    $query->select('paisid', 'codigo');
                },
                'movimiento.periodo.contingente.producto'        => function ($query) {
                    $query->select('productoid', 'unidadmedidaid', 'nombre');
                },
                'movimiento.periodo.contingente.producto.unidad' => function ($query) {
                    $query->select('unidadmedidaid', 'nombrecorto');
                },
            ])
            ->findOrFail($id);

        $client  = new Client;
        $url     = Config::get('services.sat.url') . 'recepcionCertificado';
        $headers = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        //return Response::json($c);
        $fecha       = Carbon::createFromFormat('Y-m-d H:i:s', $c->fecha);
        $vencimiento = Carbon::createFromFormat('Y-m-d H:i:s', $c->fechavencimiento);
        $nit         = trim(str_replace('-', '', $c->nit));

        $params = [
            'usuarioMineco'       => $c->movimiento->creador->nombre,
            'paisOrigen'          => $c->movimiento->periodo->contingente->tratado->pais->codigo,
            'numeroCertificado'   => $c->numerocertificado,
            'acuerdoComercial'    => $c->movimiento->periodo->contingente->tratado->codigo,
            'cuotaContingente'    => $c->partida->codigo_cuota,
            'incisoArancelario'   => $c->partida->partida,
            'fechaEmision'        => $fecha->format('d/m/Y'),
            'fechaExpiracion'     => $vencimiento->format('d/m/Y'),
            'nitImportador'       => $nit,
            'nombreImportador'    => $c->nombre,
            'codigoAdicional'     => $c->partida->codigo_adicional,
            'descripcionProducto' => $c->producto,
            'cantidadVolumen'     => $c->volumen,
            'unidadMedida'        => $c->movimiento->periodo->contingente->producto->unidad->nombrecorto,
        ];

        print_r($params);

        //try {
        $response = $client->post($url, [
            'json'    => $params,
            'headers' => $headers,
            'auth'    => [
                Config::get('services.sat.usuario'),
                Config::get('services.sat.password'),
            ],
            'timeout' => 25,
        ]);
        $html = (string) $response->getBody();
        $code = $response->getStatusCode();
        dd($code, $html);
        // } catch (RequestException $e) {
        //     if ($e->hasResponse()) {
        //         abort(501, Psr7\str($e->getResponse()));
        //     }
        //     abort(501, 'Error al buscar multas');
        // }
    }
}
