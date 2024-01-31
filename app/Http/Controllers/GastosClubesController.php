<?php

namespace App\Http\Controllers;

use App\Models\GastosClubes;
use App\Http\Requests\StoreGastosClubesRequest;
use App\Http\Requests\UpdateGastosClubesRequest;
use App\Models\Compromisosdepago;
use App\Models\GastosOficina;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use  RealRashid\SweetAlert\Facades\Alert;

class GastosClubesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $gastosClubes = GastosClubes::with(['compromiso_pago:id,Fecha_de_Compromiso,Concepto_de_pago,Claves_referencias'])->get();
            $heads = [
                'Compromiso de Pago',
                'Concepto de Pago',
                'Claves/Referencias',
                'Fecha de Pago',
                'Valor de Pago',
                'Soporte de Pago',
                'Observación',
                'Acciones'
            ];
    
            return view('Gastos.Clubes', compact('gastosClubes', 'heads'));
        } catch (\Exception $e) {
            // Manejo de errores
            return view('error_page');
        }
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datosCompromisosdePago= Compromisosdepago::all();
        $nombresMeses = array_map(function($mes) {
            return ucfirst(Carbon::create(0, $mes, 1)->translatedFormat('F'));
        }, range(1, 12));
        
    

        return view('Gastos.Clubes-create', compact('datosCompromisosdePago', 'nombresMeses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGastosClubesRequest $request)
    {
        try {
            $request->validate([
                'mes' => 'required|string',
                'compromiso_pago_id' => 'required|exists:compromisosdepagos,id',
                'fecha_de_pago' => 'required|date',
                'valor_de_pago' => 'required|numeric',
                'soporte_de_pago.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'observacion' => 'required|string|max:256',
            ]);
    
            $user_id = Auth::id();
            $path = $user_id;
    
            $nombresArchivos = [];
            foreach ($request->file('soporte_de_pago') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $nombresArchivos[] = $file->storeAs($path, $fileName, 'public');
            }
    
            GastosClubes::create([
                'mes' => $request->input('mes'),
                'compromiso_pago_id' => $request->input('compromiso_pago_id'),
                'user_id' => $user_id,
                'fecha_de_pago' => $request->input('fecha_de_pago'),
                'valor_de_pago' => $request->input('valor_de_pago'),
                'soporte_de_pago' => json_encode($nombresArchivos),
                'observacion' => $request->input('observacion'),
            ]);
    
            Alert::success('Registro Exitoso', 'El registro se ha creado correctamente.')->persistent(true, false);
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Ha ocurrido un error al procesar el registro.')->persistent(true, false);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nombresMeses = array_map(function($mes) {
            return ucfirst(Carbon::create(0, $mes, 1)->translatedFormat('F'));
        }, range(1, 12));
    
        $gastosClubes = GastosClubes::findOrFail($id);
    
        $datosCompromisosdePago = CompromisosDePago::all();
    
        return view('Gastos.Clubes-show', [
            'gastosClubes' => $gastosClubes,
            'nombresMeses' => $nombresMeses,
            'datosCompromisosdePago' => $datosCompromisosdePago,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nombresMeses = array_map(function($mes) {
            return ucfirst(Carbon::create(0, $mes, 1)->translatedFormat('F'));
        }, range(1, 12));
    
        $gastosClubes = GastosClubes::findOrFail($id);
    
        $datosCompromisosdePago = CompromisosDePago::all();
    
        return view('Gastos.Clubes-edit', [
            'gastosClubes' => $gastosClubes,
            'nombresMeses' => $nombresMeses,
            'datosCompromisosdePago' => $datosCompromisosdePago,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGastosClubesRequest $request, $id)
    {
        try {
            $gastosClubes = GastosClubes::find($id);
    
            if (!$gastosClubes) {
                // Manejar la situación en la que el GastoPersonal no se encuentra
                return back()->with('error', 'El registro no se ha encontrado.');
            }
    
            $request->validate([
                'mes' => 'required|string',
                'compromiso_pago_id' => 'required|exists:compromisosdepagos,id',
                'fecha_de_pago' => 'required|date',
                'valor_de_pago' => 'required|numeric',
                'soporte_de_pago.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'observacion' => 'required|string|max:256',
            ]);
    
            // Actualizar campos no relacionados con archivos
            $gastosClubes->update([
                'mes' => $request->input('mes'),
                'compromiso_pago_id' => $request->input('compromiso_pago_id'),
                'fecha_de_pago' => $request->input('fecha_de_pago'),
                'valor_de_pago' => $request->input('valor_de_pago'),
                'observacion' => $request->input('observacion'),
            ]);
    
            // Actualizar archivos solo si se proporcionan nuevos
            if ($request->hasFile('soporte_de_pago')) {
                $user_id = Auth::id();
                $path = $user_id;
    
                $nombresArchivos = [];
                foreach ($request->file('soporte_de_pago') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $nombresArchivos[] = $file->storeAs($path, $fileName, 'public');
                }
    
                // Eliminar archivos antiguos
                foreach (json_decode($gastosClubes->soporte_de_pago, true) as $archivo) {
                    $rutaArchivo = $path . '/' . $archivo;
                    if (file_exists($rutaArchivo)) {
                        unlink($rutaArchivo);
                    }
                }
                
    
                $gastosClubes->update(['soporte_de_pago' => json_encode($nombresArchivos)]);
            }
    
            Alert::success('Actualización Exitosa', 'El registro se ha actualizado correctamente.')->persistent(true, false);
            return back();
        } catch (\Exception $e) {
            // Manejar el error de manera adecuada
            Alert::error('Error', 'Ha ocurrido un error al procesar la actualización.')->persistent(true, false);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gasto = GastosClubes::find($id);
    
        if ($gasto) {
            $rutaDirectorio = $gasto->user_id;
    
            foreach (json_decode($gasto->soporte_de_pago, true) as $archivo) {
                $rutaArchivo = $rutaDirectorio . '/' . $archivo;
    
                $rutaCompleta = storage_path('app/public/' . $rutaArchivo);
    
                if (file_exists($rutaCompleta)) {
                    unlink($rutaCompleta);
                }
            }
    
            $gasto->delete();
        }
    
        return back();
    }
}
