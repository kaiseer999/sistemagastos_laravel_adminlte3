@extends('adminlte::page')

@section('plugins.KrajeeFileinput', true)
@section('plugins.Select2', true)
@section('title', 'Editar gastos clubes')

@section('content_header')
    <h1 class="m-0 text-dark">Editar un gasto de los clubes</h1>
@stop

@section('content')
<form action="{{ url('/gastosclubes/' . $gastosClubes->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}

    <div class="card">
        <div class="card-header" style="background-color: #f70254; color: #ffffff;">
            <center><b>EDITAR</b></center>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-select2 name="mes" id="mes" placeholder="Seleccione un mes..." label="Mes de pago"
                        label-class="text-lightblue">
                        @foreach ($nombresMeses as $index => $nombreMes)
                            <option value="{{ $index + 1 }}" {{ $index + 1 == $gastosClubes->mes ? 'selected' : '' }}>
                                {{ $nombreMes }}
                            </option>
                        @endforeach
                    </x-adminlte-select2>
                </div>

                <div class="col-md-6">
                    <x-adminlte-select2 name="compromiso_pago_id" id="compromiso_pago_id"
                        placeholder="Seleccione un compromiso..." label="Compromiso de pago" label-class="text-lightblue">
                        @foreach ($datosCompromisosdePago as $compromiso)
                            <option value="{{ $compromiso->id }}" {{ $compromiso->id == $gastosClubes->compromiso_pago_id ? 'selected' : '' }}>
                                {{ $compromiso->Concepto_de_pago }}
                            </option>
                        @endforeach
                    </x-adminlte-select2>
                </div>

                <div class="col-md-6">
                    @php
                        $config = ['format' => 'YYYY-MM-DD'];
                    @endphp
                    <x-adminlte-input-date name="fecha_de_pago" id="fecha_de_pago" :config="$config"
                        placeholder="Elige una fecha de pago..." label="Fecha de pago" label-class="text-lightblue"
                        value="{{ $gastosClubes->fecha_de_pago }}">
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="outline-primary" icon="fas fa-calendar" title="Elige una fecha de pago" />
                        </x-slot>
                    </x-adminlte-input-date>
                </div>

                <div class="col-md-6">
                    <x-adminlte-input name="valor_de_pago" id="valor_de_pago" label="Valor"
                        placeholder="Escribe el valor de pago..." label-class="text-lightblue"
                        value="{{ $gastosClubes->valor_de_pago }}">
                        <x-slot name="prependSlot" type="number">
                            <div class="input-group-text">
                                <i class="fas fa-money-bill"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-12">
                    <label><b>¡Importante!</b> Si deseas modificar o editar algún archivo, ¡adelante! Sube archivos solo si es 
                        necesario para la actualización. La previsualización no está disponible en esta vista. 🌟</label>
                    <x-adminlte-input-file-krajee id="soporte_de_pago" name="soporte_de_pago[]"
                    igroup-size="sm" data-msg-placeholder="Suba sus archivos..."
                    data-show-cancel="false" data-show-close="false" multiple />
                </div>

                <div class="col-md-12">
                    <x-adminlte-textarea name="observacion" label="Observaciones" rows=4 label-class="text-lightblue"
                        igroup-size="sm" placeholder="Ingrese una observación...">
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
            <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="primary" icon="fas fa-lg fa-save"/>
        </div>
    </div>
</form>
@stop