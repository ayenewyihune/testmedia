<?php

namespace App\Http\Controllers\TestWorks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BoreholeLog;
use App\Testwork;
use App\Test;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;

class BoreholeLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('dashboard.testworks.create.log');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'project' => 'nullable',
            'client' => 'nullable',
            'location' => 'nullable',
            'coordinatex' => 'nullable',
            'coordinatey' => 'nullable',
            'elevation' => 'nullable',
            'drill_method' => 'nullable',
            'borehole_id' => 'nullable',
            'inclination' => 'nullable',
            'depth' => 'nullable',
            'bit_type' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'water_level' => 'nullable',
        ]);

        $testwork = new Testwork();
        $testwork->user_id = Auth::id();
        $testwork->test_id = Test::where('designation', 'Logging')->first()->id;
        $testwork->testwork_id = 1;
        $testwork->institute = $request->input('client');
        $testwork->test_date = $request->input('start_date');
        $testwork->tested_by = $request->input('project');
        $testwork->save();

        $log = new BoreholeLog();
        $log->user_id = Auth::id();
        $log->test_id = Test::where('designation', 'SPT')->first()->id;
        $log->testwork_id = $testwork->id;

        $log->project = $request->input('project');
        $log->client = $request->input('client');
        $log->location = $request->input('location');
        $log->coordinatex = $request->input('coordinatex');
        $log->coordinatey = $request->input('coordinatey');
        $log->elevation = $request->input('elevation');
        $log->drill_method = $request->input('drill_method');
        $log->borehole_id = $request->input('borehole_id');
        $log->inclination = $request->input('inclination');
        $log->depth = $request->input('depth');
        $log->bit_type = $request->input('bit_type');
        $log->start_date = $request->input('start_date');
        $log->end_date = $request->input('end_date');
        $log->water_level = $request->input('water_level');

        $log->save();

        $testwork = Testwork::find($testwork->id);
        $testwork->testwork_id = $log->id;
        $testwork->save();

        return redirect('/dashboard/testworks');
    }

    // Show testwork
    public function show($id)
    {
        $log = BoreholeLog::find($id);
        return view('dashboard.testworks.show.log')->with('log', $log);
    }

    // Analyze testwork
    public function analyze($id)
    {
        $log = BoreholeLog::find($id);
        return view('dashboard.testworks.analyze.log')->with([
            'log' => $log,
        ]);
    }
}
