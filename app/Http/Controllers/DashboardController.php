<?php
/**
 * Created by PhpStorm.
 * User: Nimesh VGS
 * Date: 3/4/2020
 * Time: 2:53 PM
 */


namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){




        return view('index',['title'=>'dashboard']);

    }

}
