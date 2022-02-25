<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use App\Vacante;
use Illuminate\Http\Request;
use Mail;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function validar_form(Request $request, $id = null)
    {
        $validator = \Validator::make($request->all(), [
            'nombre'            => 'required | string | max:40',
            'apellidos'         => 'required | string | max:40',
            'telefono'          => 'required | numeric | min:10',
            'correo'            => 'required | email  | max:255',
            'oficina'           => 'required | string | max:255',
            'motivo'            => 'required',
            'nivel_academico'   => 'required',
            'turismo'           => 'required',
            'puesto'            => 'required',
            'laboral'           => 'required'
        ]);
        return $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $this->validar_form($request);
        if ($validate->fails()) {
            return response()->json(['success' => false, 'errors' => $validate->errors()]);
        }

        $vacante                  = new Vacante;
        $vacante->nombre          = $request->nombre;
        $vacante->apellidos       = $request->apellidos;
        $vacante->telefono        = $request->telefono;
        $vacante->correo          = $request->correo;
        $vacante->oficina         = $request->oficina;
        $vacante->motivo          = $request->motivo;
        $vacante->nivel_academico = $request->nivel_academico;
        $vacante->turismo         = $request->turismo;
        $vacante->puesto          = $request->puesto;
        $vacante->laboral         = $request->laboral;
        $data['success']          = false;
        if ($vacante->save()) {
            $data['success'] = true;
            Mail::to('reclutamiento@beneficiosvacacionales.mx')->send(new Notification($vacante));
        }

        $data['mensaje'] = 'felicidades has sido calificada para tu primer entrevista';
        $data['mensaje'] = 'Felicidades has sido aceptado para una entrevista, este proximo lunes, martes de 9:00 am  a 2:00 pm, no acudir si no cumples con el perfil solciitado';

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante)
    {
        //
    }
}
