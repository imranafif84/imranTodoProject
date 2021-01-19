<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DataTables;

class TodoController extends Controller
{
    public function index(Request $request){
        
        $list = app('App\Http\Controllers\DataController')->processData();

        if($request->ajax()){
            return DataTables::of($list)
            ->addIndexColumn()
            ->make(true);
        }

        return view('welcome');
    }

}
