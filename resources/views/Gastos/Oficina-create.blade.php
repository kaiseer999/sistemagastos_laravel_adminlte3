@extends('adminlte::page')

@section('plugins.KrajeeFileinput', true)
@section('plugins.Select2', true)
@section('title', 'Crear gastos oficina')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar un nuevo gasto de la oficina</h1>
@stop

@section('content')

<form action="{{url ('/gastosoficina')}}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="card">
        <div class="card-header" style="background-color: #56017d; color: #ffffff;"><center><b>CREAR</b></center></div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <x-adminlte-select2 name="mes" id="mes" placeholder="Seleccione un mes..."
                                        label="Mes de pago" label-class="text-lightblue" required>
                        @foreach ($nombresMeses as $index => $nombreMes)
                            <option value="{{ $index + 1 }}">{{ $nombreMes }}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>

                <div class="col-md-6">
                    <x-adminlte-select2 name="compromiso_pago_id" id="compromiso_pago_id" placeholder="Selecione un compromiso..."
                    label="Compromiso de pago" label-class="text-lightblue" required>
                        @foreach ($datosCompromisosdePago as $compromiso)
                            <option value="{{$compromiso->id}}">{{ $compromiso->Concepto_de_pago}}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>

                <div class="col-md-6">
                    @php
                    $config = ['format' => 'YYYY-MM-DD'];
                    @endphp
                    <x-adminlte-input-date name="fecha_de_pago" id="fecha_de_pago" :config="$config" placeholder="Elige una fecha de pago..."
                        label="Fecha de pago" label-class="text-lightblue" required>
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="outline-primary" icon="fas fa-calendar"
                                title="Eliga una fecha de pago"/>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>

                

                <div class="col-md-6">
                    <x-adminlte-input name="valor_de_pago" id="valor_de_pago" label="Valor" placeholder="Escribe el valor de pago..." label-class="text-lightblue" required>
                        <x-slot name="prependSlot" type="number"  required>
                            <div class="input-group-text">
                                <i class="fas fa-money-bill"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

            
                <div class="col-md-12">
                    <x-adminlte-input-file-krajee id="soporte_de_pago" name="soporte_de_pago[]"
                    igroup-size="sm" data-msg-placeholder="Suba sus archivos..."
                    data-show-cancel="false" data-show-close="false" multiple required/>
                </div>


                <div class="col-md-12">
                    <x-adminlte-textarea name="observacion" label="Observaciones" rows=4 label-class="text-lightblue"
                    igroup-size="sm" placeholder="Ingrese una observación..." required>
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
            
            <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>

        </div>
    </div>

</form>
@stop