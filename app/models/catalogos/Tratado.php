<?php

class Tratado extends Eloquent
{
    protected $primaryKey = 'tratadoid';
    protected $guarded    = ['tratadoid'];

    public function pais()
    {
        return $this->hasOne(Pais::class, 'paisid', 'paisid');
    }

    public static function getTratados()
    {
        return self::getTratadosEmpresa(0);
    }

    public static function getTratadosEmpresa($aEmpresaId)
    {
        $query = DB::table('tratados AS t')
            ->select('tratadoid', 'nombre', 'nombrecorto', 'tipo', 'clase', 'icono')
            ->orderBy('tipo')
            ->orderBy('nombrecorto');
        if ($aEmpresaId != 0) {
            
            $query->whereRaw('tratadoid IN (SELECT DISTINCT(cc.tratadoid)
					FROM empresacontingentes ec LEFT JOIN contingentes cc ON cc.contingenteid=ec.contingenteid WHERE ec.empresaid=' . (int) $aEmpresaId . ')');
        }
        
        return $query->get();
    }

    public static function getNombre($aTratadoId)
    {
        return DB::table('tratados')
            ->where('tratadoid', $aTratadoId)
            ->pluck('nombrecorto');
    }

    public static function getEmpresasTratado($aTratadoId, $aContingenteId = 0)
    {
        $query = DB::table('empresacontingentes AS ec')
            ->select('e.razonsocial AS empresa', 'e.nit', 't.nombrecorto AS tratado',
                'p.nombre AS producto', 'e.domiciliocomercial', 'e.telefono',
                DB::raw('DATE_FORMAT(ec.created_at, "%d-%m-%Y %H:%i") AS fechainscripcion'))
            ->leftJoin('empresas AS e', 'e.empresaid', '=', 'ec.empresaid')
            ->leftJoin('contingentes AS c', 'ec.contingenteid', '=', 'c.contingenteid')
            ->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
            ->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid');

        if ($aTratadoId != 0) {
            $query->where('t.tratadoid', $aTratadoId);
        }

        if ($aContingenteId != 0) {
            $query->where('c.contingenteid', $aContingenteId);
        }

        $query->orderBy('t.nombrecorto');
        $query->orderBy('p.nombre');
        $query->orderBy('e.razonsocial');

        return $query->get();
    }

    public static function getTratadosDashboard()
    {
        return DB::table('tratados AS t')
            ->select('tratadoid', 'nombrecorto', 'tipo')
            ->orderBy('tipo')
            ->orderBy('nombrecorto')
            ->get();
    }

    public static function getTratadoDashboard($aTratadoId)
    {
        return DB::table('tratados AS t')
            ->select('nombre', 'tipo')
            ->where('tratadoid', $aTratadoId)
            ->first();
    }

    /*public function getTratadosConContingentes() {

}*/
}
