<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;

class DataController extends Controller
{
    public function retrieveData($url){

        $client = new \GuzzleHttp\Client();

        $request = $client->get($url);
        $body = $request->getBody();
        $data = json_decode($body,true);
        $collection = collect($data);

        return $collection;

    }

    public function processTodo(){

        $list = $this->retrieveData('https://jsonplaceholder.typicode.com/todos');

        return $list;
    }

    public function processUser(){

        $list = $this->retrieveData('https://jsonplaceholder.typicode.com/users');

        return $list;
    }

    public function processData(){

        $collection = new Collection();
        $userCol = $this->processUser();
        $todoCol = $this->processTodo();

        foreach ($userCol as $user) {
            $values = $todoCol->where('userId',$user['id'])->where('completed','true')->countBy('userId')->first();
            $getUser = $userCol->where('id', $user['id'])->first();
            $getUser['total'] = $values;
        
            $list = $collection->push($getUser);
        }

        return $list;

    }
}
