<?php 
namespace App\DataProviders;

use App\DataProviders\ProviderInterface;

class DataProviderY implements ProviderInterface{

    public function getData()
    {
        $data =json_decode(file_get_contents(storage_path() . "/app/json/DataProviderY.json"), true)['users'];

        $result = array_map(function($datum) {
            return array(
                'balance'=>$datum['balance'],
                'currency'=>$datum['currency'],
                'email'=>$datum['email'],
                'status'=>$datum['status'],
                'created_at'=>$datum['created_at'],
                'id'=>$datum['id'],
                'provider'=>'DataProviderY',
            );
        }, $data);

        return $result;
    }
}