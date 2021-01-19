<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{

    // user list
    public function listUser(){

        $list = app('App\Http\Controllers\DataController')->processUser();

        return json_encode($list, JSON_PRETTY_PRINT);
    }

    public function searchUserParent($field, $value){

        $list = app('App\Http\Controllers\DataController')->processUser();

        $parent = null;

        $result = $this->filter($parent, $field, $value, $list);

        return json_encode($result, JSON_PRETTY_PRINT);
    }

    public function searchUserChild($parent, $field, $value){

        $list = app('App\Http\Controllers\DataController')->processUser();

        $result = $this->filter($parent, $field, $value, $list);

        return json_encode($result, JSON_PRETTY_PRINT);
    }

    public function filter($parent, $field, $val, $list){

        if($parent == null){
            return $list->where($field, $val);
        }

        $filter = $list->filter(function($value, $key) use($parent, $field, $val){
            if($value[$parent][$field] == $val){
                return true;
            }
        });

        return $filter;

    }

    // todo list
    public function listTodo(Request $request){

        $list = app('App\Http\Controllers\DataController')->processTodo();

        $value = new Collection();

        if ($request->has('userId')) {
            $value = $list->where('userId', $request->userId);
        }

        if ($request->has('id')) {
            $value = $list->where('id', $request->id);
        }

        if ($request->has('title')) {
            $value = $list->where('title', $request->title);
        }

        if ($request->has('completed')) {
            $value = $list->where('completed', $request->completed);
        }

        return json_encode($value, JSON_PRETTY_PRINT);
    }
    

}
