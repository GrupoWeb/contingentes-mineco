<?php

use Carbon\Carbon;
use GuzzleHttp\Client;

class SatController extends Controller
{
    public function recepcionCertificado($id)
    {
        $c = Certificado::query()
            ->select(
                'certificadoid',
                'paisid',
                'partidaid',
                'nit',
                'nombre',
                'fecha',
                'fechavencimiento',
                'numerocertificado',
                'producto',
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
                    $query->select('tratadoid', 'paisid', 'nombrecorto', 'codigo', 'tipo');
                },
                'movimiento.periodo.contingente.tratado.pais'    => function ($query) {
                    $query->select('paisid', 'codigo');
                },
                'movimiento.periodo.contingente.producto'        => function ($query) {
                    $query->select('productoid', 'unidadmedidaid', 'nombre');
                },
                'movimiento.periodo.contingente.producto.unidad' => function ($query) {
                    $query->select('unidadmedidaid', 'factor_sat', 'unidad_sat');
                },
            ])
            ->findOrFail($id);

        if ($c->movimiento->periodo->contingente->tratado->tipo == 'Exportación') {
            App::abort(400, "Solo se sincronizan importaciones");
        }

        $client  = new Client;
        $url     = Config::get('services.sat.url') . 'recepcionCertificado';
        $headers = [
            'Content-Type' => 'application/json;charset=iso-8859-1',
            'Accept'       => 'application/json',
        ];

        //return Response::json($c);
        $fecha       = Carbon::createFromFormat('Y-m-d H:i:s', $c->fecha);
        $vencimiento = Carbon::createFromFormat('Y-m-d H:i:s', $c->fechavencimiento);
        $nit         = trim(str_replace('-', '', $c->nit));
        $kgs         = $c->volumen * ($c->movimiento->periodo->contingente->producto->unidad->factor_sat);
        $kgsTotal    = $kgs * (1 + $c->movimiento->periodo->contingente->variacion / 100);
        $params      = [
            'usuarioMineco'       => $c->movimiento->creador->nombre,
            'paisOrigen'          => $c->movimiento->periodo->contingente->tratado->pais->codigo,
            'numeroCertificado'   => $c->numerocertificado,
            'acuerdoComercial'    => $c->movimiento->periodo->contingente->tratado->codigo,
            'cuotaContingente'    => $c->partida->codigo_cuota,
            'incisoArancelario'   => str_replace(".", "", $c->partida->partida),
            'fechaEmision'        => $fecha->format('d/m/Y'),
            'fechaExpiracion'     => $vencimiento->format('d/m/Y'),
            'nitImportador'       => $nit,
            'nombreImportador'    => $c->nombre,
            'codigoAdicional'     => $c->partida->codigo_adicional,
            'descripcionProducto' => $c->producto,
            'cantidadVolumen'     => round($kgsTotal, 2),
            'unidadMedida'        => $c->movimiento->periodo->contingente->producto->unidad->unidad_sat,
        ];

        print_r($params);

        $response = $client->post($url, [
            'json'    => $params,
            'headers' => $headers,
            'auth'    => [
                Config::get('services.sat.usuario'),
                Config::get('services.sat.password'),
            ],
            'timeout' => 25,
        ]);
        $html             = (string) $response->getBody();
        $c->sat_respuesta = $html;
        $c->save();

        $code = $response->getStatusCode();
        $json = json_decode($html);

        switch ($json->codigo) {
            case 0:
                $c->sat_at     = Carbon::now();
                $c->sat_error  = null;
                $c->sat_codigo = $json->respuesta[0]->codigo_recepcion;
                $c->save();
                break;
            case 15:
                $this->consultaCertificado($id);
                break;
            default:
                $c->sat_error = $json->mensaje;
                $c->save();
                break;
        }

        return response()->json('ok');
    }

    public function consultaCertificado($id)
    {
        $c = Certificado::findOrFail($id);

        $client  = new Client;
        $url     = Config::get('services.sat.url') . 'consultaCertificado';
        $headers = [
            'Content-Type' => 'application/json;charset=iso-8859-1',
            'Accept'       => 'application/json',
        ];

        $nit = trim(str_replace('-', '', $c->nit));

        $params = [
            'numeroCertificado' => $c->numerocertificado,
            'nit'               => $nit,
        ];

        print_r($params);

        $response = $client->post($url, [
            'body'    => $params,
            'headers' => $headers,
            'auth'    => [
                Config::get('services.sat.usuario'),
                Config::get('services.sat.password'),
            ],
            'timeout' => 25,
        ]);
        $html = (string) $response->getBody();

        $c->sat_respuesta = $html;
        $c->save();

        $code = $response->getStatusCode();
        $json = json_decode($html);

        switch ($json->codigo) {
            case 0:
                if (!$c->sat_at) {
                    $c->sat_at = Carbon::now();
                }
                $c->sat_error = null;
                $c->dua       = $json->respuestaMineco[0]->dua->numeroDua;
                $c->real      = $json->respuestaMineco[0]->dua->cantidadUnidades;
                $c->save();
                break;
            default:
                if (!$c->sat_at) {
                    $c->sat_error = $json->mensaje;
                    $c->save();
                }
                break;
        }

        return response()->json('ok');
    }

    public function anulacionCertificado($id)
    {
        $c = Certificado::query()
            ->select(
                'certificadoid',
                'paisid',
                'partidaid',
                'nit',
                'nombre',
                'fecha',
                'fechavencimiento',
                'numerocertificado',
                'producto',
                'volumen'
            )
            ->with([
                'partida',
                'movimiento'         => function ($query) {
                    $query->select('movimientoid', 'certificadoid', 'periodoid', 'created_by');
                },
                'movimiento.creador' => function ($query) {
                    $query->select('usuarioid', 'nombre');
                },
            ])
            ->findOrFail($id);

        $client  = new Client;
        $url     = Config::get('services.sat.url') . 'anulacionCertificado';
        $headers = [
            'Content-Type' => 'application/json;charset=iso-8859-1',
            'Accept'       => 'application/json',
        ];

        $nit = trim(str_replace('-', '', $c->nit));

        $params = [
            'numeroCertificado' => $c->numerocertificado,
            'nit'               => $nit,
            'usuarioMineco'     => $c->movimiento->creador->nombre,
            'cuotaContingente'  => $c->partida->codigo_cuota,
        ];

        print_r($params);

        $response = $client->post($url, [
            'body'    => $params,
            'headers' => $headers,
            'auth'    => [
                Config::get('services.sat.usuario'),
                Config::get('services.sat.password'),
            ],
            'timeout' => 25,
        ]);
        $html             = (string) $response->getBody();
        $c->sat_respuesta = $html;
        $c->save();

        $code = $response->getStatusCode();
        $json = json_decode($html);

        switch ($json->codigo) {
            case 0:
                $c->sat_error = null;
                $c->save();
            default:
                $c->sat_error = $json->mensaje;
                $c->save();
                break;
        }

        return response()->json('ok');
    }
}
