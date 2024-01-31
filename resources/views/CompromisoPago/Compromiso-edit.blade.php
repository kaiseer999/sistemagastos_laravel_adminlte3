@extends('adminlte::page')

@section('title', 'Editar Compromiso de pago')

@section('content_header')
    <h1 class="m-0 text-dark">Editar un compromiso de pago</h1>
@stop

@section('content')
<form action="{{url ('/compromisos_pago/' . $compromiso->id )}}" method="POST">
    @csrf
    {{method_field('PATCH')}}
    
    <div class="card">
        <div class="card-header" style="background-color: #8bdefc; color: #ffffff;">
            <center><b>EDITAR</b></center>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="Fecha_de_compromiso" id="Fecha_de_compromiso" label="Fecha" placeholder="Fecha de compromiso..." label-class="text-lightblue" required value="{{ $compromiso->Fecha_de_compromiso }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <x-adminlte-input name="Concepto_de_pago" id="Concepto_de_pago" label="Concepto" placeholder="Concepto de pago..." label-class="text-lightblue" required value="{{ $compromiso->Concepto_de_pago }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-clipboard"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-12">
                    <x-adminlte-textarea name="Claves_referencias" id="Claves_referencias" label="Referencias" rows=4 label-class="text-warning" igroup-size="sm" placeholder="Ingrese una clave o referencia...">
                        {{ $compromiso->Claves_referencias}}
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