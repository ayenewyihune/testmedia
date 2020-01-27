<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestsController extends Controller
{
    // Show list of tests
    public function index()
    {
        $tests = Test::all();
        return view('test.index')->with('tests', $tests);
    }

    // Search test
    public function search(Request $request) {
        $q = $request->input('search');
        $tests = Test::where('name', 'like', '%'.$q.'%')->get();
        return view('test.index')->with('tests', $tests);
    }

    // Show test dashboard and basic data
    public function show($id)
    {
        $test = Test::find($id);
        return view('test.show.basic')->with('test', $test);
    }

    // Show test apparatus
    public function apparatus($id)
    {
        $test = Test::find($id);
        return view('test.show.apparatus')->with('test', $test);
    }

    // Show test sample
    public function sample($id)
    {
        $test = Test::find($id);
        return view('test.show.sample')->with('test', $test);
    }

    // Show test procedure
    public function procedure($id)
    {
        $test = Test::find($id);
        return view('test.show.procedure')->with('test', $test);
    }

    // Show test calculation
    public function calculation($id)
    {
        $test = Test::find($id);
        return view('test.show.calculation')->with('test', $test);
    }

    // Show test report
    public function report($id)
    {
        $test = Test::find($id);
        return view('test.show.report')->with('test', $test);
    }
}
