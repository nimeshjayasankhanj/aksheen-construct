<?php

/**
 * Created by PhpStorm.
 * User: nimeshjayasankha
 * Date: 12/25/20
 * Time: 8:09 PM
 */

namespace App\Http\Controllers;

use App\Category;
use App\GRNTemp;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\CategoryRequest;
use App\MasterGrn;
use App\Payment;
use App\Product;
use App\Stock;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class GRNController extends Controller
{
    public function addGrnIndex()
    {

        $suppliers = Supplier::where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        return view('grn.add-grn', ['title' => 'GRN', 'products' => $products, 'suppliers' => $suppliers]);
    }

    public function getProductById(Request $request)
    {

        $productId = $request['productId'];

        $getPrice = Product::find($productId);

        return $getPrice;
    }

    public function getGrnTempTableData(Request $request)
    {

        $viewAllGrnTemps = GRNTemp::where('user_iduser', Auth::user()->iduser)->orderBy('created_at', 'desc')->paginate(10);


        $tableData = '';
        $total = 0;
        if (count($viewAllGrnTemps) != 0) {
            foreach ($viewAllGrnTemps as $viewAllGrnTemp) {

                $total += $viewAllGrnTemp->buying_price * $viewAllGrnTemp->qty;
                $tableData .= "<tr>";
                $tableData .= "<td>" . $viewAllGrnTemp->Product->product_name . "</td>";

                $tableData .= "<td>" . number_format($viewAllGrnTemp->qty, 2) . "</td>";
                $tableData .= "<td style=\"text-align: right\">" . number_format($viewAllGrnTemp->buying_price, 2) . "</td>";
                $tableData .= "<td style=\"text-align: right\">  " . number_format($viewAllGrnTemp->buying_price * $viewAllGrnTemp->qty, 2) . "</td>";
                $tableData .= "<td style='text-align: center'>";
                $tableData .= "<div class='dropdown'>";
                $tableData .= "<button class='btn btn-outline-success btn-sm dropdown-toggle'  type='button' id='dropdownMenuButton'  data-toggle='dropdown' aria-haspopup='true'  aria-expanded='false'>Option  </button>";
                $tableData .= " <div class='dropdown-menu'   aria-labelledby='dropdownMenuButton'>";
                $tableData .= " <a class='dropdown-item' href = '#'  data-toggle= 'modal' data-id ='$viewAllGrnTemp->idgrn_temp'  id = 'editProduct'   data-target = '#editProductModal' >Edit</a >";

                $tableData .= "<a class='dropdown-item' href = '#' data-toggle = 'modal' data-id = '$viewAllGrnTemp->idgrn_temp'  id = 'deleteItem'  >Delete</a >";

                $tableData .= "  </div >";
                $tableData .= " </td>";
                $tableData .= "</tr>";
            }
        } else {
            $tableData = "<tr><td colspan='8' style='text-align: center'><b>Sorry No Results Found.</b></td></tr>";
        }

        return response()->json(['total' => $total, 'tableData' => $tableData]);
    }

    public function saveTempGrn(Request $request)
    {

        $item = $request['item'];
        $qty = $request['qty'];
        $costPrice = $request['costPrice'];

        $rules = \Validator::make($request->all(), [

            'costPrice' => 'required|not_in:0',
            'item' => 'required',
            'qty' => 'required|not_in:0',

        ], [
            'item.required' => 'Product should be provided!',
            'costPrice.required' => 'Cost Price should be provided!',
            'qty.required' => 'Qty should be provided!',
            'qty.not_in' => 'Qty should be  more than 0!',
            'costPrice.not_in' => 'Cost Price should be  more than 0!',

        ]);
        if ($rules->fails()) {
            return response()->json(['errors' => $rules->errors()]);
        }

        $isExist = GRNTemp::where('product_idproduct', '=', $item)->where('user_iduser', '=', Auth::user()->iduser)
            ->where('status', 1)
            ->where('buying_price', '=', $costPrice)
            ->first();


        if ($isExist != null) {
            $isExist->qty += $qty;
            $isExist->save();
        } else {
            $grnTempSave = new GRNTemp();
            $grnTempSave->buying_price = $costPrice;
            $grnTempSave->qty = $qty;
            $grnTempSave->product_idproduct = $item;
            $grnTempSave->user_iduser = Auth::user()->iduser;
            $grnTempSave->status = '1';
            $grnTempSave->save();
        }

        return response()->json(['success' => 'Products added to table successfully']);
    }

    public function getGRNByID(Request $request)
    {

        $grnId = $request['grnId'];

        $getGrnItem = GRNTemp::find($grnId);

        return $getGrnItem;
    }

    public function getVGRNByID(Request $request)
    {

        $grnId = $request['grnId'];
        $getStockDetails = Stock::where('grn_id', $grnId)->orderBy('created_at', 'desc')->where('status', 1)->get();
        $tableData = '';

        foreach ($getStockDetails as $getStockDetail) {
            $tableData .= "<tr>";
            $tableData .= "<td>" . $getStockDetail->Product->product_name . "</td>";

            $tableData .= "<td >" . number_format($getStockDetail->qty, 2). "</td>";
            $tableData .= "<td style=\"text-align: right\">" . number_format($getStockDetail->bp, 2) . "</td>";
            $tableData .= "</tr>";
        }
        return response()->json(['tableData' => $tableData, '$uGrnID' => $grnId]);
    }

    public function getMoreByGrnID(Request $request)
    {

        $masterId = $request['masterId'];

        $getMasterGrn = MasterGRN::find($masterId);

        $tableData = '';
        $tableData .= "<tr>";
        $tableData .= "<td>" . 'Payment Type' . "</td>";
        $tableData .= "<td>" . 'Cash'. "</td>";
        $tableData .= "</tr>";
        $tableData .= "<tr>";
        $tableData .= "<td>" . 'Discount' . "</td>";
        $tableData .= "<td>" . number_format($getMasterGrn->discount, 2) . "</td>";
        $tableData .= "</tr>";

        return response()->json(['tableData' => $tableData]);

    }

    public function updateTempItem(Request $request)
    {

        $uItem = $request['uItem'];
        $uQty = $request['uQty'];
        $uBPrice = $request['uBPrice'];
        $grnId = $request['grnId'];

        $rules = \Validator::make($request->all(), [

            'uBPrice' => 'required|not_in:0',
            'uItem' => 'required',
            'uQty' => 'required|not_in:0',

        ], [
            'uItem.required' => 'Product should be provided!',
            'uBPrice.required' => 'Cost Price should be provided!',
            'uQty.required' => 'Qty should be provided!',
            'uQty.not_in' => 'Qty should be  more than 0!',
            'uBPrice.not_in' => 'Cost Price should be  more than 0!',

        ]);
        if ($rules->fails()) {
            return response()->json(['errors' => $rules->errors()]);
        }


        $grnTempupdate = GRNTemp::find($grnId);
        $grnTempupdate->buying_price = $uBPrice;
        $grnTempupdate->qty = $uQty;
        $grnTempupdate->product_idproduct = $uItem;
        $grnTempupdate->save();


        return response()->json(['success' => 'Products added to table successfully']);
    }


    public function deleteTempItem(Request $request)
    {

        $GrnId = $request['GrnId'];

        $deleteItem = GRNTemp::find($GrnId);
        if ($deleteItem != null) {
            $deleteItem->delete();
        }
        return response()->json(['success' => 'Products deleted successfully']);
    }

    public function store(Request $request)
    {


        $discount = $request['discount'];
        $paymentType = $request['paymentType'];
        $paid = $request['paid'];
        $discountType = $request['discountType'];
        $systemDate = Carbon::now()->format('y/m/d');


        $validator = \Validator::make($request->all(), [

            'paymentType' => 'required',
            'supplier' => 'required',
        ], [
            'paymentType.required' => 'Payment Type should be provided!',
            'supplier.required' => 'Supplier should be provided!',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $totalPrice = 0;
        $grnItemPrices = GRNTemp::where('user_iduser', Auth::user()->iduser)->get();

        foreach ($grnItemPrices as $grnItemPrice) {
            $totalPrice += $grnItemPrice->qty * $grnItemPrice->buying_price;
        }

        if ($discountType == 1) {
            $discount = floatval($totalPrice) * floatval($discount);
            $netTotal = floatval($totalPrice) - floatval($discount);
        } else {

            $netTotal = floatval($totalPrice) - floatval($discount);
        }

        if ($paymentType == 1 || $paymentType == 2) {

            if ($paymentType == 1) {
                if ($paid == 0) {
                    return response()->json(['errors' => ['error' => 'Paid Amount should be provided.']]);
                }
                if ($paid < $netTotal) {
                    return response()->json(['f' => $paid, 'r' => $netTotal, '$discountType' => $discount, 'errors' => ['error' => 'Paid Amount is lower than net total.']]);
                }
                if ($paid > $netTotal) {
                    return response()->json(['r' => ($paid > $netTotal), 'errors' => ['error' => 'Paid Amount is greater than net total.']]);
                }
            }
        }

        $countGrnTemp = GRNTemp::where('user_iduser', Auth::user()->iduser)->get();

        if (count($countGrnTemp) == 0) {
            return response()->json(['errors' => ['error' => 'No items available to save.']]);
        }


        $saveGrn = new MasterGrn();
        $saveGrn->supplier_idsupplier = $request['supplier'];
        $saveGrn->total = $totalPrice;
        $saveGrn->discount = $discount;
        $saveGrn->date = $systemDate;
        $saveGrn->user_iduser = Auth::user()->iduser;


        if ($paymentType == 1) {
            $saveGrn->paid_amount = $paid;
            $saveGrn->due = 0;
        }
        $saveGrn->status = '1';
        $saveGrn->save();


        $grnItemTemps = GRNTemp::where('user_iduser', Auth::user()->iduser)->get();

        foreach ($grnItemTemps as $grnItemTemp) {

            $saveStockTable = new Stock();
            $saveStockTable->base = 1;
            $saveStockTable->grn_id = $saveGrn->idmaster_grn;
            $saveStockTable->product_idproduct = $grnItemTemp->product_idproduct;
            $saveStockTable->qty = $grnItemTemp->qty;
            $saveStockTable->available_qty = $grnItemTemp->qty;
            $saveStockTable->bp = $grnItemTemp->buying_price;
            $saveStockTable->status = 1;
            $saveStockTable->save();

            $grnItemTemp->delete();
        }

        $savePayment = new Payment();
        $savePayment->base = 1;
        $savePayment->id = $saveGrn->idmaster_grn;
        $savePayment->total_amount = $netTotal;
        if ($paymentType == 1) {
            $savePayment->paid_amount = $paid;
        }
        $savePayment->status = '1';
        $savePayment->save();


        return response()->json(['success' => 'GRN saved successfully']);
    }


    public function grnHistoryIndex(Request $request)
    {


        $supplierSearch = $request['supplierSearch'];
        $startDate = $request['startDate'];
        $endDate = $request['endDate'];
        $idType = $request['idType'];
        $id = $request['id'];

        $suppliers = Supplier::where('status', 1)->get();

        $query = MasterGRN::query();

        if ($id) {
            $query = $query->where('idmaster_grn', $id);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $startDate = date('Y-m-d', strtotime($request['startDate']));
            $endDate = date('Y-m-d', strtotime($request['endDate']));

            $query = $query->whereBetween('date', [$startDate, $endDate]);
        }
        if (!empty($supplierSearch)) {

            $query = $query->where('supplier_idsupplier', $supplierSearch);
        }

        $grnHistories = $query->where('status', 1)->latest()->paginate(10);

        $grnHistories->appends(array(
            'startDate' => $request['startDate'],
            'endDate' => $request['endDate'],
            'id' => $request['id'],
        ));
        return view('grn.grn-history', ['title' => 'GRN History', 'grnHistories' => $grnHistories, 'suppliers' => $suppliers]);


    }
}
