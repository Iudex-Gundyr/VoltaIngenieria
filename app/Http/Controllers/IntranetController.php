<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
class IntranetController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function Intranet(){
        return view('Intranet/Intranet');
    }

}
