@extends('layouts.layout')

@section('content')
<div class="mis-comparaciones">
    <h1>Mis Comparaciones</h1>

    @if($comparaciones->isEmpty())
        <p class="mensaje-vacio">No has hecho ninguna comparación todavía.</p>
    @else
        <div class="tabla-wrapper">
            <table class="comparaciones-table">
                <thead>
                    <tr>
                        <th>Coche A</th>
                        <th>Coche B</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comparaciones as $c)
                        <tr>
                            <td>{{ $c->carA->brand->name }} {{ $c->carA->model }}</td>
                            <td>{{ $c->carB->brand->name }} {{ $c->carB->model }}</td>
                            <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection