<?php


namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;



class ProductsController extends Controller
{
    public function index(){

        $products=Product::latest()->paginate(10);
        $brands=Category::where('status',1)->get();

        return view('products.index',['title'=>'Products','products'=>$products,'brands'=>$brands]);

    }

    public function store(ProductStoreRequest $request){

        $save=new Product();
        $save->product_name=strtoupper($request['pName']);
        $save->category_idcategory=$request['category'];
        $save->cost_price=$request['cPrice'];
        $save->selling_price=$request['sPrice'];
        $save->status=1;
        $save->save();

        $tableData=$this->tableView();

        return response()->json(['success'=>'Product saved successfully.','tableData'=>$tableData]);

    }

    public function tableView(){

        $products=Product::latest()->paginate(10);

        $tableData="";
        foreach ($products as $product) {
            $tableData .= "<tr>";


            $tableData .= "<td>" . $product->product_name . "</td>";



                if ($product->status == 1) {

                    $tableData .= "<td>";
                    $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$product->idproduct','product') id='c" . $product->idproduct . "' checked switch='none'/>";
                    $tableData .= "<label for='c" . $product->idproduct . "' data-on-label='On' data-off-label='Off'></label>";
                    $tableData .= "</td>";
                } else {
                    $tableData .= "<td>";
                    $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$product->idproduct','product') id='c" . $product->idproduct . "'  switch='none'/>";
                    $tableData .= "<label for='c" . $product->idproduct . "' data-on-label='On' data-off-label='Off'></label>";
                    $tableData .= "</td>";

            }

              $tableData .= "<td>";
              $tableData .= " <p>";
              $tableData .= "<button type='button' class='btn btn-sm btn-warning  waves-effect waves-light'
          data-toggle='modal' data-id='$product->idproduct' data-name='$product->idproduct' id='uBrandID' data-target='#editBrandModal'>";
              $tableData .= "<i class='fa fa-edit'></i>";
              $tableData .= "</button>";
              $tableData .= " </p>";
              $tableData .= " </td>";


            $tableData .= "</tr>";
        }

        return $tableData;
    }
}
