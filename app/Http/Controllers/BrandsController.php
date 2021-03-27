<?php
/**
 * Created by PhpStorm.
 * User: nimeshjayasankha
 * Date: 12/25/20
 * Time: 8:09 PM
 */

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BrandsController extends Controller
{
    public function index(Request $request){

        $paginate = 10;
        $keyword = $request['search'];
        $column = '';
        $brands = Category::orderBy('created_at', 'desc')
            ->Where(function ($query) use ($column, $keyword) {
                $query->where('category_name' . $column . '', 'LIKE', "%$keyword%");
            })
            ->orderBy('idcategory', 'DESC')->paginate($paginate);
        $brands->appends(array('search' => $request['search'],));


        return view('brand.index',['title'=>'Brands','brands'=>$brands]);
    }

    public function save(CategoryRequest $request){

        $category=$request['category'];

        $save=new Category();
        $save->category_name=strtoupper($category);
        $save->status=1;
        $save->save();

        $tableData=$this->tableView();

        return response()->json(['success'=>'Brand successfully saved.','tableData'=>$tableData]);
    }

    public function edit(BrandUpdateRequest $request){

        $uBrand=$request['uBrand'];
        $hiddenID=$request['hiddenID'];

        $update=Category::find($hiddenID);
        $update->category_name=strtoupper($uBrand);
        $update->update();

        $tableData=$this->tableView();

        return response()->json(['success'=>'Brand successfully updated.','tableData'=>$tableData]);
    }

    public function tableView(){

        $brands=Category::latest()->paginate(10);

        $tableData="";
        foreach ($brands as $brand) {
            $tableData .= "<tr>";
            $tableData .= "<td>" . $brand->category_name . "</td>";
            $tableData .= "<td>" . $brand->created_at . "</td>";



                if ($brand->status == 1) {

                    $tableData .= "<td>";
                    $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$brand->idcategory','category') id='c" . $brand->idcategory . "' checked switch='none'/>";
                    $tableData .= "<label for='c" . $brand->idcategory . "' data-on-label='On' data-off-label='Off'></label>";
                    $tableData .= "</td>";
                } else {
                    $tableData .= "<td>";
                    $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$brand->idcategory','category') id='c" . $brand->idcategory . "'  switch='none'/>";
                    $tableData .= "<label for='c" . $brand->idcategory . "' data-on-label='On' data-off-label='Off'></label>";
                    $tableData .= "</td>";

            }

              $tableData .= "<td>";
              $tableData .= " <p>";
              $tableData .= "<button type='button' class='btn btn-sm btn-warning  waves-effect waves-light'
          data-toggle='modal' data-id='$brand->idcategory' data-name='$brand->category_name' id='uBrandID' data-target='#editBrandModal'>";
              $tableData .= "<i class='fa fa-edit'></i>";
              $tableData .= "</button>";
              $tableData .= " </p>";
              $tableData .= " </td>";


            $tableData .= "</tr>";
        }

        return $tableData;
    }



}
