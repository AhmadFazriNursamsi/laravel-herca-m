<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use App\Http\Controllers\HelpersController as Helpers;

class ApisController extends AController
{
    public function apigetdatauser(Request $request){
    	$this->access = Helpers::checkaccess('users', 'view');
        if(!$this->access) return response()->json(['data' => $datas, 'status' => '401'], 200);


    	$users = User::with('divisions', 'roles');
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

    	$datas = [];
    	foreach($users as $key => $user){
    		$datas[$key] = [
    			'', $user->name, $user->username, $user->email, $user->divisions->division_name, $user->roles->role_name, $user->mobile, $user->active, $user->id
    		];
    	}

    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }
	public function apigetdatadivision(Request $request){
    	$this->access = Helpers::checkaccess('divisions', 'view');
        if(!$this->access) return response()->json(['data' => $datas, 'status' => '401'], 200);


    	$users = Division::with('users', 'roles');
    	if($request->division_name != null || $request->active != null) {
    		$whereraw = '';

    		if($request->division_name != null) $whereraw .= " and division_name like '%$request->division_name%'";
   
    		if($request->active != null) $whereraw .= " and active = $request->active";
    

    		$whereraw = preg_replace('/ and/', '', $whereraw, 1); // replace first and
    		$users = $users->whereRaw($whereraw)->where('id_division', '!=', 99)
    		->get();    	

    	} else {
    		$users = $users->where('id_division', '!=', 99)->get();
    	}

    	$datas = [];
    	foreach($users as $key => $user){
    		$datas[$key] = [
    			'', $user->division_name, $user->active
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
}
