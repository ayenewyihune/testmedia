<?php

namespace App\Http\Controllers\TestWorks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Test;
use App\Testwork;
use App\DirectShear;
use App\DirectShearDetail;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class DirectShearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function records()
    {
        return view('dashboard.testworks.create.direct_shear_pre');
    }

    public function create(Request $request)
    {
        $records_count1 = $request->get('records_count1');
        $records_count2 = $request->get('records_count2');
        $records_count3 = $request->get('records_count3');
        return view('dashboard.testworks.create.direct_shear')->with([
            'records_count1' => $records_count1,
            'records_count2' => $records_count2,
            'records_count3' => $records_count3
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'institute' => 'required',
            'test_date' => 'required',
            'tested_by' => 'required',
            'boring_number' => 'nullable',
            'sample_depth' => 'nullable',
            'visual_classification' => 'nullable',

            'diameter' => 'required|numeric',
            'height' => 'nullable|numeric',
            'mass' => 'nullable|numeric',

            'nstress1' => 'required|numeric',
            'nstress2' => 'required|numeric',
            'nstress3' => 'required|numeric',

            'displacement1.*' => 'required|numeric',
            'shear_force1.*' => 'required|numeric',

            'displacement2.*' => 'required|numeric',
            'shear_force2.*' => 'required|numeric',

            'displacement3.*' => 'required|numeric',
            'shear_force3.*' => 'required|numeric',
        ]);

        $records_count1 = count($request->displacement1);
        $records_count2 = count($request->displacement2);
        $records_count3 = count($request->displacement3);

        $testwork = new Testwork();
        $testwork->user_id = Auth::id();
        $testwork->test_id = Test::where('designation', 'Direct Shear')->first()->id;
        $testwork->testwork_id = 1;
        $testwork->institute = $request->input('institute');
        $testwork->test_date = $request->input('test_date');
        $testwork->tested_by = $request->input('tested_by');
        $testwork->save();

        $directshear = new DirectShear();
        $directshear->user_id = Auth::id();
        $directshear->test_id = Test::where('designation', 'Direct Shear')->first()->id;
        $directshear->testwork_id = $testwork->id;

        $directshear->institute = $request->input('institute');
        $directshear->test_date = $request->input('test_date');
        $directshear->tested_by = $request->input('tested_by');
        $directshear->boring_number = $request->input('boring_number');
        $directshear->sample_depth = $request->input('sample_depth');
        $directshear->visual_classification = $request->input('visual_classification');

        $directshear->diameter = $request->input('diameter');
        $directshear->height = $request->input('height');
        $directshear->mass = $request->input('mass');

        $directshear->nstress1 = $request->input('nstress1');
        $directshear->nstress2 = $request->input('nstress2');
        $directshear->nstress3 = $request->input('nstress3');

        $directshear->records1 = $records_count1;
        $directshear->records2 = $records_count2;
        $directshear->records3 = $records_count3;
        $directshear->save();

        $testwork = Testwork::find($testwork->id);
        $testwork->testwork_id = $directshear->id;
        $testwork->save();

        for ($i = 1; $i <= $records_count1; $i++) {
            $direct_shear_detail = new DirectShearDetail();

            $direct_shear_detail->user_id = Auth::id();
            $direct_shear_detail->test_id = Test::where('designation', 'Direct Shear')->first()->id;
            $direct_shear_detail->direct_shear_id = $directshear->id;

            $direct_shear_detail->test_number = 1;
            $direct_shear_detail->entry_number = $i;

            $direct_shear_detail->displacement = $request->input('displacement1.' . $i);
            $direct_shear_detail->shear_force = $request->input('shear_force1.' . $i);

            $direct_shear_detail->save();
        }

        for ($i = 1; $i <= $records_count2; $i++) {
            $direct_shear_detail = new DirectShearDetail();

            $direct_shear_detail->user_id = Auth::id();
            $direct_shear_detail->test_id = Test::where('designation', 'Direct Shear')->first()->id;
            $direct_shear_detail->direct_shear_id = $directshear->id;

            $direct_shear_detail->test_number = 2;
            $direct_shear_detail->entry_number = $i;

            $direct_shear_detail->displacement = $request->input('displacement2.' . $i);
            $direct_shear_detail->shear_force = $request->input('shear_force2.' . $i);

            $direct_shear_detail->save();
        }

        for ($i = 1; $i <= $records_count3; $i++) {
            $direct_shear_detail = new DirectShearDetail();

            $direct_shear_detail->user_id = Auth::id();
            $direct_shear_detail->test_id = Test::where('designation', 'Direct Shear')->first()->id;
            $direct_shear_detail->direct_shear_id = $directshear->id;

            $direct_shear_detail->test_number = 3;
            $direct_shear_detail->entry_number = $i;

            $direct_shear_detail->displacement = $request->input('displacement3.' . $i);
            $direct_shear_detail->shear_force = $request->input('shear_force3.' . $i);

            $direct_shear_detail->save();
        }

        return redirect('/dashboard/testworks');
    }

    // Show testwork
    public function show($id)
    {
        $directshear = DirectShear::find($id);
        $detail1 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 1])->get();
        $detail2 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 2])->get();
        $detail3 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 3])->get();
        return view('dashboard.testworks.show.direct_shear')->with([
            'directshear' => $directshear,
            'detail1' => $detail1,
            'detail2' => $detail2,
            'detail3' => $detail3
        ]);
    }

    // Edit testwork
    public function edit($id)
    {
        $directshear = DirectShear::find($id);
        $detail1 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 1])->get();
        $detail2 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 2])->get();
        $detail3 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 3])->get();
        return view('dashboard.testworks.edit.direct_shear')->with([
            'directshear' => $directshear,
            'detail1' => $detail1,
            'detail2' => $detail2,
            'detail3' => $detail3
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'institute' => 'required',
            'test_date' => 'required',
            'tested_by' => 'required',
            'boring_number' => 'nullable',
            'sample_depth' => 'nullable',
            'visual_classification' => 'nullable',

            'diameter' => 'required|numeric',
            'height' => 'nullable|numeric',
            'mass' => 'nullable|numeric',
            
            'nstress1' => 'required|numeric',
            'nstress2' => 'required|numeric',
            'nstress3' => 'required|numeric',

            'displacement1.*' => 'required|numeric',
            'shear_force1.*' => 'required|numeric',

            'displacement2.*' => 'required|numeric',
            'shear_force2.*' => 'required|numeric',

            'displacement3.*' => 'required|numeric',
            'shear_force3.*' => 'required|numeric',
        ]);

        $directshear = DirectShear::find($id);
        $directshear->user_id = Auth::id();
        $directshear->test_id = Test::where('designation', 'Direct Shear')->first()->id;

        $directshear->institute = $request->input('institute');
        $directshear->test_date = $request->input('test_date');
        $directshear->tested_by = $request->input('tested_by');
        $directshear->boring_number = $request->input('boring_number');
        $directshear->sample_depth = $request->input('sample_depth');
        $directshear->visual_classification = $request->input('visual_classification');

        $directshear->diameter = $request->input('diameter');
        $directshear->height = $request->input('height');
        $directshear->mass = $request->input('mass');

        $directshear->nstress1 = $request->input('nstress1');
        $directshear->nstress2 = $request->input('nstress2');
        $directshear->nstress3 = $request->input('nstress3');
        $directshear->save();

        $testwork = Testwork::find($directshear->testwork_id);
        $testwork->user_id = Auth::id();
        $testwork->test_id = Test::where('designation', 'Direct Shear')->first()->id;
        $testwork->institute = $request->input('institute');
        $testwork->test_date = $request->input('test_date');
        $testwork->tested_by = $request->input('tested_by');
        $testwork->save();

        $detail1 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 1])->get();
        $detail2 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 2])->get();
        $detail3 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 3])->get();

        foreach ($detail1 as $detail) {
            $i = $detail->entry_number;

            $detail->user_id = Auth::id();
            $detail->test_id = Test::where('designation', 'Direct Shear')->first()->id;
            $detail->direct_shear_id = $directshear->id;

            $detail->displacement = $request->input('displacement1.' . $i);
            $detail->shear_force = $request->input('shear_force1.' . $i);

            $detail->save();
        }

        foreach ($detail2 as $detail) {
            $i = $detail->entry_number;

            $detail->user_id = Auth::id();
            $detail->test_id = Test::where('designation', 'Direct Shear')->first()->id;
            $detail->direct_shear_id = $directshear->id;

            $detail->displacement = $request->input('displacement2.' . $i);
            $detail->shear_force = $request->input('shear_force2.' . $i);

            $detail->save();
        }

        foreach ($detail3 as $detail) {
            $i = $detail->entry_number;

            $detail->user_id = Auth::id();
            $detail->test_id = Test::where('designation', 'Direct Shear')->first()->id;
            $detail->direct_shear_id = $directshear->id;

            $detail->displacement = $request->input('displacement3.' . $i);
            $detail->shear_force = $request->input('shear_force3.' . $i);

            $detail->save();
        }

        return redirect('/dashboard/direct-shear/' . $id . '/show');
    }

    // Delete test work
    public function delete($id)
    {
        $directshear = DirectShear::find($id);
        $testwork = Testwork::find($directshear->testwork_id);
        $directshear_details = $directshear->direct_shear_details;
        foreach ($directshear_details as $detail) {
            $detail->delete();
        }
        $directshear->delete();
        $testwork->delete();
        return redirect('/dashboard/testworks');
    }

    // Analyze testwork
    public function analyze($id)
    {
        // Test details analysis
        $directshear = DirectShear::find($id);
        $area = $directshear->diameter * $directshear->diameter * pi() / 4;
        $detail1 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 1])->get();
        $detail2 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 2])->get();
        $detail3 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 3])->get();
        foreach ($detail1 as $i => $detail) {
            $displacement1[$i] = $detail->displacement;
            $shear_force1[$i] = $detail->shear_force;
            $shear_stress1[$i] = round($shear_force1[$i] * 1000 / $area, 3);
            $sdplot1[$i] = ['x' => $displacement1[$i], 'y' => $shear_stress1[$i]];
        }
        foreach ($detail2 as $i => $detail) {
            $displacement2[$i] = $detail->displacement;
            $shear_force2[$i] = $detail->shear_force;
            $shear_stress2[$i] = round($shear_force2[$i] * 1000 / $area, 3);
            $sdplot2[$i] = ['x' => $displacement2[$i], 'y' => $shear_stress2[$i]];
        }
        foreach ($detail3 as $i => $detail) {
            $displacement3[$i] = $detail->displacement;
            $shear_force3[$i] = $detail->shear_force;
            $shear_stress3[$i] = round($shear_force3[$i] * 1000 / $area, 3);
            $sdplot3[$i] = ['x' => $displacement3[$i], 'y' => $shear_stress3[$i]];
        }

        // C and Phi Determination
        $ns1 = $directshear->nstress1;
        $ns2 = $directshear->nstress2;
        $ns3 = $directshear->nstress3;
        $ss1 = max($shear_stress1);
        $ss2 = max($shear_stress2);
        $ss3 = max($shear_stress3);

        // Regression analysis
        $xbar = ($ns1 + $ns2 + $ns3) / 3;
        $ybar = ($ss1 + $ss2 + $ss3) / 3;
        $sumxy = $ns1 * $ss1 + $ns2 * $ss2 + $ns3 * $ss3;
        $sumxsumy = ($ns1 + $ns2 + $ns3) * ($ss1 + $ss2 + $ss3);
        $sumxsq = $ns1 ** 2 + $ns2 ** 2 + $ns3 ** 2;
        $sqsumx = ($ns1 + $ns2 + $ns3) ** 2;
        $a1 = (3 * $sumxy - $sumxsumy) / (3 * $sumxsq - $sqsumx);
        $a0 = $ybar - $a1 * $xbar;

        // C and phi
        $c = floor($a0);
        $phi = floor(atan($a1) * 180 / pi());

        // Chart points calculation
        $maxx = max($ns1, $ns2, $ns3);
        $minx = min($ns1, $ns2, $ns3);
        $x1 = 0;
        $x2 = $maxx + ($maxx - $minx) * 0.1;
        $y1 = $a1 * $x1 + $a0;
        $y2 = $a1 * $x2 + $a0;
        $y3 = $a1 * $ns1 + $a0;
        $y4 = $a1 * $ns2 + $a0;
        $y5 = $a1 * $ns3 + $a0;

        // Plotting
        // $chart = new DirectShearChart;
        $data = [['x' => $x1, 'y' => $y1], ['x' => $x2, 'y' => $y2], ['x' => $ns1, 'y' => $y3], ['x' => $ns2, 'y' => $y4], ['x' => $ns3, 'y' => $y5]];
        $data2 = [['x' => $ns1, 'y' => $ss1], ['x' => $ns2, 'y' => $ss2], ['x' => $ns3, 'y' => $ss3]];
        // $chart->dataset('σ vs τ graph', 'scatter', $data)
        //     ->color("rgb(0, 0, 0)")
        //     ->fill(false);
        // $chart->dataset('Data points', 'scatter', $data2)
        //     ->color("rgb(255, 0, 0)")
        //     ->fill(false);
        // $chart->dataset('Data points', 'scatter', [$ss1, $ss2, $ss3])
        //     ->color("rgb(50, 70, 100)")
        //     ->fill(false);
        // $chart->options(['tooltip' => ['show'=>true]]);

        return view('dashboard.testworks.analyze.direct_shear')->with([
            'directshear' => $directshear,
            'displacement1' => $displacement1,
            'shear_force1' => $shear_force1,
            'shear_stress1' => $shear_stress1,
            'displacement2' => $displacement2,
            'shear_force2' => $shear_force2,
            'shear_stress2' => $shear_stress2,
            'displacement3' => $displacement3,
            'shear_force3' => $shear_force3,
            'shear_stress3' => $shear_stress3,
            'sdplot1' => $sdplot1,
            'sdplot2' => $sdplot2,
            'sdplot3' => $sdplot3,
            'c' => $c,
            'phi' => $phi,
            'data' => $data,
            'data2' => $data2,
        ]);
    }

    public function generate_word($id)
    {
        $phpWord = new PhpWord();
        $directshear = DirectShear::find($id);
        // Title page
        $titlePage = $phpWord->addSection();
        $titlePage->addTextBreak(4);
        $phpWord->addFontStyle('titlefstyle1', array(
            'size' => 30, 'allCaps' => true, 'name' => 'Segoe UI Light', 'color' => '#1F4E79',
            'bold' => true,
        ));
        $phpWord->addParagraphStyle('titlepstyle1', array(
            'align' => 'center',
        ));
        $titlePage->addText('Direct Shear Test Report', 'titlefstyle1', 'titlepstyle1');

        $titlePage->addTextBreak(4);
        $titlePage->addText('Test Details', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $titlePage->addText('Test Date: ' . $directshear->test_date, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Tested By: ' . $directshear->tested_by, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Boring Number: ' . $directshear->boring_number, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Sample Depth: ' . $directshear->sample_depth, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Visual Classification of the Soil: ' . $directshear->visual_classification, array('size' => 12, 'name' => 'Segoe UI Light'));

        $titlePage->addTextBreak(7);
        $titlePage->addText('Prepared by', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $titlePage->addText($directshear->tested_by, array('size' => 12, 'name' => 'Segoe UI Light', 'bold' => true));
        $titlePage->addText($directshear->institute, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Date: ' . $directshear->updated_at->format('d/m/Y'), array('size' => 12, 'name' => 'Segoe UI Light'));

        // Main body
        $phpWord->addFontStyle('bodyfstyle1', array(
            'size' => 12, 'name' => 'Calibri',
        ));
        $phpWord->addParagraphStyle('bodypstyle1', array(
            'align' => 'both',
        ));
        $phpWord->addFontStyle('bodyfstyle2', array(
            'size' => 12, 'name' => 'Calibri', 'bold' => true,
        ));
        $phpWord->addParagraphStyle('bodypstyle2', array(
            'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
        ));

        $body = $phpWord->addSection();
        // Test name
        $body->addText('Test name', array('size' => 15));
        $body->addText('Standard Test Method for Direct Shear Test of Soils Under Consolidated Drained Conditions', 'bodyfstyle1', 'bodypstyle1');
        $body->addTextBreak(1);

        // Test scope
        $body->addText('Scope', array('size' => 15));
        $phpWord->addNumberingStyle('bodylstyle1', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));

        $body->addListItem('This test method covers the determination of the consolidated drained shear strength of a soil material in direct shear. The test is performed by deforming a specimen at a controlled strain rate on or near a single shear plane determined by the configuration of the apparatus. Generally, three or more specimens are tested, each under a different normal load, to determine the effects upon shear resistance and displacement, and strength properties such as Mohr strength envelopes.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('Shear stresses and displacements are nonuniformly distributed within the specimen. An appropriate height cannot be defined for calculation of shear strains. Therefore, stress-strain relationships or any associated quantity such as modulus, cannot be determined from this test.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('The determination of strength envelopes and the development of criteria to interpret and evaluate test results are left to the engineer or office requesting the test.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('The results of the test may be affected by the presence of soil or rock particles, or both.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('Test conditions including normal stress and moisture environment are selected which represent the field conditions being investigated. The rate of shearing should be slow enough to ensure drained conditions.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('There may be instances when the gap between the plates should be increased to accommodate sand sizes greater than the specified gap. Presently there is insufficient information available for specifying gap dimension based on particle size distribution.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('The values stated in inch-pound units are to be regarded as the standard. Within this test method the SI units are shown in brackets. The values stated in each system are not exact equivalents; therefore, each system must be used independently of each other.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('The method used to specify how data are collected, calculated, or recorded in this standard is not directly related to the accuracy to which the data can be applied in design or other uses, or both. How one applies the results obtained using this standard is beyond its scope.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('This standard does not purport to address all of the safety concerns, if any, associated with its use. It is the responsibility of the user of this standard to establish appropriate safety and health practices and determine the applicability of regulatory limitations prior to use.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addTextBreak(2);

        $body->addText('Reference', array('size' => 15));
        $body->addText('ASTM D 3080 – 03', 'bodyfstyle1', 'bodypstyle1');
        $body->addTextBreak(1);

        $phpWord->addNumberingStyle('bodylstyle2', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));
        $body->addText('Terminology', array('size' => 15));
        $body->addListItem('Relative Lateral Displacement—The horizontal displacement of the top and bottom shear box halves.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('Failure—The stress condition at failure for a test specimen. Failure is often taken to correspond to the maximum shear stress attained, or the shear stress at 15 to 20 percent relative lateral displacement. Depending on soil behavior and field application, other suitable criteria may be defined.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addTextBreak(1);

        $phpWord->addNumberingStyle('bodylstyle3', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));
        $body->addText('Use', array('size' => 15));
        $body->addListItem('The direct shear test is suited to the relatively rapid determination of consolidated drained strength properties because the drainage paths through the test specimen are short, thereby allowing excess pore pressure to be dissipated more rapidly than with other drained stress tests. The test can be made on all soil materials and undisturbed, remolded or compacted materials. There is however, a limitation on maximum particle size.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('The test results are applicable to assessing strength in a field situation where complete consolidation has occurred under the existing normal stresses. Failure is reached slowly under drained conditions so that excess pore pressures are dissipated. The results from several tests may be used to express the relationship between consolidation stress and drained shear strength.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('During the direct shear test, there is rotation of principal stresses, which may or may not model field conditions. Moreover, failure may not occur on the weak plane since failure is forced to occur on or near a horizontal plane at the middle of the specimen. The fixed location of the plane in the test can be an advantage in determining the shear resistance along recognizable weak planes within the soil material and for testing interfaces between dissimilar materials.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('Shear stresses and displacements are nonuniformly distributed within the specimen, and an appropriate height is not defined for calculating shear strains or any associated engineering quantity. The slow rate of displacement provides for dissipation of excess pore pressures, but it also permits plastic flow of soft cohesive soils. Care should be taken to ensure that the testing conditions represent those conditions being investigated.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('The range in normal stresses, rate of shearing, and general test conditions should be selected to approximate the specific soil conditions being investigated.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addText('NOTE 1—Notwithstanding the statement on precision and bias contained in this standard: The precision of this test method is dependent on the competence of the personnel performing the test and the suitability of the equipment and facilities used.', 'bodyfstyle1', 'bodypstyle1');
        $body->addTextBreak(1);

        $phpWord->addNumberingStyle('bodylstyle7', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));
        $body->addText('Apparatus', array('size' => 15));
        $body->addListItem('Direct shear device, Load and deformation dial gauges, Balance.', 0, 'bodyfstyle1', 'bodylstyle7', 'bodypstyle1');
        $body->addTextBreak(1);
        $body->addImage('http://labapp.net/storage/apparatus/direct_shear/1.png', array('width' => 450));
        $body->addImage('http://labapp.net/storage/apparatus/direct_shear/2.png', array('width' => 450));
        $body->addImage('http://labapp.net/storage/apparatus/direct_shear/3.png', array('width' => 450));
        $body->addImage('http://labapp.net/storage/apparatus/direct_shear/4.png', array('width' => 450));
        $body->addTextBreak(1);
        
        $phpWord->addNumberingStyle('bodylstyle4', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));
        $body->addText('Preparation', array('size' => 15));
        $body->addListItem('The sample used for specimen preparation should be sufficiently large so that a minimum of three similar specimens can be prepared. Prepare the specimens in a controlled temperature and humidity environment to minimize moisture loss or gain.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Extreme care shall be taken in preparing undisturbed specimens of sensitive soils to prevent disturbance to the natural soil structure. Determine the initial mass of the wet specimen for use in calculating the initial water content and unit weight of the specimen.', 1, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('The minimum specimen diameter for circular specimens, or width for square specimens, shall be 2.0 in. (50 mm), or not less than 10 times the maximum particle size diameter, whichever is larger, and conform to the width to thickness ratio specified in 4.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('The minimum initial specimen thickness shall be 0.5 in. (12 mm), but not less than six times the maximum particle diameter.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('The minimum specimen diameter to thickness or width to thickness ratio shall be 2:1.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addText('NOTE 2—If large soil particles are found in the soil after testing, a particle size analysis should be performed in accordance with Method D 422 to confirm the visual observations, and the result should be provided with the test report.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Specimen Preparation:', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Undisturbed Specimens—Prepare undisturbed specimens from large undisturbed samples or from samples secured in accordance with Practice D 1587, or other undisturbed tube sampling procedures. Undisturbed samples shall be preserved and transported as outlined for Group C or D samples in Practice D 4220. Handle specimens carefully to minimize disturbance, changes in cross section, or loss of water content. If compression or any type of noticeable disturbance would be caused by the extrusion device, split the sample tube lengthwise or cut it off in small sections to facilitate removal of the specimen with minimum disturbance. Prepare trimmed specimens, whenever possible, in an environment which will minimize the gain or loss of specimen moisture.', 1, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addText('NOTE 3—Acontrolled high-humidity room is desirable for this purpose.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Compacted Specimens—Specimens shall be prepared using the compaction method, water content, and unit weight prescribed by the individual assigning the test. Assemble and secure the shear box. Place a moist porous insert in the bottom of the shear box. Specimens may be molded by either kneading or tamping each layer until the accumulative mass of the soil placed in the shear box is compacted to a known volume, or by adjusting the number of layers, the number of tamps per layer, and the force per tamp. The top of each layer shall be scarified prior to the addition of material for the next layer. The compacted layer boundaries shall be positioned so they are not coincident with the shear plane defined by the shear box halves, unless this is the stated purpose for a particular test. The tamper used to compact the material shall have an area in contact with the soil equal to or less than 1⁄2 the area of the mold. Determine the mass of wet soil required for a single compacted lift and place it in the shear box. Compact the soil until the desired unit weight is obtained. Continue placing and compacting soil until the entire specimen is compacted.', 1, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addText('NOTE 4—Alight coating of grease applied to the inside of the shear box may be used to reduce friction between the specimen and shear box during consolidation. However, the upper ring in some shear devices requires friction to support the ring after the shear plates have been gapped. A light coating of grease applied between the halves of the shear box may be used to reduce friction between the halves of the shear box during shear. TFE-fluorocarbon coating may also be used on these surfaces instead of grease to reduce friction.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 5—The required thickness of the compacted lift may be determined by directly measuring the thickness of the lift, or from the marks on the tamping rod which correspond to the thickness of the lift being placed.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 6—The decision to dampen the porous inserts by inundating the shear box before applying the normal force depends on the problem under study. For undisturbed samples obtained below the water table, the porous inserts are usually dampened. For swelling soils, the sequence of consolidation, wetting, and shearing should model field conditions. Determine the compacted mass of the specimen from either the measured mass placed and compacted in the mold, or the difference between the mass of the shear box and compacted specimen and the tare mass of the shear box.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Material required for the specimen shall be batched by thoroughly mixing soil with sufficient water to produce the desired water content. Allow the specimen to stand prior to compaction in accordance with the following guide:', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $tableStyle = array('borderColor' => '555555', 'cellMargin' => 75, 'borderSize' => 2, 'align' => 'center');
        $cellStyle = array('valign' => 'center');
        $table = $body->addTable($tableStyle);
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(4000, $row1Style)->addText('Classification D 2487', 'bodyfstyle2', 'bodypstyle2');
        $row1->addCell(4000, $row1Style)->addText('Minimum Standing Time, h', 'bodyfstyle2', 'bodypstyle2');
        $row2 = $table->addRow();
        $row2->addCell(4000)->addText('SW, SP', 'bodyfstyle1', 'bodypstyle2');
        $row2->addCell(4000)->addText('No Requirement', 'bodyfstyle1', 'bodypstyle2');
        $row3 = $table->addRow();
        $row3->addCell(4000)->addText('M', 'bodyfstyle1', 'bodypstyle2');
        $row3->addCell(4000)->addText('3', 'bodyfstyle1', 'bodypstyle2');
        $row4 = $table->addRow();
        $row4->addCell(4000)->addText('SC, ML, CL', 'bodyfstyle1', 'bodypstyle2');
        $row4->addCell(4000)->addText('18', 'bodyfstyle1', 'bodypstyle2');
        $row5 = $table->addRow();
        $row5->addCell(4000)->addText('MH, CH', 'bodyfstyle1', 'bodypstyle2');
        $row5->addCell(4000)->addText('36', 'bodyfstyle1', 'bodypstyle2');
        $body->addListItem('Compacted specimens may also be prepared by compacting soil using the procedures and equipment used to determine moisture-density relationships of soils, and trimming the direct shear test specimen from the larger test specimen as though it were an undisturbed specimen.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        // $body->addTextBreak(1);

        $phpWord->addNumberingStyle('bodylstyle5', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 900),
            )));
        $body->addText('Procedure', array('size' => 15));
        $body->addListItem('Assemble the shear box.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Undisturbed Specimen—Place moist porous inserts over the exposed ends of the specimen in the shear box; place the shear box containing the undisturbed specimen and porous inserts into the shear box bowl and attach the shear box.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('NOTE 7—For some apparatus, the top half of the shear box is held in place by a notched rod which fits into a receptacle in the top half of the shear box. The bottom half of the shear box is held in place in the shear box bowl retaining bolts. For some apparatus, the top half of the shear box is held in placed by an anchor plate.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Compacted Specimen—Place the shear box containing the compacted specimen and porous inserts into the shear box bowl and attach the shear box.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Connect and adjust the shear force loading system so that no force is imposed on the load measuring device.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Properly position and adjust the horizontal displacement measurement device used to measure shear displacement. Obtain an initial reading or set the measurement device to indicate zero displacement.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Place a moist porous insert and load transfer plate on the top of the specimen in the shear box.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Place the normal force loading yoke into position and adjust it so the loading bar is horizontal. For dead load lever loading systems, level the lever. For pneumatic loading systems, adjust the yoke until it sits snugly against the recess in the load transfer plate, or place a ball bearing on the load transfer plate and adjust the yoke until the contact is snug.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Apply a small normal load to the specimen. Verify that all components of the loading system are seated and aligned. The top porous insert and load transfer plate must be aligned so that the movement of the load transfer plate into the shear box is not inhibited. Record the applied vertical load and horizontal load on the system.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('NOTE 8—The normal stress applied to the specimen should be approximately 1 lbf/in.2 (7 kPa).', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Attach and adjust the vertical displacement measurement device. Obtain initial reading for the vertical measurement device and a reading for the horizontal displacement measurement device.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('If required, fill the shear box with water, and keep it full for the duration of the test.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Calculate and record the normal force required to achieve the desired normal stress or increment thereof. Apply the desired normal stress by adding the appropriate mass to the lever arm hanger, or by increasing the pneumatic pressure.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('NOTE 9—The normal force used for the specimen will depend upon the data required. Application of the normal force in one increment may be appropriate for relatively firm soils. For relatively soft soils, application of the normal force in several increments may be necessary to prevent damage to the specimen.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Apply the desired normal load or increments thereof to the specimen and begin recording the normal deformation readings against elapsed time. For all load increments, verify completion of primary consolidation before proceeding (see Test Method D 2435). Plot the normal displacement versus either log of time or square root of time (in min).', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('After primary consolidation is completed, remove the alignment screws or pins from the shear box. Open the gap between the shear box halves to approximately 0.025 in. (0.64 mm) using the gap screws. Back out the gap screws.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Shear the specimen.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Select the appropriate displacement rate. Shear the specimen at a relatively slow rate so that no excess pore pressure would exist at failure. The following equation shall be used as a guide to determine the estimated minimum time required from the start of the test to failure:', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('tf = 50 * t50', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('tf = total estimated elapsed time to failure, min,', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('t50 = time required for the specimen to achieve 50 percent consolidation under the specified normal stress (or increments thereof), min.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 10—If the normal displacement versus square root of time used, t50 can be calculated from the time to complete 90 % consolidation using the following expression:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('t50 = t90 / 4.28', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('t90 = time required for the specimen to achieve 90 percent consolidation under the specified normal stress (or increment thereof), min.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('4.28 = constant, relates displacement and time factors at 50 and 90 percent consolidation.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 11—If the material exhibits a tendency to swell, the soil must be inundated with water and must be permitted to achieve equilibrium under an increment of normal stress large enough to counteract the swell tendency before the minimum time to failure can be determined. The time-consolidation curve for subsequent normal stress increments are then valid for use in determining tf.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 12—Some soils, such as dense sands and over consolidated clays, may not exhibit well defined time-settlement curves. Consequently, the calculation of tf may produce an inappropriate estimate of the time required to fail the specimen under drained conditions. For over consolidated clays which are tested under normal stresses less than the soil’s pre-consolidation pressure, it is suggested that a time to failure be estimated using a value of t50 equivalent to one obtained from normal consolidation time-settlement behavior. For clean dense sands which drain quickly, a value of 10 min may be used for tf. For dense sands with more than 5 % fines, a value of 60 min may be used for tf. If an alternative value of tf is selected, the rationale for the selection shall be explained with the test results.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Determine the appropriate displacement from the following equation:', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('dr = df / tf', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('dr = displacement rate (in./min, mm/min),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('df = estimated horizontal displacement at failure (in., mm),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('tf = total estimate elapsed time to failure, min.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 13—The magnitude of the estimated displacement at failure is dependent on many factors including the type and the stress history of the soil. As a guide, use df = 0.5 in. (12 mm) if the material is normally or lightly over consolidated fine-grained soil, otherwise use df = 0.2 in. (5 mm).', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Select and Set the Displacement Rate—For some types of apparatus, the displacement rate is achieved using combinations of gear wheels and gear lever positions. For other types the displacement rate is achieved by adjusting the motor speed.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Record the initial time, vertical and horizontal displacements, and normal and shear forces.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Start the apparatus and initiate shear.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Obtain data readings of time, vertical and horizontal displacement, and shear force at desired interval of displacement. Data readings should be taken at displacement intervals equal to 2 percent of the specimen diameter or width to accurately define a shear stress-displacement curve.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('NOTE 14—Additional readings may be helpful in identifying the value of peak shear stress of over consolidated or brittle material.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 15—It may be necessary to stop the test and re-gap the shear box halves to maintain clearance between the shear box halves.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('After reaching failure, stop the test apparatus. This displacement may range from 10 to 20 percent of the specimen’s original diameter or length.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Remove the normal force from the specimen by removing the mass from the lever and hanger, or by releasing the pressure.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('For cohesive test specimens, separate the shear box halves with a sliding motion along the failure plane. Do not pull the shear box halves apart perpendicularly to the failure surface, since it would damage the specimen. Photograph, sketch, or describe in writing the failure surface. This procedure is not applicable to cohesionless specimens.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Remove the specimen from the shear box and determine its water content.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Calculate and Plot the Following:', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Nominal shear stress versus relative lateral displacement.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addTextBreak(1);
        
        $phpWord->addNumberingStyle('bodylstyle6', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));
        $body->addText('Calculation', array('size' => 15));
        $body->addListItem('Calculate the following:', 0, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addListItem('Nominal shear stress, acting on the specimen is,', 1, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('τ = F / A', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('τ = nominal shear stress (lbf/in.2, kPa),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('F = shear force (lbf, N),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('A = initial area of the specimen (in.2, mm2).', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Normal stress acting on the specimen is,', 1, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('n = N / A', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('n = normal stress (lbf/in.2, kPa),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('N = normal vertical force acting on the specimen (lbf, N).', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 16—Factors which incorporate assumptions regarding the actual specimen surface area over which the shear and normal forces are measured can be applied to the calculated values of shear or normal stress, or both. If a correction(s) is made, the factor(s) and rationale for using the correction shall be explained with the test results.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Displacement Rate—Calculate the actual displacement rate by dividing the relative lateral displacement by the elapsed time, or report the rate used for the test.', 1, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('dr = dh / te', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('dr = displacement rate (in.,min, mm,min),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('dh = relative lateral displacement (in.,mm),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('te = elapsed time of test (min).', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Percent Relative Lateral Displacement—Calculate the percent relative lateral displacement for each shear force reading.', 1, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('dp = di / dh', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('dp = percent relative lateral displacement (%),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('di = incremental displacement (in.,mm),', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Compute the initial void ratio, dry unit weight and degree of saturation based on the specific gravity, initial water content, mass and volume of the total specimen. Specimen volume is determined by measurements of the shear box lengths or diameter and of the measured thickness of the specimen.', 1, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addTextBreak(1);

        // Data Sheet
        $dataSheet = $phpWord->addSection();
        $phpWord->addFontStyle('datafstyle1', array(
            'size' => 16, 'allCaps' => true, 'name' => 'Segoe UI Light', 'color' => '#1F4E79',
            'bold' => true,
        ));
        $phpWord->addFontStyle('datafstyle2', array(
            'size' => 12, 'name' => 'Calibri', 'bold' => true,
        ));
        $phpWord->addParagraphStyle('datapstyle1', array(
            'align' => 'center',
        ));
        $phpWord->addParagraphStyle('datapstyle2', array(
            'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
        ));
        $dataSheet->addText('Direct Shear Test Data Sheet', 'datafstyle1', 'datapstyle1');
        $dataSheet->addLine(['weight' => 1, 'width' => 460, 'height' => 0]);

        $dataSheet->addText('Date Tested: ' . $directshear->test_date, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Tested By: ' . $directshear->tested_by, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Boring Number: ' . $directshear->boring_number, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Sample Depth: ' . $directshear->sample_depth, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Visual Classification of the Soil: ' . $directshear->visual_classification, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addTextBreak(1);

        $dataSheet->addText('Sample Data', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $dataSheet->addText('Diameter (d): ' . $directshear->diameter.' mm', array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Length (L0): ' . $directshear->height.' mm', array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Mass: ' . $directshear->mass.' gm', array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addTextBreak(19);

        $area = round(($directshear->diameter) ** 2 * pi() / 4, 3);

        $dataSheet->addText('Table 1: Direct Shear Test Data (Normal Stress = '.$directshear->nstress1.' kPa)', 'bodyfstyle1', 'datapstyle1');
        $tableStyle = array('borderColor' => '555555', 'cellMargin' => 75, 'borderSize' => 2, 'align' => 'center');
        $cellStyle = array('valign' => 'center');
        $table = $dataSheet->addTable($tableStyle);
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(1000, $row1Style)->addText('No.', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Horizontal Displacement (mm)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Shear Force (N)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Shear Stress (kPa)', 'datafstyle2', 'datapstyle2');
        $detail1 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 1])->get();
        foreach ($detail1 as $i => $detail) {
            $displacement1[$i] = $detail->displacement;
            $shear_force1[$i] = $detail->shear_force;
            $shear_stress1[$i] = round($shear_force1[$i] * 1000 / $area, 3);
        }
        for ($i = 0; $i < count($displacement1); $i++) { 
            $row[$i] = $table->addRow();
            $row[$i]->addCell(1000, $cellStyle)->addText($i+1, 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($displacement1[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($shear_force1[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($shear_stress1[$i], 'bodyfstyle1', 'datapstyle2');
        }
        $dataSheet->addTextBreak(1);

        $dataSheet->addText('Table 2: Direct Shear Test Data (Normal Stress = '.$directshear->nstress2.' kPa)', 'bodyfstyle1', 'datapstyle1');
        $tableStyle = array('borderColor' => '555555', 'cellMargin' => 75, 'borderSize' => 2, 'align' => 'center');
        $cellStyle = array('valign' => 'center');
        $table = $dataSheet->addTable($tableStyle);
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(1000, $row1Style)->addText('No.', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Horizontal Displacement (mm)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Shear Force (N)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Shear Stress (kPa)', 'datafstyle2', 'datapstyle2');
        $detail2 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 2])->get();
        foreach ($detail2 as $i => $detail) {
            $displacement2[$i] = $detail->displacement;
            $shear_force2[$i] = $detail->shear_force;
            $shear_stress2[$i] = round($shear_force2[$i] * 1000 / $area, 3);
        }
        for ($i = 0; $i < count($displacement2); $i++) { 
            $row[$i] = $table->addRow();
            $row[$i]->addCell(1000, $cellStyle)->addText($i+1, 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($displacement2[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($shear_force2[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($shear_stress2[$i], 'bodyfstyle1', 'datapstyle2');
        }
        $dataSheet->addTextBreak(1);

        $dataSheet->addText('Table 3: Direct Shear Test Data (Normal Stress = '.$directshear->nstress3.' kPa)', 'bodyfstyle1', 'datapstyle1');
        $tableStyle = array('borderColor' => '555555', 'cellMargin' => 75, 'borderSize' => 2, 'align' => 'center');
        $cellStyle = array('valign' => 'center');
        $table = $dataSheet->addTable($tableStyle);
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(1000, $row1Style)->addText('No.', 'datafstyle2', 'datapstyle2');
        $row1->addCell(4000, $row1Style)->addText('Horizontal Displacement (mm)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(4000, $row1Style)->addText('Shear Force (N)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(4000, $row1Style)->addText('Shear Stress (kPa)', 'datafstyle2', 'datapstyle2');
        $detail3 = DirectShearDetail::where(['direct_shear_id' => $id, 'test_number' => 3])->get();
        foreach ($detail3 as $i => $detail) {
            $displacement3[$i] = $detail->displacement;
            $shear_force3[$i] = $detail->shear_force;
            $shear_stress3[$i] = round($shear_force3[$i] * 1000 / $area, 3);
        }
        for ($i = 0; $i < count($displacement3); $i++) { 
            $row[$i] = $table->addRow();
            $row[$i]->addCell(1000, $cellStyle)->addText($i+1, 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($displacement3[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($shear_force3[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(4000, $cellStyle)->addText($shear_stress3[$i], 'bodyfstyle1', 'datapstyle2');
        }

        // Images
        $dataSheet->addTextBreak(3);
        $dataSheet->addText('COPY THE SHEAR STRESS VS HORIZONTAL DISPLACEMENT PLOT FROM THE BROWSER AND PASTE IT HERE', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('Figure 1: Shear Stress vs Horizontal Displacement Plot', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(3);
        $dataSheet->addText('COPY THE SHEAR VS NORMAL STRESS PLOT FROM THE BROWSER AND PASTE IT HERE', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('Figure 2: Shear vs Normal Stress Plot', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('From the shear vs normal stress graph:', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ), 'bodypstyle1');

        // C and Phi Determination
        $ns1 = $directshear->nstress1;
        $ns2 = $directshear->nstress2;
        $ns3 = $directshear->nstress3;
        $ss1 = max($shear_stress1);
        $ss2 = max($shear_stress2);
        $ss3 = max($shear_stress3);

        // Regression analysis
        $xbar = ($ns1 + $ns2 + $ns3) / 3;
        $ybar = ($ss1 + $ss2 + $ss3) / 3;
        $sumxy = $ns1 * $ss1 + $ns2 * $ss2 + $ns3 * $ss3;
        $sumxsumy = ($ns1 + $ns2 + $ns3) * ($ss1 + $ss2 + $ss3);
        $sumxsq = $ns1 ** 2 + $ns2 ** 2 + $ns3 ** 2;
        $sqsumx = ($ns1 + $ns2 + $ns3) ** 2;
        $a1 = (3 * $sumxy - $sumxsumy) / (3 * $sumxsq - $sqsumx);
        $a0 = $ybar - $a1 * $xbar;

        // C and phi
        $c = floor($a0);
        $phi = floor(atan($a1) * 180 / pi());
        $dataSheet->addText('Cohesion (c) = '.$c.' kPa', 'datafstyle2', 'bodypstyle1');
        $dataSheet->addText('Angle of internal friction (φ) = '.$phi.' degrees', 'datafstyle2', 'bodypstyle1');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Direct Shear Test Report.docx');
        return response()->download(public_path('Direct Shear Test Report.docx'))->deleteFileAfterSend(true);
    }
}
