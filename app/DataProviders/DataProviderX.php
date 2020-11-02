<?php 
namespace App\DataProviders;

class DataProviderX implements ProviderInterface{

    public function getData()
    {
        $data =json_decode(file_get_contents(storage_path() . "/app/json/DataProviderX.json"), true)['users'];

        $result = array_map(function($datum) {
            //convert status code to 100 , 200 or 300   
            switch ($datum['statusCode']) {
                case '1':{
                    $datum['statusCode']=100;
                    break;
                }

                case '2':{
                    $datum['statusCode']=200;
                    break;
                }

                case '3':{
                    $datum['statusCode']=300;
                    break;
                }
                
                default:
                    break;
            }


            //convert created_at date form to dd/mm/yyyy;
            $datum['registerationDate']=str_replace('-','/',$datum['registerationDate']);

            return array(
                'balance'=>$datum['parentAmount'],
                'currency'=>$datum['Currency'],
                'email'=>$datum['parentEmail'],
                'status'=>$datum['statusCode'],
                'created_at'=>$datum['registerationDate'],
                'id'=>$datum['parentIdentification'],
                'provider'=>'DataProviderX',
            );
        }, $data);

        return $result;
    }
}