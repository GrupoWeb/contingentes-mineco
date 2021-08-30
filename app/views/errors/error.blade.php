@extends('template/vacio')

@section('content')
    <div style="padding: 30px;">
        {{ $message }}<br><br>
        <a href="javascript:history.back()">Regresar</a>
    </div>
@stop
