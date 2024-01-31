@extends('adminlte::page')

@section('title', 'Gastos clubes')

@section('content_header')
    <h1 class="m-0 text-dark">Gastos clubes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        @php
        $heads = [
            'Fecha de Compromiso',
            'Concepto de Pago',
            'Claves de Referencias',
            'Fecha de Pago',
            'Valor de Pago',
            'Soporte de Pago',
            'Observación',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
        ];

      
        
      
        @endphp

        @foreach($gastosClubes as $gasto)
        @php
        $btnEdit = '<a href="' . url('gastosclubes/' . $gasto->id . '/edit') . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
        $btnDelete =   '<form action="' .
                        url('gastosclubes/' . $gasto->id) .
                        '" method="POST">
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


        @endphp
        @endforeach
        
        <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark"  striped hoverable
        bordered compressed with-buttons beautify>
            @foreach($gastosClubes as $gasto)
                <tr>
                    <td>{{ optional($gasto->compromiso_pago)->Fecha_de_Compromiso }}</td>
                    <td>
                        <a href="{{ route('gastosclubes.show', ['gastosclube' => $gasto->id]) }}">
                            {{ optional($gasto->compromiso_pago)->Concepto_de_pago }}
                        </a>
                    </td>
                    <td>{{ optional($gasto->compromiso_pago)->Claves_referencias }}</td>
                    <td>{{ $gasto->fecha_de_pago }}</td>
                    <td>{{ $gasto->valor_de_pago }}</td>
                    <td>
                        @foreach (json_decode($gasto->soporte_de_pago, true) as $archivo)
                            @php
                                $filePath = 'storage/' . '/' . $archivo;
                                $fileExtension = pathinfo($archivo, PATHINFO_EXTENSION);
                            @endphp
                            <a href="#" onclick="mostrarArchivo('{{ asset($filePath) }}', '{{ $fileExtension }}')">Ver Soporte</a>
                        @endforeach
                    </td>
                    <td>{{ $gasto->observacion }}</td>

                    <td>
                        <div class="btn-group">
                            {!! $btnEdit !!}
                            {!! $btnDelete !!}
                        </div>
                    </td>
                    
                </tr>
            @endforeach
        </x-adminlte-datatable>
        
        <script>
            function mostrarArchivo(archivoUrl, extension) {
                var nuevaVentana = window.open('', '_blank', 'width=800,height=600');
                
                if (extension.toLowerCase() === 'pdf') {
                    nuevaVentana.document.write('<embed src="' + archivoUrl + '" type="application/pdf" style="width:100%; height:100%;">');
                } else {
                    nuevaVentana.document.write('<img src="' + archivoUrl + '" style="max-width: 100%; max-height: 100%;">');
                }
            }
        </script>
        

    </div>
   </div>
@stop