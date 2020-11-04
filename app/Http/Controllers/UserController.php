<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\UsersFilter;

class UserController extends Controller
{   

    protected $usersFilter;

    public function __construct(UsersFilter $usersFilter) {
        $this->usersFilter = $usersFilter;
    }
    

    public function getUsers(Request $request)
    {
        $data = $this->usersFilter->FilterUsers($request);
    
        if(count($data))
            return response()->json($data,200);

        return response()->json(['message'=>'Not found'],404);
    }

}
