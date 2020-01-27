<?php

namespace App\Http\Controllers\Testworks;

use App\Http\Controllers\Controller;
use App\Test;
use App\Testwork;
use App\Ucs;
use App\UcsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class UCSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function records()
    {
        return view('dashboard.testworks.create.ucs_pre');
    }

    public function create(Request $request)
    {
        $records_count = $request->get('records_count');
        return view('dashboard.testworks.create.ucs')->with('records_count', $records_count);
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

            'mass' => 'required|numeric',
            'diameter' => 'required|numeric',
            'height' => 'required|numeric',

            'can_no' => 'required',
            'can_mass' => 'required|numeric',
            'candms_mass' => 'required|numeric',
            'candds_mass' => 'required|numeric',

            'deformation.*' => 'required|numeric',
            'load.*' => 'required|numeric',
        ]);

        $records_count = count($request->load);

        $testwork = new Testwork();
        $testwork->user_id = Auth::id();
        $testwork->test_id = Test::where('designation', 'UCS')->first()->id;
        $testwork->testwork_id = 1;
        $testwork->institute = $request->input('institute');
        $testwork->test_date = $request->input('test_date');
        $testwork->tested_by = $request->input('tested_by');
        $testwork->save();

        $ucs = new Ucs();
        $ucs->user_id = Auth::id();
        $ucs->test_id = Test::where('designation', 'UCS')->first()->id;
        $ucs->testwork_id = $testwork->id;

        $ucs->institute = $request->input('institute');
        $ucs->test_date = $request->input('test_date');
        $ucs->tested_by = $request->input('tested_by');
        $ucs->boring_number = $request->input('boring_number');
        $ucs->sample_depth = $request->input('sample_depth');
        $ucs->visual_classification = $request->input('visual_classification');

        $ucs->mass = $request->input('mass');
        $ucs->diameter = $request->input('diameter');
        $ucs->height = $request->input('height');

        $ucs->can_no = $request->input('can_no');
        $ucs->can_mass = $request->input('can_mass');
        $ucs->candms_mass = $request->input('candms_mass');
        $ucs->candds_mass = $request->input('candds_mass');

        $ucs->records = $records_count;
        $ucs->save();

        $testwork = Testwork::find($testwork->id);
        $testwork->testwork_id = $ucs->id;
        $testwork->save();

        for ($i = 1; $i <= $records_count; $i++) {
            $ucs_detail = new UcsDetail();

            $ucs_detail->user_id = Auth::id();
            $ucs_detail->test_id = Test::where('designation', 'UCS')->first()->id;
            $ucs_detail->ucs_id = $ucs->id;

            $ucs_detail->entry_number = $i;

            $ucs_detail->deformation = $request->input('deformation.' . $i);
            $ucs_detail->load = $request->input('load.' . $i);

            $ucs_detail->save();
        }

        return redirect('/dashboard/testworks');
    }

    // Show testwork
    public function show($id)
    {
        $ucs = ucs::find($id);
        return view('dashboard.testworks.show.ucs')->with('ucs', $ucs);
    }

    // Edit testwork
    public function edit($id)
    {
        $ucs = ucs::find($id);
        return view('dashboard.testworks.edit.ucs')->with('ucs', $ucs);
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

            'mass' => 'required|numeric',
            'diameter' => 'required|numeric',
            'height' => 'required|numeric',

            'can_no' => 'required',
            'can_mass' => 'required|numeric',
            'candms_mass' => 'required|numeric',
            'candds_mass' => 'required|numeric',

            'deformation.*' => 'required|numeric',
            'load.*' => 'required|numeric',
        ]);

        $ucs = Ucs::find($id);
        $ucs->user_id = Auth::id();
        $ucs->test_id = Test::where('designation', 'UCS')->first()->id;

        $ucs->institute = $request->input('institute');
        $ucs->test_date = $request->input('test_date');
        $ucs->tested_by = $request->input('tested_by');
        $ucs->boring_number = $request->input('boring_number');
        $ucs->sample_depth = $request->input('sample_depth');
        $ucs->visual_classification = $request->input('visual_classification');

        $ucs->mass = $request->input('mass');
        $ucs->diameter = $request->input('diameter');
        $ucs->height = $request->input('height');

        $ucs->can_no = $request->input('can_no');
        $ucs->can_mass = $request->input('can_mass');
        $ucs->candms_mass = $request->input('candms_mass');
        $ucs->candds_mass = $request->input('candds_mass');

        $ucs->save();

        $testwork = Testwork::find($ucs->testwork_id);
        $testwork->user_id = Auth::id();
        $testwork->test_id = Test::where('designation', 'UCS')->first()->id;
        $testwork->institute = $request->input('institute');
        $testwork->test_date = $request->input('test_date');
        $testwork->tested_by = $request->input('tested_by');
        $testwork->save();

        foreach ($ucs->ucs_details as $ucs_detail) {
            $i = $ucs_detail->entry_number;

            $ucs_detail->user_id = Auth::id();
            $ucs_detail->test_id = Test::where('designation', 'UCS')->first()->id;
            $ucs_detail->ucs_id = $ucs->id;

            $ucs_detail->deformation = $request->input('deformation.' . $i);
            $ucs_detail->load = $request->input('load.' . $i);

            $ucs_detail->save();
        }

        return redirect('/dashboard/ucs/' . $id . '/show');
    }

    // Delete test work
    public function delete($id)
    {
        $ucs = Ucs::find($id);
        $testwork = Testwork::find($ucs->testwork_id);
        $ucs_details = $ucs->ucs_details;
        foreach ($ucs_details as $detail) {
            $detail->delete();
        }
        $ucs->delete();
        $testwork->delete();
        return redirect('/dashboard/testworks');
    }

    // Analyze testwork
    public function analyze($id)
    {
        // Basic analysis
        $ucs = Ucs::find($id);
        $area = round(($ucs->diameter) ** 2 * pi() / 4, 3);
        $volume = round($ucs->height * $area, 3);
        $wetgama = round($ucs->mass * 9.81 * 1000 / $volume, 3);
        $wc = round(($ucs->candms_mass - $ucs->candds_mass) * 100 / ($ucs->candds_mass - $ucs->can_mass), 3);
        $drygama = round($wetgama / (1 + $wc / 100), 3);
        $basic = [$area, $volume, $wetgama, $wc, $drygama];

        // Test details analysis
        $ucs_details = $ucs->ucs_details;
        foreach ($ucs_details as $i => $detail) {
            $deformation[$i] = $detail->deformation;
            $load[$i] = $detail->load;
            $strain[$i] = round($deformation[$i] * 100 / $ucs->height, 1);
            $stress[$i] = round($load[$i] * 1000 / ($basic[0] / (1 - $deformation[$i] / $ucs->height)), 3);
            $ssplot[$i] = ['x' => $strain[$i], 'y' => $stress[$i]];
        }

        $qu = max($stress);
        $j = 0;
        for ($i = 0; $i <= $qu; $i += $qu / 60) {
            $snplot[$j] = ['x' => $i, 'y' => sqrt(($qu / 2) ** 2 - ($i - ($qu / 2)) ** 2)];
            $j += 1;
        }

        return view('dashboard.testworks.analyze.ucs')->with([
            'ucs' => $ucs,
            'basic' => $basic,
            'deformation' => $deformation,
            'load' => $load,
            'ssplot' => $ssplot,
            'snplot' => $snplot,
            'qu' => $qu,
        ]);
    }

    public function generate_word($id)
    {
        $phpWord = new PhpWord();
        $ucs = Ucs::find($id);
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
        $titlePage->addText('Unconfined Compressive Strength Test Report', 'titlefstyle1', 'titlepstyle1');

        $titlePage->addTextBreak(4);
        $titlePage->addText('Test Details', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $titlePage->addText('Test Date: ' . $ucs->test_date, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Tested By: ' . $ucs->tested_by, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Boring Number: ' . $ucs->boring_number, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Sample Depth: ' . $ucs->sample_depth, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Visual Classification of the Soil: ' . $ucs->visual_classification, array('size' => 12, 'name' => 'Segoe UI Light'));

        $titlePage->addTextBreak(7);
        $titlePage->addText('Prepared by', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $titlePage->addText($ucs->tested_by, array('size' => 12, 'name' => 'Segoe UI Light', 'bold' => true));
        $titlePage->addText($ucs->institute, array('size' => 12, 'name' => 'Segoe UI Light'));
        $titlePage->addText('Date: ' . $ucs->updated_at->format('d/m/Y'), array('size' => 12, 'name' => 'Segoe UI Light'));

        // Main body
        $body = $phpWord->addSection();
        // Test name
        $body->addText('Test name', array('size' => 15));
        $body->addText('Standard Test Method for Unconfined Compressive Strength of Cohesive Soil', 'bodyfstyle1', 'bodypstyle1');
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

        $body->addListItem('This test method covers the determination of the unconfined compressive strength of cohesive soil in the undisturbed, remolded, or compacted condition, using strain-controlled application of the axial load.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('This test method provides an approximate value of the strength of cohesive soils in terms of total stresses.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addListItem('This test method is applicable only to cohesive materials which will not expel or bleed water (water expelled from the soil due to deformation or compaction) during the loading portion of the test and which will retain intrinsic strength after removal of confining pressures, such as clays or cemented soils. Dry and crumbly soils, fissured or varved materials, silts, peats, and sands cannot be tested with this method to obtain valid unconfined compression strength values.', 0, 'bodyfstyle1', 'bodylstyle1', 'bodypstyle1');
        $body->addTextBreak(1);

        $body->addText('Reference', array('size' => 15));
        $body->addText('ASTM D 2166 – 00', 'bodyfstyle1', 'bodypstyle1');
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
        $body->addListItem('Definitions: Refer to Terminology D 653 for standard definitions of terms.', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('Definitions of Terms Specific to This Standard:', 0, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('unconfined compressive strength (qu)—the compressive stress at which an unconfined cylindrical specimen of soil will fail in a simple compression test. In this test method, unconfined compressive strength is taken as the maximum load attained per unit area or the load per unit area at 15 % axial strain, whichever is secured first during the performance of a test.', 1, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
        $body->addListItem('shear strength (su)—for unconfined compressive strength test specimens, the shear strength is calculated to be 1⁄2 of the compressive stress at failure.', 1, 'bodyfstyle1', 'bodylstyle2', 'bodypstyle1');
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
        $body->addListItem('The primary purpose of the unconfined compression test is to quickly obtain the approximate compressive strength of soils that possess sufficient cohesion to permit testing in the unconfined state.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('Samples of soils having slickensided or fissured structure, samples of some types of loess, very soft clays, dry and crumbly soils and varved materials, or samples containing significant portions of silt or sand, or both (all of which usually exhibit cohesive properties), frequently display higher shear strengths when tested in accordance with Test Method D 2850. Also, unsaturated soils will usually exhibit different shear strengths when tested in accordance with Test Method D 2850.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('If both an undisturbed and a remolded test are performed on the same sample, the sensitivity of the material can be determined. This method of determining sensitivity is suitable only for soils that can retain a stable specimen shape in the remolded state.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addText('NOTE 2—For soils that will not retain a stable shape, a vane shear test or Test Method D 2850 can be used to determine sensitivity.', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('NOTE 3—The quality of the result produced by this standard is dependent on the competence of the personnel performing it, and the suitability of the equipment and facilities used.', 'bodyfstyle1', 'bodypstyle1');
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
        $body->addListItem('Compression device, Load and deformation dial gauges, Sample trimming equipment, Balance, Moisture can.', 0, 'bodyfstyle1', 'bodylstyle7', 'bodypstyle1');
        $body->addTextBreak(1);
        $body->addImage('http://labapp.net/storage/apparatus/ucs/1.png', array('width' => 450));
        $body->addTextBreak(1);
        $body->addImage('http://labapp.net/storage/apparatus/ucs/2.png', array('width' => 450));
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
        $body->addListItem('Specimen Size—Specimens shall have a minimum diameter of 30 mm (1.3 in.) and the largest particle contained within the test specimen shall be smaller than one tenth of the specimen diameter. For specimens having a diameter of 72 mm (2.8 in.) or larger, the largest particle size shall be smaller than one sixth of the specimen diameter. If, after completion of a test on an undisturbed specimen, it is found, based on visual observation, that larger particles than permitted are present, indicate this information in the remarks section of the report of test data (Note 5). The height-to-diameter ratio shall be between 2 and 2.5. Determine the average height and diameter of the test specimen using the apparatus specified in 5.4. Take a minimum of three height measurements (120° apart), and at least three diameter measurements at the quarter points of the height.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addText('NOTE 5—If large soil particles are found in the specimen after testing, a particle-size analysis performed in accordance with Method D 422 may be performed to confirm the visual observation and the results provided with the test report.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Undisturbed Specimens—Prepare undisturbed specimens from large undisturbed samples or from samples secured in accordance with Practice D 1587 and preserved and transported in accordance with the practices for Group C samples in Practices D 4220. Tube specimens may be tested without trimming except for the squaring of ends, if conditions of the sample justify this procedure. Handle specimens carefully to prevent disturbance, changes in cross section, or loss of water content. If compression or any type of noticeable disturbance would be caused by the extrusion device, split the sample tube lengthwise or cut it off in small sections to facilitate removal of the specimen without disturbance. Prepare carved specimens without disturbance, and whenever possible, in a humiditycontrolled room. Make every effort to prevent any change in water content of the soil. Specimens shall be of uniform circular cross section with ends perpendicular to the longitudinal axis of the specimen. When carving or trimming, remove any small pebbles or shells encountered. Carefully fill voids on the surface of the specimen with remolded soil obtained from the trimmings. When pebbles or crumbling result in excessive irregularity at the ends, cap the specimen with a minimum thickness of plaster of paris, hydrostone, or similar material. When sample condition permits, a vertical lathe that will accommodate the total sample may be used as an aid in carving the specimen to the required diameter. Where prevention of the development of appreciable capillary forces is deemed important, seal the specimen with a rubber membrane, thin plastic coatings, or with a coating of grease or sprayed plastic immediately after preparation and during the entire testing cycle. Determine the mass and dimensions of the test specimen. If the specimen is to be capped, its mass and dimensions should be determined before capping. If the entire test specimen is not to be used for determination of water content, secure a representative sample of trimmings for this purpose, placing them immediately in a covered container. The water content determination shall be performed in accordance with Test Method D 2216.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Remolded Specimens—Specimens may be prepared either from a failed undisturbed specimen or from a disturbed sample, providing it is representative of the failed undisturbed specimen. In the case of failed undisturbed specimens, wrap the material in a thin rubber membrane and work the material thoroughly with the fingers to assure complete remolding. Avoid entrapping air in the specimen. Exercise care to obtain a uniform density, to remold to the same void ratio as the undisturbed specimen, and to preserve the natural water content of the soil. Form the disturbed material into a mold of circular cross section having dimensions meeting the requirements of 6.1. After removal from the mold, determine the mass and dimensions of the test specimens.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addListItem('Compacted Specimens—Specimens shall be prepared to the predetermined water content and density prescribed by the individual assigning the test (Note 6). After a specimen is formed, trim the ends perpendicular to the longitudinal axis, remove from the mold, and determine the mass and dimensions of the test specimen.', 0, 'bodyfstyle1', 'bodylstyle4', 'bodypstyle1');
        $body->addText('NOTE 6—Experience indicates that it is difficult to compact, handle, and obtain valid results with specimens that have a degree of saturation that is greater than 90 %.', 'bodyfstyle1', 'bodypstyle1');
        $body->addTextBreak(1);
        
        $phpWord->addNumberingStyle('bodylstyle5', array(
            'type' => 'multilevel',
            'levels' => array(
                array(
                    'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360,
                ),
                array('format' => 'decimal', 'text' => '%1.%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            )));
        $body->addText('Procedure', array('size' => 15));
        $body->addListItem('Place the specimen in the loading device so that it is centered on the bottom platen. Adjust the loading device carefully so that the upper platen just makes contact with the specimen. Zero the deformation indicator. Apply the load so as to produce an axial strain at a rate of 1⁄2 to 2 %/min. Record load, deformation, and time values at sufficient intervals to define the shape of the stress-strain curve (usually 10 to 15 points are sufficient). The rate of strain should be chosen so that the time to failure does not exceed about 15 min (Note 7). Continue loading until the load values decrease with increasing strain, or until 15 % strain is reached. The rate of strain used for testing sealed specimens may be decreased if deemed desirable for better test results. Indicate the rate of strain in the report of the test data. Determine the water content of the test specimen using the entire specimen, unless representative trimmings are obtained for this purpose, as in the case of undisturbed specimens. Indicate on the test report whether the water content sample was obtained before or after the shear test.', 0, 'bodyfstyle1', 'bodylstyle5', 'bodypstyle1');
        $body->addText('NOTE 7—Softer materials that will exhibit larger deformation at failure should be tested at a higher rate of strain. Conversely, stiff or brittle materials that will exhibit small deformations at failure should be tested at a lower rate of strain.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Make a sketch, or take a photo, of the test specimen at failure showing the slope angle of the failure surface if the angle is measurable.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
        $body->addListItem('A copy of a example data sheet is included in Appendix X1. Any data sheet can be used, provided the form contains all the required data.', 0, 'bodyfstyle1', 'bodylstyle3', 'bodypstyle1');
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
        $body->addListItem('Calculate the axial strain, e1, to the nearest 0.1 %, for a given applied load, as follows:', 0, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('ε1 = ΔL/L0', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('ΔL = length change of specimen as read from deformation indicator, mm (in.), and', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('L0 = initial length of test specimen, mm (in).', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Calculate the average cross-sectional area, A, for a given applied load, as follows:', 0, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('A = A0/(1 - ε1)', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('A0 = initial average cross-sectional area of the specimen, mm 2(in. 2), and', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('ε1 = axial strain for the given load, %.', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Calculate the compressive stress, sc, to three significant figures, or nearest 1 kPa (0.01 ton/ft 2), for a given applied load, as follows:', 0, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('σc = (P/A)', 'bodyfstyle1', array('align'=>'center'));
        $body->addText('where:', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('P = given applied load, kPa (ton/ft 2),', 'bodyfstyle1', 'bodypstyle1');
        $body->addText('A = corresponding average cross-sectional area mm 2(in. 2).', 'bodyfstyle1', 'bodypstyle1');
        $body->addListItem('Graph—If desired, a graph showing the relationship between compressive stress (ordinate) and axial strain (abscissa) may be plotted. Select the maximum value of compressive stress, or the compressive stress at 15 % axial strain, whichever is secured first, and report as the unconfined compressive strength, qu. Whenever it is considered necessary for proper interpretation, include the graph of the stress-strain data as part of the data reported.', 0, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addListItem('If the undisturbed and remolded compressive strengths are remolded, determine the sensitivity, ST, is calculated as follows:', 0, 'bodyfstyle1', 'bodylstyle6', 'bodypstyle1');
        $body->addText('ST = qu (undisturbed specimen)/qu (remolded specimen)', 'bodyfstyle1', array('align'=>'center'));
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
        $dataSheet->addText('Unconfined Compressive Strength Test Data Sheet', 'datafstyle1', 'datapstyle1');
        $dataSheet->addLine(['weight' => 1, 'width' => 460, 'height' => 0]);

        $dataSheet->addText('Date Tested: ' . $ucs->test_date, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Tested By: ' . $ucs->tested_by, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Boring Number: ' . $ucs->boring_number, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Sample Depth: ' . $ucs->sample_depth, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Visual Classification of the Soil: ' . $ucs->visual_classification, array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addTextBreak(1);

        $dataSheet->addText('Sample Data', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ));
        $dataSheet->addText('Diameter (d): ' . $ucs->diameter.' mm', array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Length (L0): ' . $ucs->height.' mm', array('size' => 12, 'name' => 'Segoe UI Light'));
        $dataSheet->addText('Mass: ' . $ucs->mass.' gm', array('size' => 12, 'name' => 'Segoe UI Light'));

        $dataSheet->addText('Table 1: Moisture Content determination', 'bodyfstyle1', 'datapstyle1');
        $tableStyle = array('borderColor' => '555555', 'cellMargin' => 75, 'borderSize' => 2, 'align' => 'center');
        $cellStyle = array('valign' => 'center');
        $table = $dataSheet->addTable($tableStyle);
        $row1 = $table->addRow();
        $row1->addCell(4000, $cellStyle)->addText('Can Number', 'bodyfstyle1', 'datapstyle2');
        $row1->addCell(3000, $cellStyle)->addText($ucs->can_no, 'bodyfstyle1', 'datapstyle2');
        $row2 = $table->addRow();
        $row2->addCell(4000, $cellStyle)->addText('Mass of empty can (grams)', 'bodyfstyle1', 'datapstyle2');
        $row2->addCell(3000, $cellStyle)->addText($ucs->can_mass, 'bodyfstyle1', 'datapstyle2');
        $row3 = $table->addRow();
        $row3->addCell(4000, $cellStyle)->addText('Mass of can and moist soil (grams)', 'bodyfstyle1', 'datapstyle2');
        $row3->addCell(3000, $cellStyle)->addText($ucs->candms_mass, 'bodyfstyle1', 'datapstyle2');
        $row4 = $table->addRow();
        $row4->addCell(4000, $cellStyle)->addText('Mass of can and dry soil (grams)', 'bodyfstyle1', 'datapstyle2');
        $row4->addCell(3000, $cellStyle)->addText($ucs->candds_mass, 'bodyfstyle1', 'datapstyle2');
        $row5 = $table->addRow();
        $row5->addCell(4000, $cellStyle)->addText('Mass of soil solids (grams)', 'bodyfstyle1', 'datapstyle2');
        $row5->addCell(3000, $cellStyle)->addText($ucs->candds_mass - $ucs->can_mass, 'bodyfstyle1', 'datapstyle2');
        $row6 = $table->addRow();
        $row6->addCell(4000, $cellStyle)->addText('Mass of pore water (grams)', 'bodyfstyle1', 'datapstyle2');
        $row6->addCell(3000, $cellStyle)->addText($ucs->candms_mass - $ucs->candds_mass, 'bodyfstyle1', 'datapstyle2');
        $row7 = $table->addRow();
        $row7->addCell(4000, $cellStyle)->addText('Water content (%)', 'bodyfstyle1', 'datapstyle2');
        $wc = round(($ucs->candms_mass - $ucs->candds_mass) * 100 / ($ucs->candds_mass - $ucs->can_mass), 3);
        $row7->addCell(3000, $cellStyle)->addText($wc, 'bodyfstyle1', 'datapstyle2');
        $dataSheet->addTextBreak(1);

        $area = round(($ucs->diameter) ** 2 * pi() / 4, 3);
        $volume = round($ucs->height * $area, 3);
        $wetgama = round($ucs->mass * 9.81 * 1000 / $volume, 3);
        $drygama = round($wetgama / (1 + $wc / 100), 3);

        $dataSheet->addText('Area (A0) = π x ' . $ucs->diameter.' x '. $ucs->diameter. '/4 = '. $area. ' mm2', 'bodyfstyle1');
        $dataSheet->addText('Volume = π x ' . $ucs->diameter.' x '. $ucs->diameter. '/4 = '. $volume. ' mm3', 'bodyfstyle1');
        $dataSheet->addText('Wet Unit Weight = '.$ucs->mass.' x 9.81 x 1000 / '. $volume. ' = '. $wetgama. ' kN/m3', 'bodyfstyle1');
        $dataSheet->addText('Dry Unit Weight = '.$wetgama.'/(1 + '.$wc.'/100) = '. $drygama. ' kN/m3', 'bodyfstyle1');
        $dataSheet->addTextBreak(4);

        $dataSheet->addText('Table 2: Unconfined Compression Test Data', 'bodyfstyle1', 'datapstyle1');
        $table = $dataSheet->addTable($tableStyle);
        $row1Style = array('bgColor' => 'a6c1dd', 'valign' => 'center');
        $row1 = $table->addRow();
        $row1->addCell(1000, $row1Style)->addText('No.', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Sample Deformation (mm)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(2000, $row1Style)->addText('Strain', 'datafstyle2', 'datapstyle2');
        $row1->addCell(2000, $row1Style)->addText('% Strain', 'datafstyle2', 'datapstyle2');
        $row1->addCell(4000, $row1Style)->addText('Corrected Area (mm2)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Load (N)', 'datafstyle2', 'datapstyle2');
        $row1->addCell(3000, $row1Style)->addText('Stress (kPa)', 'datafstyle2', 'datapstyle2');
        $ucs_details = $ucs->ucs_details;
        foreach ($ucs_details as $i => $detail) {
            $deformation[$i] = $detail->deformation;
            $strain[$i] = round($deformation[$i] / $ucs->height, 4);
            $pstrain[$i] = $strain[$i] * 100;
            $carea[$i] = round($area/(1-$deformation[$i]/$ucs->height),3);
            $load[$i] = $detail->load;
            $stress[$i] = round($load[$i] * 1000 / $carea[$i], 3);
        }
        for ($i = 0; $i < count($load); $i++) { 
            $row[$i] = $table->addRow();
            $row[$i]->addCell(1000, $cellStyle)->addText($i+1, 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(5000, $cellStyle)->addText($deformation[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(2000, $cellStyle)->addText($strain[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(2000, $cellStyle)->addText($pstrain[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(3000, $cellStyle)->addText($carea[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(2000, $cellStyle)->addText($load[$i], 'bodyfstyle1', 'datapstyle2');
            $row[$i]->addCell(2000, $cellStyle)->addText($stress[$i], 'bodyfstyle1', 'datapstyle2');
        }

        // Images
        $dataSheet->addTextBreak(3);
        $dataSheet->addText('COPY THE STRESS VS STRAIN PLOT FROM THE BROWSER AND PASTE IT HERE', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('Figure 1: Stress vs Strain Plot', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(3);
        $dataSheet->addText('COPY THE SHEAR VS NORMAL STRESS PLOT FROM THE BROWSER AND PASTE IT HERE', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('Figure 2: Shear vs Normal Stress Plot', 'bodyfstyle1', 'datapstyle1');
        $dataSheet->addTextBreak(2);
        $dataSheet->addText('From the stress vs strain curve and Mohr circle:', array(
            'size' => 12, 'italic' => true, 'name' => 'Segoe UI Light', 'underline' => 'single',
        ), 'bodypstyle1');
        $qu = max($stress);
        $dataSheet->addText('Unconfined Compressive Strength (qu) = '.round($qu,1).' kPa', 'datafstyle2', 'bodypstyle1');
        $dataSheet->addText('Cohesion = '.round($qu/2,1).' kPa', 'datafstyle2', 'bodypstyle1');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('UCS Test Report.docx');
        return response()->download(public_path('UCS Test Report.docx'))->deleteFileAfterSend(true);
    }
}
