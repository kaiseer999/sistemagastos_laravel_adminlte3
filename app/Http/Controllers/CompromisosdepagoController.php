<?php

namespace App\Http\Controllers;

use App\Models\Compromisosdepago;
use App\Http\Requests\StoreCompromisosdepagoRequest;
use App\Http\Requests\UpdateCompromisosdepagoRequest;
use RealRashid\SweetAlert\Facades\Alert;


class CompromisosdepagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compromisosdepago= Compromisosdepago::all();

        $heads=[

            'Compromiso de pago',
            'Concepto de pago',
            'Claves/referencias/links',
            'Acciones'

        ];

        return view('CompromisoPago.Compromiso', ['compromisosdepago' => $compromisosdepago, 'heads' => $heads]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CompromisoPago.Compromiso-create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompromisosdepagoRequest $request)
    {
        $compromisosdepago = request()->except('_token');

        $compromisosdepago['created_at'] = now();
        $compromisosdepago['updated_at'] = now();
        
        Compromisosdepago::insert($compromisosdepago);

        Alert::success('Success Title', 'Success Message');
        
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compromiso=Compromisosdepago::findOrFail($id);
        return view('CompromisoPago.Compromiso-show',compact('compromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
        $compromiso=Compromisosdepago::findOrFail($id);
        return view('CompromisoPago.Compromiso-edit',compact('compromiso'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompromisosdepagoRequest $request, $id)
    {
        $compromisosdepago = request()->except(['_token', '_method']);

        $compromisosdepago['created_at'] = now();
        $compromisosdepago['updated_at'] = now();

        Compromisosdepago::where('id','=',$id)->update($compromisosdepago);


        $compromiso=Compromisosdepago::findOrFail($id);
        return view('CompromisoPago.Compromiso-edit',compact('compromiso'));
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Compromisosdepago::destroy($id);

        return back();
    }
}
