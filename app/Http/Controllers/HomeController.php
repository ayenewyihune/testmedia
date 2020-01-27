<?php

namespace App\Http\Controllers;

use App\Test;
use App\Testwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show user info
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.account_info.show')->with('user', $user);
    }

    // Edit user info
    public function edit_user()
    {
        $user = Auth::user();
        return view('dashboard.account_info.edit')->with('user', $user);
    }

    // Update user info
    public function update_user(Request $request)
    {
        $id = Auth::id();
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'user_id' => 'required|string|max:255|unique:users,user_id,' . $id,
        ]);

        $user = Auth::user();
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->user_id = $request->input('user_id');
        $user->save();

        return redirect('/dashboard');
    }

    // Show list of tests
    public function tests()
    {
        $user = Auth::user();
        $tests = $user->tests()->get();
        return view('dashboard.tests.list')->with('tests', $tests);
    }

    // Create test
    public function create_test()
    {
        return view('dashboard.tests.create');
    }

    // Store test
    public function store_test(Request $request)
    {
        $this->validate($request, [
            'designation' => 'nullable',
            'name' => 'required',
            'scope' => 'nullable',
            'reference' => 'nullable',
            'terminology' => 'nullable',
            'use' => 'nullable',
            'preparation' => 'nullable',
            'procedure' => 'required',
            'calculation' => 'nullable',
            'report' => 'nullable',
        ]);

        $test = new Test();
        $test->user_id = Auth::id();
        $test->designation = $request->input('designation');
        $test->name = $request->input('name');
        $test->scope = $request->input('scope');
        $test->reference = $request->input('reference');
        $test->terminology = $request->input('terminology');
        $test->use = $request->input('use');
        $test->preparation = $request->input('preparation');
        $test->procedure = $request->input('procedure');
        $test->calculation = $request->input('calculation');
        $test->report = $request->input('report');
        $test->save();

        return redirect('/dashboard/tests');
    }

    // Show test
    public function show_test($id)
    {
        $test = Test::find($id);
        return view('dashboard.tests.show')->with('test', $test);
    }

    // Edit test
    public function edit_test($id)
    {
        $test = Test::find($id);
        return view('dashboard.tests.edit')->with('test', $test);
    }

    // Update test
    public function update_test(Request $request, $id)
    {
        $this->validate($request, [
            'designation' => 'nullable',
            'name' => 'required',
            'scope' => 'nullable',
            'reference' => 'nullable',
            'terminology' => 'nullable',
            'use' => 'nullable',
            'preparation' => 'nullable',
            'procedure' => 'required',
            'calculation' => 'nullable',
            'report' => 'nullable',
        ]);

        $test = Test::find($id);
        $test->user_id = Auth::id();
        $test->designation = $request->input('designation');
        $test->name = $request->input('name');
        $test->scope = $request->input('scope');
        $test->reference = $request->input('reference');
        $test->terminology = $request->input('terminology');
        $test->use = $request->input('use');
        $test->preparation = $request->input('preparation');
        $test->procedure = $request->input('procedure');
        $test->calculation = $request->input('calculation');
        $test->report = $request->input('report');
        $test->save();

        return redirect('/dashboard/tests');
    }

    // Delete test
    public function delete_test($id)
    {
        $test = Test::find($id);
        $test->delete();
        return redirect('/dashboard/tests');
    }

    // Show list of testworks
    public function testworks()
    {
        $user = Auth::user();
        $testworks = $user->testworks()->get();
        return view('dashboard.testworks.list')->with('testworks', $testworks);
    }

    // Select test for testwork
    public function select_test()
    {
        return view('dashboard.testworks.select_test');
    }

    // Redirect to create test route of each test
    public function create_testwork(Request $request)
    {
        $test = $request->get('test_type');
        if ($test == 'Direct Shear') {
            return redirect('/dashboard/direct-shear/records');
        } elseif ($test == 'UCS') {
            return redirect('/dashboard/ucs/records');
        } elseif ($test == 'Triaxial (UU)') {
            return redirect('/dashboard/uu-triaxial/create');
        } elseif ($test == 'SPT') {
            return redirect('/dashboard/spt/records');
        } elseif ($test == 'Logging') {
            return redirect('/dashboard/log/create');
        } else {
            return redirect('/dashboard/select-test');
        }
    }
}
