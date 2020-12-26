<?php
/**
 * Created by PhpStorm.
 * User: nimeshjayasankha
 * Date: 12/25/20
 * Time: 8:09 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function index(){

        return view('category.categories',['title'=>'Categories']);
    }

    public function save(CategoryRequest $request){


    }

}
