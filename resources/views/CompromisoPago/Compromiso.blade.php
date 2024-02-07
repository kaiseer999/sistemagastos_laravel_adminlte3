@extends('adminlte::page')

@section('title', 'Compromisos de pago')

@section('content_header')
<h1 class="m-0 text-dark">Compromisos deff pago</h1>
@stop

@section('content')


<x-adminlte-button label="Open Modal" data-toggle="modal" data-target="#modalPurple" class="bg-purple"/>

<div class="card">
    <div class="card-body">
        @php
        $heads = ['Fecha de Compromiso', 'Concepto de Pago', 'Claves/Referencias', ['label' => 'Acciones', 'no-export'
        => true, 'width' => 10]];

        $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
        ];

        @endphp

        {{-- Obtener datos para la tabla --}}
        @foreach ($compromisosdepago as $compromiso)
        @php
        $btnEdit =
        '<a href="'.url('/compromisos_pago/' . $compromiso->id . '/edit') .
                        '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
            <i class="fa fa-lg fa-fw fa-pen"></i>
        </a>';
        /* $btnDetails =
        '<a href="' .
                        route('compromisos_pago.show', ['compromisos_pago' => $compromiso->id]) .
                        '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Ver">
            <i class="fa fa-lg fa-fw fa-eye"></i>

        </a>';*/
        $btnDelete =
        '<form action="' .url('compromisos_pago/' . $compromiso->id) .'" method="POST">
            ' .
            csrf_field() .
            '
            ' .
            method_field('delete') .
            '
            <button type="submit" onclick="return confirm(\'¿Seguro que desea borrar este compromiso de pago?\')"
                class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>
        </form>';

        $config['data'][] = [$compromiso->Fecha_de_compromiso, '<a
            href="' . route('compromisos_pago.show', ['compromisos_pago' => $compromiso->id]) . '">' .
            $compromiso->Concepto_de_pago . '</a>', $compromiso->Claves_referencias, '<div class="d-flex">' . $btnEdit .
            $btnDelete . '</div>'];
        @endphp
        @endforeach

        <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered
            compressed with-buttons beautify>
            @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                <td>{!! $cell !!}</td>
                @endforeach
            </tr>
            @endforeach
        </x-adminlte-datatable>

    </div>
</div>
@stop
