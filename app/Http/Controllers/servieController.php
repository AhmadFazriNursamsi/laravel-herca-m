<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use App\Http\Controllers\HelpersController as Helpers;
use Auth;
use Illuminate\Support\Facades\Validator;

class servieController extends Controller
{

    public function index(Request $request){
        $db = Division::all();
        return view("division.index", compact('db'), ['title' => 'Division']);
    }

	public function apiStore(Request $request){
		$this->access = Helpers::checkaccess('divisions', 'create');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

        
		// $validatedData = $request->validateWithBag('post', [
		// 	'division_name' => ['required','unique:division'],
		// 	'active' => ['required'],
		// ]);
 

        // Division::updateOrCreate($validatedData); 
        
		// return response()->json(['success', 'Data Berhasil Disimpan']);
        $validator = Validator::make($request->all(), [
            'division_name' => 'required|unique:division',
            'active' => 'required'
        ]);
         
        if ($validator->fails()) {
         return response()->json(['data' => ['fails'], 'status' => '401'], 200);
        }
     
         $tatas = new Division();
         $tatas->division_name = $request->division_name;
         $tatas->active = $request->active;
         if($tatas->save())
             return response()->json(['data' => ['success'], 'status' => '200'], 200);
         else 
             return response()->json(['data' => ['false'], 'status' => '200'], 200);
         }
    
	public function apiDetail($id, Request $request){

        $datas  = Division::where('id_division', $id)->first();
      
        return response()->json(['data' => $datas, 'status' => '200'], 200);

	
    }
	public function apiEdit($id, Request $request)
    {
		// dd($request->division_name,$request->active);
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$datas  = Division::where('id_division', $id)->first();
        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    }

	public function apiUpdate($id, Request $request)
    {
		// dd($request->request);
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

        $datas_banding = Division::where('division_name', $request->division_name)->first();

        // if($datas_banding->id_division != $id) {
        // }
        $datas = Division::where('id_division', $id)->first();
        $datas->division_name = $request->division_name;
        $datas->active = $request->active;

        if($datas->save())
            return response()->json(['data' => ['success'], 'status' => '200'], 200);
        else 
            return response()->json(['data' => ['fails'], 'status' => '200'], 200);
	
	}
	public function apiDestroy($id, Request $request)
    {
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$datas = Division::where('id_division',$id)->first();
        $datas->flag_delete = 1;

        if(isset($request->undeleted)) $datas->flag_delete = 0;
        $datas->save();
    
        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    }
}
