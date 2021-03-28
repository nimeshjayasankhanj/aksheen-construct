<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{


    public function customersIndex(Request $request){

        $paginate = 10;
        $keyword = $request['search'];
        $column = '';
        $customers = User::orderBy('created_at', 'desc')
            ->Where(function ($query) use ($column, $keyword) {
                $query->where('first_name' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',3);
            })->orWhere(function ($query) use ($column, $keyword) {
                $query->where('contactNo1' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',3);
            })->orWhere(function ($query) use ($column, $keyword) {
                $query->where('last_name' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',3);
            })->orWhere(function ($query) use ($column, $keyword) {
                $query->where('address' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',3);
            })

            ->where('user_role_iduser_role','=',3)->orderBy('iduser', 'DESC')->paginate($paginate);
        $customers->appends(array('search' => $request['search'],));

        return view('customer.customer',['title'=>'Customers','customers'=>$customers]);

    }
    public function store(Request $request)
    {

        $customerName = $request['customerName'];
        $contactNo1 = $request['contactNo1'];
        $address = $request['address'];

        $validator = \Validator::make($request->all(), [

            'customerName' => 'required|max:45',
            'contactNo1' => 'required|min:9|max:9',
        ], [
            'customerName.required' => 'Customer Name should be provided!',
            'customerName.max' => 'Customer Name must be less than 255 characters long.',
            'contactNo1.required' => 'Contact No should be provided!',
            'contactNo1.min' => 'Contact No should be contain 9 number!',
            'contactNo1.max' => 'Contact No should be contain 9 number!',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $saveCustomer = new User();
        $saveCustomer->first_name = strtoupper($customerName);
        $saveCustomer->contactNo1 = $contactNo1;
        $saveCustomer->address = $address;
        $saveCustomer->user_role_iduser_role = 3;
        $saveCustomer->status = '1';
        $saveCustomer->save();

        $customers = User::orderBy('created_at', 'desc')->where('user_role_iduser_role',3)->paginate(10);
        $tableData = '';
        foreach ($customers as $customer) {
            $tableData .= "<tr>";
            $tableData .= "<td>" . $customer->first_name . "</td>";
            $tableData .= "<td>" . $customer->contactNo1 . "</td>";

            if ($customer->status == 1) {

                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$customer->iduser','Supplier') id='c" . $customer->iduser . "' checked switch='none'/>";
                $tableData .= "<label for='c" . $customer->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            } else {
                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$customer->iduser','Supplier') id='c" . $customer->iduser . "'  switch='none'/>";
                $tableData .= "<label for='c" . $customer->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            }
            $tableData .= "<td>";
            $tableData .= "<div class='dropdown'>";
            $tableData .= "<button class='btn btn-outline-success btn-sm dropdown-toggle'  type='button' id='dropdownMenuButton'  data-toggle='dropdown' aria-haspopup='true'  aria-expanded='false'>Option  </button>";
            $tableData .= " <div class='dropdown-menu'   aria-labelledby='dropdownMenuButton'>";
            $tableData .= " <a class='dropdown-item' href = '#'  data-toggle= 'modal' data-id ='$customer->iduser'  id = 'updateCustomerModal'   data-target = '#updateCustomer' >Edit</a >";

            $tableData .= "<a class='dropdown-item' href = '#' data-toggle = 'modal' data-id = '$customer->iduser'  id = 'viewCustomerModal' data-target = '#viewCustomer' >View</a >";

            $tableData .= "  </div >";
            $tableData .= " </td>";
            $tableData .= "</tr>";
        }
        return response()->json(['success' => 'Customer saved successfully','tableData'=>$tableData]);
    }
    public function viewCustomer(Request $request)
    {

        $CustomerId = $request['CustomerId'];
        $getCustomer = User::find($CustomerId);


        $tableData = "";
        $tableData .= "<tr><td width='40%'>Customer Name</td><td width='60%'> : ".$getCustomer->first_name."</td></tr>";
        $tableData .= "<tr><td width='40%'>Contact No</td><td width='60%'> : <a href='tel:$getCustomer->contactNo1'>".$getCustomer->contactNo1."</a></td></tr>";

        $tableData .= "<tr><td width='40%'>Address</td><td width='60%'> : ".$getCustomer->address."</td></tr>";

        return response()->json(['tableData'=>$tableData]);
    }

    public function getById(Request $request){

        $customerId=$request['customerId'];
        $getCUstomer=User::find($customerId);

        return response()->json($getCUstomer);
    }

    public function update(Request $request)
    {

        $uCustomerName = $request['uCustomerName'];
        $uContactNo1 = $request['uContactNo1'];
        $uEmail = $request['uEmail'];
        $uAddress = $request['uAddress'];
        $hiddenCustomerId=$request['hiddenCustomerId'];

        $validator = \Validator::make($request->all(), [

            'uCustomerName' => 'required|max:45',
            'uContactNo1' => 'required|min:9|max:9',
        ], [
            'uCustomerName.required' => 'supplier Name should be provided!',
            'uCustomerName.max' => 'supplier Name must be less than 255 characters long.',
            'uContactNo1.required' => 'Contact No should be provided!',
            'uContactNo1.min' => 'Contact No should be contain 9 number!',
            'uContactNo1.max' => 'Contact No should be contain 9 number!',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }


        $updateUser =User::find($hiddenCustomerId);
        $updateUser->first_name = strtoupper($uCustomerName);
        $updateUser->contactNo1 = $uContactNo1;
        $updateUser->address = $uAddress;
        $updateUser->update();

        $customers = User::orderBy('created_at', 'desc')->where('user_role_iduser_role',3)->paginate(10);
        $tableData = '';
        foreach ($customers as $customer) {
            $tableData .= "<tr>";
            $tableData .= "<td>" . $customer->first_name . "</td>";
            $tableData .= "<td>" . $customer->contactNo1 . "</td>";

            if ($customer->status == 1) {

                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$customer->iduser','Supplier') id='c" . $customer->iduser . "' checked switch='none'/>";
                $tableData .= "<label for='c" . $customer->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            } else {
                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$customer->iduser','Supplier') id='c" . $customer->iduser . "'  switch='none'/>";
                $tableData .= "<label for='c" . $customer->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            }
            $tableData .= "<td>";
            $tableData .= "<div class='dropdown'>";
            $tableData .= "<button class='btn btn-outline-success btn-sm dropdown-toggle'  type='button' id='dropdownMenuButton'  data-toggle='dropdown' aria-haspopup='true'  aria-expanded='false'>Option  </button>";
            $tableData .= " <div class='dropdown-menu'   aria-labelledby='dropdownMenuButton'>";
            $tableData .= " <a class='dropdown-item' href = '#'  data-toggle= 'modal' data-id ='$customer->iduser'  id = 'updateCustomerModal'   data-target = '#updateCustomer' >Edit</a >";

            $tableData .= "<a class='dropdown-item' href = '#' data-toggle = 'modal' data-id = '$customer->iduser'  id = 'viewCustomerModal' data-target = '#viewCustomer' >View</a >";

            $tableData .= "  </div >";
            $tableData .= " </td>";
            $tableData .= "</tr>";
        }
        return response()->json(['success' => 'Customer updated successfully','tableData'=>$tableData]);
    }

}
