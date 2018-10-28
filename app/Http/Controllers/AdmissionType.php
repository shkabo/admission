<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdmissionTypes;
use Illuminate\Support\Facades\Validator;

class AdmissionType extends Controller
{

    public function __construct()
    {
        $this->middleware('role:administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = AdmissionTypes::paginate(15);
        return view('admissiontype.list', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admissiontype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|unique:admission_types',
            'description' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admission.type.create')->withErrors($validator)->withInput();
        }
        if (!AdmissionTypes::create($request->all(['name', 'description','status']))) {
            return redirect()->route('admission.type.create')->with('error', 'An error occurred while saving new entry. Please try again');
        }
        return redirect()->route('admission.type.show.list')->with('success', 'Admission type: ' . $request->input('name') . ' successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = AdmissionTypes::find($id);
        //dd($type);
        return view('admissiontype.edit', ['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = AdmissionTypes::find($id);
        if (is_null($type)) {
            abort(404);
        }
        $fillable = $type->getFillable();
        foreach($fillable as $field) {
            $type->$field = $request->input($field);
        }
        $type->save();
        return redirect()->route('admission.type.show.edit', $id)->with('success', 'Admission type successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
