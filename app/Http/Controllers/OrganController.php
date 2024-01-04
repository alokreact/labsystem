<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Organ;
use App\Models\Category;
use Session;

class OrganController extends Controller{

    public $cartCount;
     
    public function index(){
       
        $allorgans = Organ::paginate(12);
        $organs = Organ::take(15)->get();

        $categories = Category::take(15)->get();        
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Organs'],
        ];
        //dd($allorgans);
        return view('Front.Organs.index',compact('allorgans','categories','organs','breadcrumbs'));
    }



    public function getTestbyOrgan($id){

        $testsbyOrgan = Organ::find($id);
        $subtests= $testsbyOrgan->subtest;
        
        $organs = Organ::take(12)->get();
        $categories = Category::take(12)->get();        

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Organ'],
            ['label' => $testsbyOrgan->name],  
        ];
        return view('Front.Organs.testbyorgan',compact('testsbyOrgan','subtests','organs','categories','breadcrumbs'));
    }
}
