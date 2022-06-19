<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ReportController extends Controller {

    public function getAllReports() {
        // return redirect()->back();
    }

    public function showReports() {
        $reports = Report::all();

        return Inertia::render( 'Report', [ 'reports' => $reports ] );

    }
}
