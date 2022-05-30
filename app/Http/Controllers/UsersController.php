<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\HelpersController as Helpers;

class UsersController extends AController
{
    public function index(){

    	$this->access = Helpers::checkaccess('users', 'view');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }

    	$datas = User::get();
    	return view('users.index', array(
            'datas'  => $datas,
        ));
    }


    public function create(){

    	$this->access = Helpers::checkaccess('users', 'add');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }

    	$datas = User::get();
    	return view('users.index', array(
            'datas'  => $datas,
        ));
    }

    public function store(Request $request){

    	$this->access = Helpers::checkaccess('users', 'add');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }

    	$datas = User::get();
    	return redirect('/users'); 
    }

    public function edit($id){

    	$this->access = Helpers::checkaccess('users', 'edit');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }

    	$datas = User::get();
    	return redirect('/users'); 
    }

    public function update($id, Request $request){

    	$this->access = Helpers::checkaccess('users', 'edit');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }

    	$datas = User::get();
    	return redirect('/users'); 
    }

}
