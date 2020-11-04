<?php

namespace App\Filters;
use App\DataProviders\DataProviderX;
use App\DataProviders\DataProviderY;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class UsersFilter{

    private function readDataProviders()
    {   
       return array_merge((new DataProviderX)->getData(),(new DataProviderY)->getData());
    }

    public function FilterUsers(Request $request)
    {
        $data = $this->readDataProviders();

        $parameters = $request->query();
        $dataCollection = collect($data);

        //if provider parameter is passed
        if (isset($parameters['provider']))
            $dataCollection =  $dataCollection->where('provider',$parameters['provider']);
            
        //if statusCode parameter is passed
        if (isset($parameters['statusCode']))
        {
            if($parameters['statusCode']=='authorised')
                $dataCollection = $dataCollection->where('status',100);
            elseif($parameters['statusCode']=='decline')
                $dataCollection = $dataCollection->where('status',200); 
            elseif($parameters['statusCode']=='refunded')
                $dataCollection = $dataCollection->where('status',300);

            //if statusCode parameter is invalid
            else $dataCollection = $dataCollection->where('status',0);
        }

        //if balance range parameters are passed
        if (isset($parameters['balanceMin'])&&isset($parameters['balanceMax']))
            $dataCollection = $dataCollection->whereBetween('balance',[$parameters['balanceMin'],$parameters['balanceMax']]);

        //if currency parameter is passed
        if (isset($parameters['currency']))
            $dataCollection = $dataCollection->where('currency', $parameters['currency']);
        
        return $dataCollection;
        
    }

}