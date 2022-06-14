<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EmployeeController extends Controller
{

    // Gets all grades from the database
    public function getAllEmployees()
    {
        return response()->json(['employees' => User::all()], 200);
    }


    // return a single grade from the database
    public function getEmployee($employeeId)
    {
        $employee = Employee::find($employeeId);
        if (!$employeeId) return response()->json(['error' => 'Employee not found'], 404);

        return response()->json(['employee' => $employee], 200);
    }

    public function postEmployee(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' =>'required',
            'gender'=>'required',
            'age'=>'required',
            'branch'=>'required',
            'phone'=>'required'

        ]);



        $Employee = new Employee();

        $Employee->name = $request->input('name');
        $Employee->email = $request->input('email');
        $Employee->gender = $request->input('gender');
        $Employee->age = $request->input('age');
        $Employee->branch = $request->input('branch');
        $Employee->phone = $request->input('phone');


        $Employee->save();

        return  redirect()->back(); //response()->json(['Employee' => $Employee], 201);
    }

    public function putEmployee(Request $request, $employeeId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' =>'required',
            'gender'=>'required',
            'age'=>'required',
            'branch'=>'required',
            'phone'=>'required'
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors(),], 404);

        $employee = Employee::find($employeeId);
        if (!$employee) return response()->json(['error' => 'Employee not found'], 404);

        $employee->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'branch' => $request->input('branch'),
            'phone' => $request->input('phone'),

        ]);

        return response()->json(['employee' => $employee], 201);
    }

    public function deleteEmployee($employeeId)
    {
        $employee = Employee::find($employeeId);
        if (!$employeeId) return response()->json(['error' => 'Employee not found'], 404);

        $employee->delete();
       return response()->json(['message' => 'Employee deleted Successfully'], 201);
    }

    public function showEmployees(){

    $employees = Employee::all();
    $branches = Branch::all();
    return Inertia::render("Employee",['employees'=> $employees, 'branches'=>$branches]);

    }
}
