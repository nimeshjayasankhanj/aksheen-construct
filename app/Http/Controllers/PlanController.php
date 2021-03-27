<?php


namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Plan;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;



class PlanController extends Controller
{
    public function plansIndex(Request $request)
    {

        $keyword = $request['search'];
        $column = '';
        $plans = Plan::orderBy('created_at', 'desc')
            ->Where(function ($query) use ($column, $keyword) {
                $query->where('plan_name' . $column . '', 'LIKE', "%$keyword%");
            })
            ->orderBy('idplan', 'DESC')->paginate(10);
        $plans->appends(array('search' => $request['search'],));

        return view('plans.plans', ['title' => 'Plans', 'plans' => $plans]);
    }

    public function store(Request $request)
    {

        $rules = \Validator::make($request->all(), [

            'planImage' => 'required',
            'planName' => 'required',

        ], [

            'planImage.required' => 'Image should be provided!',
            'planName.required' => 'Plan Name should be provided!',

        ]);

        if ($rules->fails()) {
            return response()->json(['errors' => $rules->errors()]);
        }

        $save = new Plan();
        $save->plan_name = strtoupper($request['planName']);
        $save->status = 1;
        $save->save();

        $file = $request->file('planImage');

        if ($file != null) {

            $name = $save->idplan .  time()  . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/plans/'), $name);
            $save->images = $name;
            $save->save();
        }

        $tableData = $this->tableView();

        return response()->json(['success' => 'Plan saved successfully.', 'tableData' => $tableData]);
    }

    public function tableView()
    {

        $plans = plan::latest()->paginate(10);

        $tableData = "";
        foreach ($plans as $plan) {
            $tableData .= "<tr>";
            $tableData .= "<td>";
            $tableData .= "<img src='assets/images/plans/$plan->images' alt='user-image'
            style='border: 1px solid black'
            class='thumb-md rounded-circle mr-2'/>";
            $tableData .= "</td>";
            $tableData .= "<td>" . $plan->plan_name . "</td>";

            if ($plan->status == 1) {

                $tableData .= "<td>";

                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$plan->idplan','product') id='c" . $plan->idplan . "' checked switch='none'/>";
                $tableData .= "<label for='c" . $plan->idplan . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            } else {
                $tableData .= "<td>";
                $tableData .= "<input type='checkbox' class='btn  btn-sm btn-danger' onchange=adMethod('$plan->idplan','product') id='c" . $plan->idplan . "'  switch='none'/>";
                $tableData .= "<label for='c" . $plan->idplan . "' data-on-label='On' data-off-label='Off'></label>";
                $tableData .= "</td>";
            }

            $tableData .= "<td>";
            $tableData .= " <p>";
            $tableData .= "<button type='button' class='btn btn-sm btn-warning  waves-effect waves-light'
          data-toggle='modal' data-id='$plan->idplan' data-name='$plan->idplan' id='uBrandID' data-target='#editBrandModal'>";
            $tableData .= "<i class='fa fa-edit'></i>";
            $tableData .= "</button>";
            $tableData .= " </p>";
            $tableData .= " </td>";


            $tableData .= "</tr>";
        }

        return $tableData;
    }

    public function update(Request $request)
    {

        $rules = \Validator::make($request->all(), [


            'uPlanName' => 'required',

        ], [


            'uPlanName.required' => 'Plan Name should be provided!',

        ]);

        if ($rules->fails()) {
            return response()->json(['errors' => $rules->errors()]);
        }

        $update = Plan::find($request['hiddenPID']);
        $update->plan_name = strtoupper($request['uPlanName']);
        $update->save();

        $file = $request->file('uPlanImage');

        if ($file != null) {

            $name = $request['hiddenPID'] . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/plas/'), $name);
            $updatePlan = Plan::find($request['hiddenPID']);
            if ($updatePlan->image != null || $updatePlan->image != "") {
                $path_old = public_path('assets/images/plas/') . $updatePlan->plan_name;

                if (file_exists($path_old)) {
                    unlink($path_old);
                }
            }
            $updatePlan->plan_name = $name;
            $updatePlan->update();
        }

        $tableData = $this->tableView();

        return response()->json(['success' => 'Plan updateed successfully.', 'tableData' => $tableData]);
    }
}
