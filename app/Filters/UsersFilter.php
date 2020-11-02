<?php

namespace App\Filters;
use App\DataProviders\DataProviderX;
use App\DataProviders\DataProviderY;
use Illuminate\Http\Request;

class UsersFilter{

    private function readDataProviders()
    {   
       
       return array_merge((new DataProviderX)->getData(),(new DataProviderY)->getData());

    }

    public function FilterUsers(Request $request)
    {
        $data = $this->readDataProviders();
        
    }

}