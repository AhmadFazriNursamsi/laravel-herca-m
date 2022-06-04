<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use App\Http\Controllers\HelpersController as Helpers;

use Auth;
use Validator;
class ApisController extends AController
{
    public function apigetdatauser(Request $request){
    	$this->access = Helpers::checkaccess('users', 'view');
        if(!$this->access) return response()->json(['data' => $datas, 'status' => '401'], 200);


    	$users = User::with('divisions', 'roles');
    	if($request->name != null || $request->email != null || $request->divisions != null || $request->username != null || $request->role != null || $request->mobile != null || $request->active != null) {
    		$whereraw = '';

    		if($request->name != null) $whereraw .= " and name like '%$request->name%'";
    		if($request->username != null) $whereraw .= " and username like '%$request->username%'";
    		if($request->email != null) $whereraw .= " and email like '%$request->email%'";
    		if($request->mobile != null) $whereraw .= " and mobile like '%$request->mobile%'";
    		if($request->role != null) $whereraw .= " and id_role = $request->role";
    		if($request->active != null) $whereraw .= " and active = $request->active";
    		if($request->division != null) $whereraw .= " and id_division = $request->division";

    		$whereraw = preg_replace('/ and/', '', $whereraw, 1); // replace first and
    		$users = $users->whereRaw($whereraw)->where('id_role', '!=', 99)
    		->get();    	

    	} else {
    		$users = $users->where('id_role', '!=', 99)->get();
    	}

    	$datas = [];
    	foreach($users as $key => $user){
    		$datas[$key] = [
    			'', $user->name, $user->username, $user->email, $user->divisions, $user->roles->role_name, $user->mobile, $user->active, $user->id
    		];
    	}

    	return response()->json(['data' => $datas, 'status' => '200'], 200);

    	// return response()->json(['data' => $datas, 'status' => '200'], 200);
    }



	///Getdata devision
	public function apigetdatadivi(Request $request){
    	$this->access = Helpers::checkaccess('divisions', 'view');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);


		$users = User::with('divisions', 'roles');
    	$coba = Division::with('roles');
		if($request->name != null || $request->email != null || $request->division != null || $request->username != null || $request->role != null || $request->mobile != null || $request->active != null) {
    		$whereraw = '';

    		if($request->name != null) $whereraw .= " and name like '%$request->name%'";
    		if($request->username != null) $whereraw .= " and username like '%$request->username%'";
    		if($request->email != null) $whereraw .= " and email like '%$request->email%'";
    		if($request->mobile != null) $whereraw .= " and mobile like '%$request->mobile%'";
    		if($request->role != null) $whereraw .= " and id_role = $request->role";
    		if($request->active != null) $whereraw .= " and active = $request->active";
    		if($request->division != null) $whereraw .= " and id_division = $request->division";

    		$whereraw = preg_replace('/ and/', '', $whereraw, 1); // replace first and
    		$users = $users->whereRaw($whereraw)->where('id_role', '!=', 99)
    		->get();    	

    	} else {
    		$users = $users->where('id_role', '!=', 99)->get();
    	}
		$coba2 = Division::all();
    	

    	$datas = [];
    	foreach($coba as $key => $user){
    		$datas[$key] = [
    			'', $user->division_name,$user->id_division,$user->active,
    		];
    	}

		foreach($coba2 as $key => $user){
    		$datas[$key] = [
    			'', $user->division_name,$user->active,
    		];
    	}

    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    public function apigetdivisi(Request $request){
    	$this->access = Helpers::checkaccess('divisi', 'view');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

    	$datas = Division::get();
    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    public function apigetrole(Request $request){
    	$this->access = Helpers::checkaccess('role', 'view');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

    	$datas = Role::where("id_role", "!=", 99)->get();
    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    public function apideleteuserbyid($id, Request $request){

    	$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

    	$datas = User::where('id', $id)->first();
    	
    	$datas->flag_delete = 1;
    	$datas->save();

    	echo 'success';
    }

	public function store(Request $request){

		$this->access = Helpers::checkaccess('divisions', 'create');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

		$validatedData = $request->validateWithBag('post', [
			'division_name' => ['required','unique:division'],
			'active' => ['required'],
		]);
 

        Division::updateOrCreate($validatedData); 
                         
		return response()->json(['success', 'Data Berhasil Disimpan']);
	}
	public function detail($id, Request $request){

		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);
		// $where = array('id' => $request->id);
        // $company  = Company::where($where)->first();
		$datas = Division::all()->first();

		$where = array('id_division' => $request->id_division);
        // $company  = Division::where($where)->first();
      
        return Response()->json($datas);
	
    }

	public function destroy($id_division, Request $request)
    {
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);
        // $company = Division::where('id_division',$request->id_division)->delete();
      
		// $where = array('id_division' => $request->id_division);
		// $company = Division::whereIn('id_division', $request->id_division)
        //         ->delete();
				$coo = Division::all()->delete();
				// $lola = Division::whereIn('division_name', [$request->division_name])->delete();
        return Response()->json($coo);
    }
}
