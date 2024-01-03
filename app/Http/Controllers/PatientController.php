<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Patient;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class PatientController extends Controller
{

    public function index(){
        return view('Front.Profile.Patient');
    }

    public function store(Request $request){

        $data = $request->all();
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->age = $request->input('age');
        $patient->gender = $request->input('gender');
        $patient->user_id = Auth::user()->id;
        $patient->save();

        $new_patient = $patient->toArray();
     
        $res_patient = ['id'=>$new_patient['id'],'name'=> $new_patient['name'], 'age'=> $new_patient['age'],
                         'gender'=>$new_patient['gender'] == '1'?'Male':'female'];
 
        return response()->json(['message'=>'Patient Saved Successfully','patient'=>$res_patient],Response::HTTP_CREATED);
    }

    public function delete(Request $request){
        //dd($request->all());
        $patient = Patient::find($request->id);
        $patient->delete();
        return response()->json(['status'=>'success']);
    }

    public function edit($id){
        $patient = Patient::find($id);
        return view('Front.Profile.components.patient_edit',compact('patient'));
    }

    public function update(Request $request, $id){
        $patient = Patient::find($id);
        $patient->name = $request->input('name');
        $patient->age = $request->input('age');
        $patient->gender = $request->input('gender');
        $patient->save();
        return redirect()->route('patient');        
    }

}
