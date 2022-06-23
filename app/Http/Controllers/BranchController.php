<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class BranchController extends Controller
{
    public function store(Request $request){



        $request->validate([
                     'name' => 'required',
            'location' => 'required',
        ]);

        $branch = Branch::create([
            'name' => $request->name,
            'location' => $request->location
        ]);

        return redirect()->back();
    }

    public function getAllBranches()
    {
        return response()->json(['branches' => Branch::all()], 200);
    }


    // return a single grade from the database
    public function getBranch($branchId)
    {
        $branch = Branch::find($branchId);
        if (!$branch) return response()->json(['error' => 'Branch not found'], 404);

        return response()->json(['branch' => $branch], 200);
    }



    public function putBranch(Request $request, $branchId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors(),], 404);

        $branch = Branch::find($branchId);
        if (!$branch) return response()->message(['error' => 'Branch not found'], 404);

        $branch->update([
            'name' => $request->input('name'),
            'location' => $request->input('location')
        ]);

        return redirect()->back();
    }

    public function deleteBranch($branchId)
    {
        $branch = Branch::find($branchId);
        if (!$branch) return response()->json(['error' => 'Branch not found'], 404);

        $branch->delete();
       return redirect()->back();
    }

    public function viewBranches(){
        $branches = Branch::all();

        return Inertia::render("Branch",['branches' => $branches ]);

    }
}
