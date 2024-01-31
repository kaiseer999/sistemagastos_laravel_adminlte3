@extends('adminlte::page')

@section('title', 'Sistema de manejo de gastos')

@section('content_header')
    <h1 class="m-0 text-dark">Bienvenida</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p><strong>¡Importante! 🚀</strong> No olvides registrar tus pagos antes de visualizarlos. Puedes hacerlo fácilmente en la pestaña que encontrarás a tu izquierda.</p>
                    <p class="mb-0"><a href="{{url('gastospersonales')}}">Ver gastos personales</a></p>
                    <p class="mb-0"><a href="{{url('gastosoficina')}}">Ver gastos personales</a></p>
                    <p class="mb-0"><a href="{{url('gastosclubes')}}">Ver gastos personales</a></p>

                </div>
            </div>
        </div>
    </div>
@stop
