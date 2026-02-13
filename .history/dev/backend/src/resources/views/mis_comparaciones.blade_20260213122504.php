@extends('layouts.layout')

@section('content')
<div class="mis-comparaciones">
    <h1>Mis Comparaciones</h1>

    @if($comparaciones->isEmpty())
        <p>No has hecho ninguna comparación todavía.</p>
    @else
        <table>
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
                        <td>{{ $c->carA->brand->name }} {{ $cQW->carA->model }}</td>
                        <td>{{ $c->carB->brand->name }} {{ $c->carB->model }}</td>
                        <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
