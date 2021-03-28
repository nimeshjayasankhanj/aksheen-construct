<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{


    public function employeesIndex(Request $request){

        $paginate = 10;
        $keyword = $request['search'];
        $column = '';
        $employees = User::orderBy('created_at', 'desc')
            ->Where(function ($query) use ($column, $keyword) {
                $query->where('first_name' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',2);
            })->orWhere(function ($query) use ($column, $keyword) {
                $query->where('contactNo1' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',2);
            })->orWhere(function ($query) use ($column, $keyword) {
                $query->where('last_name' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',2);
            })->orWhere(function ($query) use ($column, $keyword) {
                $query->where('address' . $column . '', 'LIKE', "%$keyword%")->where('user_role_iduser_role','=',2);
            })

            ->where('user_role_iduser_role','=',2)->orderBy('iduser', 'DESC')->paginate($paginate);
        $employees->appends(array('search' => $request['search'],));

        return view('employees.employees',['title'=>'Employees','employees'=>$employees]);

    }
    public function store(Request $request)
    {

        $employeeName = $request['employeeName'];
        $contactNo1 = $request['contactNo1'];
        $address = $request['address'];

        $validator = \Validator::make($request->all(), [

            'employeeName' => 'required|max:45',
            'contactNo1' => 'required|min:9|max:9',
        ], [
            'employeeName.required' => 'Employee Name should be provided!',
            'employeeName.max' => 'Employee Name must be less than 255 characters long.',
            'contactNo1.required' => 'Contact No should be provided!',
            'contactNo1.min' => 'Contact No should be contain 9 number!',
            'contactNo1.max' => 'Contact No should be contain 9 number!',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $saveEmployee = new User();
        $saveEmployee->first_name = strtoupper($employeeName);
        $saveEmployee->contactNo1 = $contactNo1;
        $saveEmployee->address = $address;
        $saveEmployee->user_role_iduser_role = 2;
        $saveEmployee->status = '1';
        $saveEmployee->save();

        $employees = User::orderBy('created_at', 'desc')->where('user_role_iduser_role',2)->paginate(10);
        $tableData = '';
        foreach ($employees as $employee) {
            $tableData .= "<tr>";
            $tableData .= "<td>" . $employee->first_name . "</td>";
            $tableData .= "<td>" . $employee->contactNo1 . "</td>";

            if ($employee->status == 1) {

                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$employee->iduser','Supplier') id='c" . $employee->iduser . "' checked switch='none'/>";
                $tableData .= "<label for='c" . $employee->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            } else {
                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$employee->iduser','Supplier') id='c" . $employee->iduser . "'  switch='none'/>";
                $tableData .= "<label for='c" . $employee->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            }
            $tableData .= "<td>";
            $tableData .= "<div class='dropdown'>";
            $tableData .= "<button class='btn btn-outline-success btn-sm dropdown-toggle'  type='button' id='dropdownMenuButton'  data-toggle='dropdown' aria-haspopup='true'  aria-expanded='false'>Option  </button>";
            $tableData .= " <div class='dropdown-menu'   aria-labelledby='dropdownMenuButton'>";
            $tableData .= " <a class='dropdown-item' href = '#'  data-toggle= 'modal' data-id ='$employee->iduser'  id = 'updateEmployeeModal'   data-target = '#updateEmployee' >Edit</a >";

            $tableData .= "<a class='dropdown-item' href = '#' data-toggle = 'modal' data-id = '$employee->iduser'  id = 'viewEmployeeModal' data-target = '#viewEmployee' >View</a >";

            $tableData .= "  </div >";
            $tableData .= " </td>";
            $tableData .= "</tr>";
        }
        return response()->json(['success' => 'Employee saved successfully','tableData'=>$tableData]);
    }
    public function viewEmployee(Request $request)
    {

        $employeeId = $request['employeeId'];
        $getEmployee = User::find($employeeId);


        $tableData = "";
        $tableData .= "<tr><td width='40%'>Employee Name</td><td width='60%'> : ".$getEmployee->first_name."</td></tr>";
        $tableData .= "<tr><td width='40%'>Contact No</td><td width='60%'> : <a href='tel:$getEmployee->contactNo1'>".$getEmployee->contactNo1."</a></td></tr>";

        $tableData .= "<tr><td width='40%'>Address</td><td width='60%'> : ".$getEmployee->address."</td></tr>";

        return response()->json(['tableData'=>$tableData]);
    }

    public function getById(Request $request){

        $employeeId=$request['employeeId'];
        $getEmployee=User::find($employeeId);

        return response()->json($getEmployee);
    }

    public function update(Request $request)
    {

        $uEmployeeName = $request['uEmployeeName'];
        $uContactNo1 = $request['uContactNo1'];
        $uAddress = $request['uAddress'];
        $hiddenEmployeeId=$request['hiddenEmployeeId'];

        $validator = \Validator::make($request->all(), [

            'uEmployeeName' => 'required|max:45',
            'uContactNo1' => 'required|min:9|max:9',
        ], [
            'uEmployeeName.required' => 'Employee Name should be provided!',
            'uEmployeeName.max' => 'Employee Name must be less than 255 characters long.',
            'uContactNo1.required' => 'Contact No should be provided!',
            'uContactNo1.min' => 'Contact No should be contain 9 number!',
            'uContactNo1.max' => 'Contact No should be contain 9 number!',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }


        $updateEmployee =User::find($hiddenEmployeeId);
        $updateEmployee->first_name = strtoupper($uEmployeeName);
        $updateEmployee->contactNo1 = $uContactNo1;
        $updateEmployee->address = $uAddress;
        $updateEmployee->update();


        $employees = User::orderBy('created_at', 'desc')->where('user_role_iduser_role',2)->paginate(10);
        $tableData = '';
        foreach ($employees as $employee) {
            $tableData .= "<tr>";
            $tableData .= "<td>" . $employee->first_name . "</td>";
            $tableData .= "<td>" . $employee->contactNo1 . "</td>";

            if ($employee->status == 1) {

                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$employee->iduser','Supplier') id='c" . $employee->iduser . "' checked switch='none'/>";
                $tableData .= "<label for='c" . $employee->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            } else {
                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$employee->iduser','Supplier') id='c" . $employee->iduser . "'  switch='none'/>";
                $tableData .= "<label for='c" . $employee->iduser . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            }
            $tableData .= "<td>";
            $tableData .= "<div class='dropdown'>";
            $tableData .= "<button class='btn btn-outline-success btn-sm dropdown-toggle'  type='button' id='dropdownMenuButton'  data-toggle='dropdown' aria-haspopup='true'  aria-expanded='false'>Option  </button>";
            $tableData .= " <div class='dropdown-menu'   aria-labelledby='dropdownMenuButton'>";
            $tableData .= " <a class='dropdown-item' href = '#'  data-toggle= 'modal' data-id ='$employee->iduser'  id = 'updateEmployeeModal'   data-target = '#updateEmployee' >Edit</a >";

            $tableData .= "<a class='dropdown-item' href = '#' data-toggle = 'modal' data-id = '$employee->iduser'  id = 'viewEmployeeModal' data-target = '#viewEmployee' >View</a >";

            $tableData .= "  </div >";
            $tableData .= " </td>";
            $tableData .= "</tr>";
        }
        return response()->json(['success' => 'Employee updated successfully','tableData'=>$tableData]);
    }

}
