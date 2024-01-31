@extends('adminlte::page')

@section('title', 'Crear Compromiso de pago')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar una nuevo compromiso de pago</h1>
@stop

@section('content')
<form action="{{url ('/compromisos_pago')}}" method="POST">

    @csrf
    <div class="card">
        <div class="card-header" style="background-color: #8bdefc; color: #ffffff;"><center><b>CREAR</b></center></div>
        <div class="card-body">
            <div class="row">

                

                <div class="col-md-6">
                    <x-adminlte-input name="Fecha_de_compromiso" id="Fecha_de_compromiso" label="Fecha" placeholder="Fecha de compromiso..." label-class="text-lightblue" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <x-adminlte-input name="Concepto_de_pago" id="Concepto_de_pago" label="Concepto" placeholder="Concepto de pago..." label-class="text-lightblue" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-clipboard"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

            
               


                <div class="col-md-12">
                    <x-adminlte-textarea name="Claves_referencias" id="Claves_referencias" label="Referencias" rows=4 label-class="text-warning"
                    igroup-size="sm" placeholder="Ingrese una clave o referencia...">
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
            
            <x-adminlte-button class="btn-flat" type="submit" label="Crear" theme="success" icon="fas fa-lg fa-save"/>

        </div>
    </div>

</form>
@stop