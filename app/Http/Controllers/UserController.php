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
       
    }

}
