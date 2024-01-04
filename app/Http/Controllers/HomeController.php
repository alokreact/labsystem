<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubTest;
use App\Models\Category;
use Session;
use App\Models\Organ;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login(){

        return view('Front.Auth.signin');
    }

    public function landing(){
        return view('Front.Home.index');
    }

    public function prescription(){

        return view('Front.Pages.upload-pres');
    }
    
    public function coupon(){
        return view('Front.Pages.coupon');
    }

  
    public function search(){
        return view('Front.Search.index');
    }    
 
    public function getsearchList(Request $request){
        if ($request->input('query')!== null) {
            //echo "hi";die;
            $subtests = SubTest::where('sub_test_name', 'like', '%' . $request->input('query') . '%')->status()->get();
        } 
        else{
            $subtests =  $subtests = Subtest::where('status', 1)->get();
        }
        return  response()->json($subtests, 200);
    }

    public function searchLabs(Request $request){     
        
        if($request->input('subtest') !== null) {    
            
            $submittedValue = $request->input('subtest');
            $previousValues = Session::get('selectedProducts', []);
    
            if(!empty($submittedValue)) {
                if(!in_array($submittedValue, $previousValues)) {
                    $previousValues[] = $submittedValue;
                }
            }
            $labs = collect();
            $labs = SubTest::with('getLab')->find($previousValues);

            //dd($labs);
            $combinedResults = [];            
            foreach ($labs as $test) {
                foreach ($test->getLab as $lab) {

                    $labName = $lab->lab_name;
                    $labId = $lab->id;
                    $price = $lab->pivot->price; // You might need to adjust this based on your data structure
            
                    if (!array_key_exists($labName, $combinedResults)) {
                        $combinedResults[$labName] = [
                            'id'=>$test->id,
                            'lab_name' => $labName,
                            'lab_id'=>$labId,
                            'total_price' => $price,
                            'city'=>$lab->city,
                            'test_names' => $test->sub_test_name,
                            'image'=>$lab->image,
                            'single_price'=>  $lab->pivot->price                    
                        ];
                    } else {
                        $combinedResults[$labName]['id'] .= ', ' . $test->id;
                        $combinedResults[$labName]['test_names'] .= ', ' . $test->sub_test_name;
                        $combinedResults[$labName]['total_price'] += $price;
                        $combinedResults[$labName]['single_price'].=', '.$lab->pivot->price;
                    }
                }
            }    
            $test=[];
            foreach($combinedResults as $key=> $item){
              //  print_r($item['test_names']);
                $test[] = explode(',' ,$item['test_names']);             
            }
            
            $organs = Organ::take(12)->get();
            $categories = Category::take(12)->get();
            Session::put('selectedProducts', $previousValues);
       
            $responseData =['data' =>$submittedValue,'redirectTo'=>'/list/search-result'];
        
            return response()->json($responseData,200);
            
        }
        else {
            
            abort(404);
        }
    }

    public function searchResultList(Request $request){

        $breadcrumbs = [
            ['label' => 'Home',],
            ['label' => 'Search Result'],
        ];

        $organs = Organ::take(12)->get();
        $categories = Category::take(12)->get();
        return view('Front.Search.index',compact('organs','categories'));
    }


    public function searchLabsForTest(Request $request){
        //dd($request->all());
        $test_id = $request->input('test_id');
        $tests = SubTest::with('getLab')->find($test_id);
        $labs = $tests->pluck('getLab')->flatten();
        $test_names = $tests->pluck('sub_test_name')->flatten();
        $test_ids = $tests->pluck('id')->toArray();
        
        $search_test_data = [];
        foreach($test_names as $index=>$name){
                $search_test_data['name'][]= $name;
                $search_test_data['id'][]= $test_ids[$index];

        }
        //dd($search_test_data);
        $combinedResults =[];

        foreach ($labs as $lab) {
            $labName = $lab->lab_name;
            $labId = $lab->id;
            $price = $lab->pivot->price; // You might need to adjust this based on your data structur

            if (!array_key_exists($labName, $combinedResults)) {
                $combinedResults[$labName] = [
                    'lab_name' => $labName,
                    'lab_id'=>$labId,
                    'total_price' => $price,
                    'city'=>$lab->city,
                    'image'=>$lab->image,
                    'single_price'=>  $lab->pivot->price,
                    'test_names'=>$test_names,
                    'test_ids'=>$test_ids                   
                ];
            } else {
                $combinedResults[$labName]['total_price'] += $price;
                $combinedResults[$labName]['single_price'].=', '.$lab->pivot->price;
            }
        }
        //dd($combinedResults);
        return response()->json(['tests'=>$combinedResults,'searchTerms'=>$search_test_data],Response::HTTP_OK);
    }

    public function removeTests(Request $request){
        // dd($request->input('testArr'));
         $test_id = $request->input('dataArray');    
         $tests = SubTest::with('getLab')->find($test_id);
         
         $test_names = $tests->pluck('sub_test_name')->flatten();
         $test_ids = $tests->pluck('id')->toArray();
        
         $search_test_data = [];
         foreach($test_names as $index=>$name){
                 $search_test_data['name'][]= $name;
                 $search_test_data['id'][]= $test_ids[$index];
 
         }
         //dd($search_test_data);
         $labs = $tests->pluck('getLab')->flatten();
         $combinedResults =[];
 
         foreach ($labs as $lab) {
             $labName = $lab->lab_name;
             $labId = $lab->id;
             $price = $lab->pivot->price; // You might need to adjust this based on your data structur
 
             if (!array_key_exists($labName, $combinedResults)) {
                 $combinedResults[$labName] = [
                     'lab_name' => $labName,
                     'lab_id'=>$labId,
                     'total_price' => $price,
                     'city'=>$lab->city,
                     'image'=>$lab->image,
                     'single_price'=>  $lab->pivot->price,
                     'test_names'=>$test_names,
                     'test_ids'=>$test_ids                    
                 ];
             } else { 
                 $combinedResults[$labName]['total_price'] += $price;
                 $combinedResults[$labName]['single_price'].=', '.$lab->pivot->price;
             }
         }
         //dd($combinedResults);
         return response()->json(['tests'=>$combinedResults,'searchTerms'=>$search_test_data],Response::HTTP_OK);
    }

    public function getMultipleSearchTest(Request $request){   
        $test_id = $request->input('checkBoxValue');
        $tests = SubTest::with('getLab')->find($test_id);
      
        $test_names = $tests->pluck('sub_test_name')->flatten();
        $test_ids = $tests->pluck('id')->toArray();
        //dd($test_names);
       
        $search_test_data = [];
        foreach($test_names as $index=>$name){
                $search_test_data['name'][]= $name;
                $search_test_data['id'][]= $test_ids[$index];

        }
        //dd($search_test_data);
        $labs = $tests->pluck('getLab')->flatten();
        
        $combinedResults =[];

        foreach ($labs as $lab) {
            $labName = $lab->lab_name;
            $labId = $lab->id;
            $price = $lab->pivot->price; // You might need to adjust this based on your data structur

            if (!array_key_exists($labName, $combinedResults)) {
                $combinedResults[$labName] = [
                    'lab_name' => $labName,
                    'lab_id'=>$labId,
                    'total_price' => $price,
                    'city'=>$lab->city,
                    'image'=>$lab->image,
                    'single_price'=>  $lab->pivot->price,
                    'test_names'=>$test_names,
                    'test_ids'=>$test_ids                   
                ];
            } else {
                $combinedResults[$labName]['total_price'] += $price;
                $combinedResults[$labName]['single_price'].=', '.$lab->pivot->price;
            }
        }
        //dd($combinedResults);
        return response()->json(['tests'=>$combinedResults,'searchTerms'=>$search_test_data],Response::HTTP_OK);
    }

    public function removemultipleSearchTest(Request $request){
        // dd($request->input('testArr'));
         $dataArr = $request->input('dataArray');
         $test_id =[];
         foreach($dataArr as $index=>$value){
                 $test_id[] = $dataArr[$index]['id'];
         }
         $tests = SubTest::with('getLab')->find($test_id);
         
         $test_names = $tests->pluck('sub_test_name')->flatten();
         $test_ids = $tests->pluck('id')->toArray();
        
         $search_test_data = [];
         foreach($test_names as $index=>$name){
                 $search_test_data['name'][]= $name;
                 $search_test_data['id'][]= $test_ids[$index];
 
         }
         //dd($search_test_data);
         $labs = $tests->pluck('getLab')->flatten();
         $combinedResults =[];
 
         foreach ($labs as $lab) {
             $labName = $lab->lab_name;
             $labId = $lab->id;
             $price = $lab->pivot->price; // You might need to adjust this based on your data structur
 
             if (!array_key_exists($labName, $combinedResults)) {
                 $combinedResults[$labName] = [
                     'lab_name' => $labName,
                     'lab_id'=>$labId,
                     'total_price' => $price,
                     'city'=>$lab->city,
                     'image'=>$lab->image,
                     'single_price'=>  $lab->pivot->price,
                     'test_names'=>$test_names,
                     'test_ids'=>$test_ids                    
                 ];
             } else {
                 $combinedResults[$labName]['total_price'] += $price;
                 $combinedResults[$labName]['single_price'].=', '.$lab->pivot->price;
             }
        }
         //dd($combinedResults);
         return response()->json(['tests'=>$combinedResults,'searchTerms'=>$search_test_data],Response::HTTP_OK);
    }
}
