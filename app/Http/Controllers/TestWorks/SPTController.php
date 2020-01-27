<?php

namespace App\Http\Controllers\Testworks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Spt;
use App\SptDetail;
use App\Testwork;
use App\Test;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
// use PhpOffice\PhpWord\Shared\Html;

class SPTController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function records()
    {
        return view('dashboard.testworks.create.spt_pre');
    }

    public function create(Request $request)
    {
        $records_count = $request->get('records_count');
        return view('dashboard.testworks.create.spt')->with('records_count', $records_count);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'institute' => 'required',
            'test_date' => 'required',
            'tested_by' => 'required',
            'boring_number' => 'nullable',

            'efficiency' => 'required|numeric',
            'correction_bd' => 'required|numeric',
            'correction_s' => 'required|numeric',
            'correction_rl' => 'required|numeric',

            'depth.*' => 'required|numeric',
            'dn1.*' => 'required|numeric',
            'dn2.*' => 'required|numeric',
            'dn3.*' => 'required|numeric',
        ]);

        $records_count = count($request->depth);

        $testwork = new Testwork();
        $testwork->user_id = Auth::id();
        $testwork->test_id = Test::where('designation', 'SPT')->first()->id;
        $testwork->testwork_id = 1;
        $testwork->institute = $request->input('institute');
        $testwork->test_date = $request->input('test_date');
        $testwork->tested_by = $request->input('tested_by');
        $testwork->save();

        $spt = new Spt();
        $spt->user_id = Auth::id();
        $spt->test_id = Test::where('designation', 'SPT')->first()->id;
        $spt->testwork_id = $testwork->id;

        $spt->institute = $request->input('institute');
        $spt->test_date = $request->input('test_date');
        $spt->tested_by = $request->input('tested_by');
        $spt->boring_number = $request->input('boring_number');

        $spt->efficiency = $request->input('efficiency');
        $spt->correction_bd = $request->input('correction_bd');
        $spt->correction_s = $request->input('correction_s');
        $spt->correction_rl = $request->input('correction_rl');

        $spt->records = $records_count;
        $spt->save();

        $testwork = Testwork::find($testwork->id);
        $testwork->testwork_id = $spt->id;
        $testwork->save();

        for ($i = 1; $i <= $records_count; $i++) {
            $spt_detail = new SptDetail();

            $spt_detail->user_id = Auth::id();
            $spt_detail->test_id = Test::where('designation', 'SPT')->first()->id;
            $spt_detail->spt_id = $spt->id;

            $spt_detail->entry_number = $i;

            $spt_detail->depth = $request->input('depth.' . $i);
            $spt_detail->dn1 = $request->input('dn1.' . $i);
            $spt_detail->dn2 = $request->input('dn2.' . $i);
            $spt_detail->dn3 = $request->input('dn3.' . $i);

            $spt_detail->save();
        }

        return redirect('/dashboard/testworks');
    }

    // Show testwork
    public function show($id)
    {
        $spt = Spt::find($id);
        return view('dashboard.testworks.show.spt')->with('spt', $spt);
    }

    // Edit testwork
    public function edit($id)
    {
        $spt = Spt::find($id);
        return view('dashboard.testworks.edit.spt')->with('spt', $spt);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'institute' => 'required',
            'test_date' => 'required',
            'tested_by' => 'required',
            'boring_number' => 'nullable',

            'efficiency' => 'required|numeric',
            'correction_bd' => 'required|numeric',
            'correction_s' => 'required|numeric',
            'correction_rl' => 'required|numeric',

            'depth.*' => 'required|numeric',
            'dn1.*' => 'required|numeric',
            'dn2.*' => 'required|numeric',
            'dn3.*' => 'required|numeric',
        ]);

        $records_count = count($request->depth);

        $spt = Spt::find($id);
        $spt->user_id = Auth::id();
        $spt->test_id = Test::where('designation', 'SPT')->first()->id;

        $spt->institute = $request->input('institute');
        $spt->test_date = $request->input('test_date');
        $spt->tested_by = $request->input('tested_by');
        $spt->boring_number = $request->input('boring_number');

        $spt->efficiency = $request->input('efficiency');
        $spt->correction_bd = $request->input('correction_bd');
        $spt->correction_s = $request->input('correction_s');
        $spt->correction_rl = $request->input('correction_rl');

        $spt->save();

        $testwork = Testwork::find($spt->testwork_id);        
        $testwork->user_id = Auth::id();
        $testwork->test_id = Test::where('designation', 'SPT')->first()->id;
        $testwork->institute = $request->input('institute');
        $testwork->test_date = $request->input('test_date');
        $testwork->tested_by = $request->input('tested_by');
        $testwork->save();

        foreach ($spt->spt_details as $spt_detail) {
            $i = $spt_detail->entry_number;

            $spt_detail->user_id = Auth::id();
            $spt_detail->test_id = Test::where('designation', 'SPT')->first()->id;
            $spt_detail->spt_id = $spt->id;

            $spt_detail->depth = $request->input('depth.' . $i);
            $spt_detail->dn1 = $request->input('dn1.' . $i);
            $spt_detail->dn2 = $request->input('dn2.' . $i);
            $spt_detail->dn3 = $request->input('dn3.' . $i);

            $spt_detail->save();
        }

        return redirect('/dashboard/spt/'.$spt->id.'/show');
    }

    // Delete test work
    public function delete($id)
    {
        $spt = Spt::find($id);
        $testwork = Testwork::find($spt->testwork_id);
        $spt_details = $spt->spt_details;
        foreach ($spt_details as $detail) {
            $detail->delete();
        }
        $spt->delete();
        $testwork->delete();
        return redirect('/dashboard/testworks');
    }

    // Analyze testwork
    public function analyze($id)
    {
        $spt = Spt::find($id);
        $spt_details = $spt->spt_details;
        foreach ($spt_details as $i => $detail) {
            $depth[$i] = $detail->depth;
            $n[$i] = $detail->dn2 + $detail->dn3;
            $nplot[$i] = ['x'=>$n[$i], 'y'=>$depth[$i]];
            $n60[$i] = floor(($n[$i] * $spt->efficiency * $spt->correction_bd * $spt->correction_s * $spt->correction_rl)/60);
            $n70[$i] = floor(($n[$i] * $spt->efficiency * $spt->correction_bd * $spt->correction_s * $spt->correction_rl)/70);
            $b = 1.5;
            for ($j=0; $j < 6; $j++) {
                $kd = 1 + 0.33*($depth[$i]/$b);
                if ($kd>1.33) {
                    $kd = 1.33;
                }
                $bc[$i][$j] = round(($n70[$i]/0.06)*(($b+0.3)/$b)*(($b+0.3)/$b)*$kd, 2, PHP_ROUND_HALF_DOWN);
                $b += 0.5;
            }
        }

        for ($i=0; $i < count($depth); $i++) { 
            $bcplot1p5[$i] = ['x'=>$bc[$i][0], 'y'=>$depth[$i]];
            $bcplot2[$i] = ['x'=>$bc[$i][1], 'y'=>$depth[$i]];
            $bcplot2p5[$i] = ['x'=>$bc[$i][2], 'y'=>$depth[$i]];
            $bcplot3[$i] = ['x'=>$bc[$i][3], 'y'=>$depth[$i]];
            $bcplot3p5[$i] = ['x'=>$bc[$i][4], 'y'=>$depth[$i]];
            $bcplot4[$i] = ['x'=>$bc[$i][5], 'y'=>$depth[$i]];
        }
        return view('dashboard.testworks.analyze.spt')->with([
            'spt' => $spt,
            'depth' => $depth,
            'n' => $n,
            'n60' => $n60,
            'n70' => $n70,
            'bc' => $bc,
            'nplot'=>$nplot,
            'bcplot1p5'=>$bcplot1p5,
            'bcplot2'=>$bcplot2,
            'bcplot2p5'=>$bcplot2p5,
            'bcplot3'=>$bcplot3,
            'bcplot3p5'=>$bcplot3p5,
            'bcplot4'=>$bcplot4,
        ]);
    }

    // Generate report
    public function generate_word($id)
    {
        $phpWord = new PhpWord();
        $spt = Spt::find($id);
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
        $titlePage->addText('Standard Penetration Test (SPT) Report', 'titlefstyle1', 'titlepstyle1');

        $titlePage->addTextBreak(4);
        $titlePage->addText('Test Details', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $titlePage->addText('Test Date: ' . $spt->test_date, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Tested By: ' . $spt->tested_by, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Boring Number: ' . $spt->boring_number, array('size' => 12, 'name' => 'Segoe UI Light'));
        
        $titlePage->addTextBreak(7);
        $titlePage->addText('Prepared by', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $titlePage->addText($spt->tested_by, array('size' => 12, 'name' => 'Segoe UI Light', 'bold' => true));
        $titlePage->addText($spt->institute, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Date: ' . $spt->updated_at->format('d/m/Y'), array('size' => 12, 'name' => 'Segoe UI Light'));

        // Main body
        $body = $phpWord->addSection();
        // Test name
        $body->addText('Test name', array('size' => 15));
        $body->addText('Standard Test Method for Penetration Test and Split-Barrel Sampling of Soils', 'bodyfstyle1', 'bodypstyle1');
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
        $phpWord->addFontStyle('bodyfstyle1', array(
            'size' => 12, 'name' => 'Calibri',
        ));
        $phpWord->addParagraphStyle('bodypstyle1', array(
            'align' => 'both',
        ));

        $body->addListItem('This test method describes the procedure, generally known as the Standard Penetration Test (SPT), for driving a split-barrel sampler to obtain a representative soil sample and a measure of the resistance of the soil to penetration of the sampler.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('This standard does not purport to address all of the safety problems, if any, associated with its use. It is the responsibility of the user of this standard to establish appropriate safety and health practices and determine the applicability of regulatory limitations prior to use.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('The values stated in inch-pound units are to be regarded as the standard.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addText('NOTE 1—ASTM Practice D 6066 can be used when testing loose sands below the water table for liquefaction studies or when a higher level of care is required when drilling these soils. This practice provides information on drilling methods, equipment variables, energy corrections, and blow-count normalization.', 'bodyfstyle1', 'bodypstyle1');
        $body->addTextBreak(1);

        $body->addText('Reference', array('size' => 15));
        $body->addText('ASTM D 1586 – 99', 'bodyfstyle1', 'bodypstyle1');
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
        $body->addListItem('anvil—that portion of the drive-weight assembly which the hammer strikes and through which the hammer energy passes into the drill rods.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('cathead—the rotating drum or windlass in the ropecathead lift system around which the operator wraps a rope to lift and drop the hammer by successively tightening and loosening the rope turns around the drum.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('drill rods—rods used to transmit downward force and torque to the drill bit while drilling a borehole.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('drive-weight assembly—a device consisting of the hammer, hammer fall guide, the anvil, and any hammer drop system.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('hammer—that portion of the drive-weight assembly consisting of the 140 ± 2 lb (63.5 ± 1 kg) impact weight which is successively lifted and dropped to provide the energy that accomplishes the sampling and penetration.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('hammer drop system—that portion of the drive-weight assembly by which the operator accomplishes the lifting and dropping of the hammer to produce the blow.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('hammer fall guide—that part of the drive-weight assembly used to guide the fall of the hammer.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('N-value—the blowcount representation of the penetration resistance of the soil. The N-value, reported in blows per foot, equals the sum of the number of blows required to drive the sampler over the depth interval of 6 to 18 in. (150 to 450 mm).', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('DN—the number of blows obtained from each of the 6-in. (150-mm) intervals of sampler penetration.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('number of rope turns—the total contact angle between the rope and the cathead at the beginning of the operator’s rope slackening to drop the hammer, divided by 360°.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('sampling rods—rods that connect the drive-weight assembly to the sampler. Drill rods are often used for this purpose.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('SPT—abbreviation for standard penetration test, a term by which engineers commonly refer to this method.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
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
        $body->addListItem('This test method provides a soil sample for identification purposes and for laboratory tests appropriate for soil obtained from a sampler that may produce large shear strain disturbance in the sample.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('This test method is used extensively in a great variety of geotechnical exploration projects. Many local correlations and widely published correlations which relate SPT blowcount, or N-value, and the engineering behavior of earthworks and foundations are available.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addTextBreak(1);

        // $phpWord->addNumberingStyle('bodylstyle7', array(
        //     'type' => 'multilevel',
        //     'levels' => array(
        //         array(
        //             'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
        //         ),
        //         array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
        //     )));
        // $body->addText('Apparatus', array('size' => 15));
        // $body->addListItem('Compression device, Load and deformation dial gauges, Sample trimming equipment, Balance, Moisture can.', 0, 'bodyfstyle1', 'bodylstyle7', 'bodypstyle1');
        // $body->addTextBreak(1);
        // $body->addImage('http://labapp.net/storage/apparatus/spt/1.png', array('width' => 450));
        // $body->addTextBreak(1);
        // $body->addImage('http://labapp.net/storage/apparatus/spt/2.png', array('width' => 450));
        // $body->addTextBreak(1);

        $phpWord->addNumberingStyle('bodylstyle4', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));
        $body->addText('Preparation', array('size' => 15));
        $body->addListItem('The boring shall be advanced incrementally to permit intermittent or continuous sampling. Test intervals and locations are normally stipulated by the project engineer or geologist. Typically, the intervals selected are 5 ft (1.5 mm) or less in homogeneous strata with test and sampling locations at every change of strata.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Any drilling procedure that provides a suitably clean and stable hole before insertion of the sampler and assures that the penetration test is performed on essentially undisturbed soil shall be acceptable. Each of the following procedures have proven to be acceptable for some subsurface conditions. The subsurface conditions anticipated should be considered when selecting the drilling method to be used.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Open-hole rotary drilling method.', 1, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Continuous flight hollow-stem auger method.', 1, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Wash boring method.', 1, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Continuous flight solid auger method.', 1, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Several drilling methods produce unacceptable borings. The process of jetting through an open tube sampler and then sampling when the desired depth is reached shall not be permitted. The continuous flight solid auger method shall not be used for advancing the boring below a water table or below the upper confining bed of a confined non cohesive stratum that is under artesian pressure. Casing may not be advanced below the sampling elevation prior to sampling. Advancing a boring with bottom discharge bits is not permissible. It is not permissible to advance the boring for subsequent insertion of the sampler solely by means of previous sampling with the SPT sampler.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('The drilling fluid level within the boring or hollow-stem augers shall be maintained at or above the in situ groundwater level at all times during drilling, removal of drill rods, and sampling.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addTextBreak(1);
        
        $phpWord->addNumberingStyle('bodylstyle5', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                array('format' => 'decimal', 'text' => '%1.%2.%3.', 'left' => 1080, 'hanging' => 360, 'tabPos' => 1080),
            )));
        $body->addText('Procedure', array('size' => 15));
        $body->addListItem('After the boring has been advanced to the desired sampling elevation and excessive cuttings have been removed, prepare for the test with the following sequence of operations.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Attach the split-barrel sampler to the sampling rods and lower into the borehole. Do not allow the sampler to drop onto the soil to be sampled.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Position the hammer above and attach the anvil to the top of the sampling rods. This may be done before the sampling rods and sampler are lowered into the borehole.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Rest the dead weight of the sampler, rods, anvil, and drive weight on the bottom of the boring and apply a seating blow. If excessive cuttings are encountered at the bottom of the boring, remove the sampler and sampling rods from the boring and remove the cuttings.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Mark the drill rods in three successive 6-in. (0.15-m) increments so that the advance of the sampler under the impact of the hammer can be easily observed for each 6-in. (0.15-m) increment.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Drive the sampler with blows from the 140-lb (63.5-kg) hammer and count the number of blows applied in each 6-in. (0.15-m) increment until one of the following occurs:', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('A total of 50 blows have been applied during any one of the three 6-in. (0.15-m) increments described in 1.4.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('A total of 100 blows have been applied.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('There is no observed advance of the sampler during the application of 10 successive blows of the hammer.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('The sampler is advanced the complete 18 in. (0.45 m) without the limiting blow counts occurring as described above.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Record the number of blows required to effect each 6 in. (0.15 m) of penetration or fraction thereof. The first 6 in. is considered to be a seating drive. The sum of the number of blows required for the second and third 6 in. of penetration is termed the “standard penetration resistance,” or the “N-value.” If the sampler is driven less than 18 in. (0.45 m), as permitted in 2.1, 2.2, or 2.3, the number of blows per each complete 6-in. (0.15-m) increment and per each partial increment shall be recorded on the boring log. For partial increments, the depth of penetration shall be reported to the nearest 1 in. (25 mm), in addition to the number of blows. If the sampler advances below the bottom of the boring under the static weight of the drill rods or the weight of the drill rods plus the static weight of the hammer, this information should be noted on the boring log.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('The raising and dropping of the 140-lb (63.5-kg) hammer shall be accomplished using either of the following two methods:', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('By using a trip, automatic, or semi-automatic hammer drop system which lifts the 140-lb (63.5-kg) hammer and allows it to drop 30 ± 1.0 in. (0.76 m ± 25 mm) unimpeded.', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('By using a cathead to pull a rope attached to the hammer. When the cathead and rope method is used the system and operation shall conform to the following:', 1, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('The cathead shall be essentially free of rust, oil, or grease and have a diameter in the range of 6 to 10 in. (150 to 250 mm).', 2, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('The cathead should be operated at a minimum speed of rotation of 100 RPM, or the approximate speed of rotation shall be reported on the boring log.', 2, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('No more than 2 1⁄4 rope turns on the cathead may be used during the performance of the penetration test.', 2, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('NOTE 5—The operator should generally use either 1 3⁄4 or 2 1⁄4 rope turns, depending upon whether or not the rope comes off the top (1 3⁄4 turns) or the bottom (2 1⁄4 turns) of the cathead. It is generally known and accepted that 2 3⁄4 or more rope turns considerably impedes the fall of the hammer and should not be used to perform the test. The cathead rope should be maintained in a relatively dry, clean, and unfrayed condition.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('For each hammer blow, a 30-in. (0.76-m) lift and drop shall be employed by the operator. The operation of pulling and throwing the rope shall be performed rhythmically without holding the rope at the top of the stroke.', 2, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addListItem('Bring the sampler to the surface and open. Record the percent recovery or the length of sample recovered. Describe the soil samples recovered as to composition, color, stratification, and condition, then place one or more representative portions of the sample into sealable moisture-proof containers (jars) without ramming or distorting any apparent stratification. Seal each container to prevent evaporation of soil moisture. Affix labels to the containers bearing job designation, boring number, sample depth, and the blow count per 6-in. (0.15-m) increment. Protect the samples against extreme temperature changes. If there is a soil change within the sampler, make a jar for each stratum and note its location in the sampler barrel.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addTextBreak(1);

        // $phpWord->addNumberingStyle('bodylstyle6', array(
        //     'type' => 'multilevel',
        //     'levels' => array(
        //         array(
        //             'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
        //         ),
        //         array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
        //     )));
        // $body->addText('Calculation', array('size' => 15));
        // $body->addText('No calculation', 'bodyfstyle1', 'bodypstyle1');
        // $body->addTextBreak(1);

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
        $dataSheet->addText('Standard Penetration Test (SPT) Data Sheet', 'datafstyle1', 'datapstyle1');
        $dataSheet->addLine(['weight' => 1, 'width' => 460, 'height' => 0]);

        $dataSheet->addText('Date Tested: ' . $spt->test_date, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Tested By: ' . $spt->tested_by, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Boring Number: ' . $spt->boring_number, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addTextBreak(1);

        $dataSheet->addText('Correction Coefficients', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $dataSheet->addText('Hammer Efficiency (%): ' . $spt->efficiency.' %', array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Borehole Diameter Correction: ' . $spt->correction_bd, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Sampler Correction: ' . $spt->correction_s, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Road Length Correction: ' . $spt->correction_rl, array('size' => 12, 'name' => 'Segoe UI Light'));

        $dataSheet->addText('Table 1: Test Details', 'bodyfstyle1', 'datapstyle1');
        $tableStyle = array('borderColor' => '555555', 'cellMargin' => 75, 'borderSize' => 2, 'align' => 'center');
        $cellStyle = array('valign' => 'center');
        $table = $dataSheet->addTable($tableStyle);
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(1000, $row1Style)->addText('No.', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Depth (m)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('ΔN (1st 15cm)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('ΔN (2nd 15cm)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('ΔN (3rd 15cm)', 'datafstyle2', 'datapstyle2');
        $spt_details = $spt->spt_details;
        foreach ($spt_details as $i => $detail) {
            $depth[$i] = $detail->depth;
            $dn1[$i] = $detail->dn1;
            $dn2[$i] = $detail->dn2;
            $dn3[$i] = $detail->dn3;
        }
        for ($i = 0; $i < count($depth); $i++) { 
            $row[$i] = $table->addRow();
            $row[$i]->addCell(1000, $cellStyle)->addText($i+1, 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($depth[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($dn1[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($dn2[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($dn3[$i], 'bodyfstyle1', 'datapstyle2');
        }
        $dataSheet->addTextBreak(1);

        $dataSheet->addText('Table 2: SPT Analysis Results', 'bodyfstyle1', 'datapstyle1');
        $table = $dataSheet->addTable($tableStyle);
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(1000, $row1Style)->addText('No.', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Depth (m)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('N', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('N60', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('N70', 'datafstyle2', 'datapstyle2');
        $spt_details = $spt->spt_details;
        foreach ($spt_details as $i => $detail) {
            $depth[$i] = $detail->depth;
            $n[$i] = $detail->dn2 + $detail->dn3;
            $n60[$i] = floor(($n[$i] * $spt->efficiency * $spt->correction_bd * $spt->correction_s * $spt->correction_rl)/60);
            $n70[$i] = floor(($n[$i] * $spt->efficiency * $spt->correction_bd * $spt->correction_s * $spt->correction_rl)/70);
            $b = 1.5;
            for ($j=0; $j < 6; $j++) {
                $kd = 1 + 0.33*($depth[$i]/$b);
                if ($kd>1.33) {
                    $kd = 1.33;
                }
                $bc[$i][$j] = round(($n70[$i]/0.06)*(($b+0.3)/$b)*(($b+0.3)/$b)*$kd, 2, PHP_ROUND_HALF_DOWN);
                $b += 0.5;
            }
        }
        for ($i = 0; $i < count($depth); $i++) { 
            $row[$i] = $table->addRow();
            $row[$i]->addCell(1000, $cellStyle)->addText($i+1, 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($depth[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($n[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($n60[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($n70[$i], 'bodyfstyle1', 'datapstyle2');
        }
        $dataSheet->addTextBreak(1);

        $dataSheet->addText('Table 3: Allowable Bearing Capacity According to Bowels', 'bodyfstyle1', 'datapstyle1');
        $table = $dataSheet->addTable($tableStyle);
        $cellColSpan = array('gridSpan' => 6, 'bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(1000, $row1Style)->addText('No.', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Depth (m)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(12000, $cellColSpan)->addText('Allowable Bearing Capacity (kPa)', 'datafstyle2', 'datapstyle2');
        $row2 = $table->addRow();
        $row2->addCell(1000, $cellStyle);
        $row2->addCell(3000, $cellStyle);
        $row2->addCell(2000, $cellStyle)->addText('B = 1.5 m', 'bodyfstyle1', 'datapstyle2');
        $row2->addCell(2000, $cellStyle)->addText('B = 2 m', 'bodyfstyle1', 'datapstyle2');
        $row2->addCell(2000, $cellStyle)->addText('B = 2.5 m', 'bodyfstyle1', 'datapstyle2');
        $row2->addCell(2000, $cellStyle)->addText('B = 3 m', 'bodyfstyle1', 'datapstyle2');
        $row2->addCell(2000, $cellStyle)->addText('B = 3.5 m', 'bodyfstyle1', 'datapstyle2');
        $row2->addCell(2000, $cellStyle)->addText('B = 4 m', 'bodyfstyle1', 'datapstyle2');
        for ($i = 0; $i < count($depth); $i++) { 
            $row[$i] = $table->addRow();
            $row[$i]->addCell(1000, $cellStyle)->addText($i+1, 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($depth[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($bc[$i][0], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($bc[$i][1], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($bc[$i][2], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($bc[$i][3], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($bc[$i][4], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($bc[$i][5], 'bodyfstyle1', 'datapstyle2');
        }
        $dataSheet->addTextBreak(1);

        // Images
        $dataSheet->addTextBreak(3);
        $dataSheet->addText('COPY THE N VALUE VS DEPTH PLOT FROM THE BROWSER AND PASTE IT HERE', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('Figure 1: N value vs Depth Plot', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(3);
        $dataSheet->addText('COPY THE BEARING CAPACITY VS DEPTH PLOT FROM THE BROWSER AND PASTE IT HERE', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('Figure 2: Bearing Capacity vs Depth Plot', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('SPT Test Report.docx');
        return response()->download(public_path('SPT Test Report.docx'))->deleteFileAfterSend(true);
    }
}
