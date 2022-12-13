<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
//      get logged in user_id
        $user_id = Auth::user()->id;
//      get user department
        $department_id = Profile::select('department_id')
            ->where('user_id', $user_id )
            ->first();
        dd($department_id->department_id);

    }
}
