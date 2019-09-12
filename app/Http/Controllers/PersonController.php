<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::get();
        echo json_encode($persons);
    }

    public function show($person_id)
    {
        $person = Person::find($person_id);
        echo json_encode($person);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cellphone' => 'required|numeric',
            'reason' => ["required", "regex:(Compra|Venta|Alquiler)"]
        ]);
        
        $person = new Person();
        $person->name = $request->input('name');
        $person->email = $request->input('email');
        $person->cellphone = $request->input('cellphone');
        $person->reason = $request->input('reason');
        $person->comment = $request->input('comment');
        $person->save();

        echo json_encode($person);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $person_id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cellphone' => 'required|numeric',
            'reason' => ["required", "regex:(Compra|Venta|Alquiler)"]
        ]);
        $person = Person::find($person_id);
   
        $person->name = $request->input('name');
        $person->email = $request->input('email');
        $person->cellphone = $request->input('cellphone');
        $person->reason = $request->input('reason');
        $person->comment = $request->input('comment');
     
        $person->save();
        echo json_encode($person);

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($person_id)
    {
        $person = Person::find($person_id);
        $person->delete();
    }
}
