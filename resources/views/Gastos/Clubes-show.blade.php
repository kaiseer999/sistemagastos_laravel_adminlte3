@extends('adminlte::page')

@section('plugins.KrajeeFileinput', true)
@section('plugins.Select2', true)
@section('title', 'Ver gastos clubes')

@section('content_header')
    <h1 class="m-0 text-dark">Ver un gasto de los clubes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #f70254; color: #ffffff;">
        <center><b>VER</b></center>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                <x-adminlte-select2 name="mes" id="mes" placeholder="Seleccione un mes..." label="Mes de pago"
                    label-class="text-lightblue" readonly>
                    @foreach ($nombresMeses as $index => $nombreMes)
                    <option value="{{ $index + 1 }}" {{ $index + 1==$gastosClubes->mes ? 'selected' : '' }}>
                        {{ $nombreMes }}
                    </option>
                    @endforeach
                </x-adminlte-select2>
            </div>



            <div class="col-md-6">
                <x-adminlte-select2 name="compromiso_pago_id" id="compromiso_pago_id"
                    placeholder="Selecione un compromiso..." label="Compromiso de pago" label-class="text-lightblue"
                    readonly>
                    @foreach ($datosCompromisosdePago as $compromiso)
                    <option value="{{$compromiso->id}}">{{ $compromiso->Concepto_de_pago}}</option>
                    @endforeach
                </x-adminlte-select2>
            </div>

            <div class="col-md-6">
                @php
                $config = ['format' => 'YYYY-MM-DD'];
                @endphp
                <x-adminlte-input-date name="fecha_de_pago" id="fecha_de_pago" :config="$config"
                    placeholder="Elige una fecha de pago..." label="Fecha de pago" label-class="text-lightblue"
                    value="{{ $gastosClubes->fecha_de_pago }}" readonly>
                    <x-slot name="appendSlot">
                        <x-adminlte-button theme="outline-primary" icon="fas fa-calendar" readonly
                            title="Elige una fecha de pago" />
                    </x-slot>
                </x-adminlte-input-date>
            </div>




            <div class="col-md-6">
                <x-adminlte-input name="valor_de_pago" id="valor_de_pago" label="Valor"
                    placeholder="Escribe el valor de pago..." label-class="text-lightblue" readonly
                    value="{{ $gastosClubes->valor_de_pago }}">
                    <x-slot name="prependSlot" type="number">
                        <div class="input-group-text">
                            <i class="fas fa-money-bill"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>



            <div class="col-md-12">
                @foreach (json_decode($gastosClubes->soporte_de_pago, true) as $archivo)
                @php
                $filePath = 'storage/' . '/' . $archivo;
                $fileExtension = pathinfo($archivo, PATHINFO_EXTENSION);
                @endphp

                @if ($fileExtension == 'pdf')
                <center>
                    <embed src="{{ asset($filePath) }}" type="application/pdf" width="250" height="250">

                </center>
                <br>
                <a href="{{ asset($filePath) }}" target="_blank">Ver PDF</a>
                @else
                <center>
                    <img src="{{ asset($filePath) }}" alt="Imagen" height="250" height="250"
                        onclick="mostrarImagen('{{ asset($filePath) }}')">

                </center>
                <br>
                <a href="{{ asset($filePath) }}" download>Descargar Imagen</a>
                @endif
                @endforeach
            </div>




            <div class="col-md-12">
                <x-adminlte-textarea name="observacion" label="Observaciones" rows=4 label-class="text-lightblue"
                    igroup-size="sm" placeholder="Ingrese una observación..." readonly>
                    {{ $gastosClubes->observacion }}
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-light">
                            <i class="fas fa-file-alt fa-lg"></i>
                        </div>
                    </x-slot>
                </x-adminlte-textarea>
            </div>



        </div>




    </div>
    <div class="card-footer text-muted">
        <x-adminlte-button class="btn-flat" label="Volver atrás" theme="primary" icon="fas fa-lg fa-reply"
            onclick="window.history.back();" />
    </div>
</div>
@stop

