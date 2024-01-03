<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{


    public function index(){
        return view('Front.Profile.address');
    }
    public function store(Request $request){
                    
        $data = $request->all();
        $address = new Address;
        $address->user_id = \Auth::user()->id;
        $address->name = $request->input('name');
        $address->email = $request->input('email');
        $address->address1 = $request->input('address1');
        $address->phone = $request->input('phone');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->zip = $request->input('zip');
        $address->save();
        
        return response()->json(['message'=>'Address Saved Succesfully'], Response::HTTP_CREATED);
    }

    public function edit($id){
        $address = Address::find($id);
        //dd($address);
        return view('Front-end.Profile.components.address_edit', compact('address'));   
    }

    public function update(Request $request, $id){
            //dd($request->all());
            $address = Address::find($id);
                $address->user_id = \Auth::user()->id;
                $address->name = $request->input('name');
                $address->email = $request->input('email');
                $address->address1 = $request->input('address1');
                $address->phone = $request->input('phone');
                $address->state = $request->input('state');
                $address->city = $request->input('city');
                $address->zip = $request->input('zip');
                $address->save();

            //return view('Front-end.Profile.components.address_edit')->with('message','Updated Successfully');

            return redirect()->route('address');
    }

    public function create(){
        return view('Front-end.Profile.components.address_form'); 
    }

    public function destroy($id){
        
        $address = Address::find($id);
        $address->delete();

        return response()->json(['message'=>'Address Deleted Successfully'],Response::HTTP_OK);

    }
}
