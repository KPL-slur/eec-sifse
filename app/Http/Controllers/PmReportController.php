<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Headreport;
use App\Models\Expert;
use App\Models\ExpertReport;
use App\Models\PmBodyReport;
use App\Models\Recommendation;
use App\Models\Stock;
use App\Models\ReportImage;

class PmReportController extends Controller
{
    private $rules = ([
        'site_id' => 'required',
        'report_date_start' => 'required',
        'report_date_end' => 'required',

        'radio_general_visual' => 'required',
        'radio_rcms' => 'required',
        'radio_wipe_down' => 'required',
        'radio_inspect_all' => 'required',
        'radio_compressor_visual' => 'required',
        'radio_duty_cycle' => 'required',
        'radio_transmitter_visual' => 'required',
        'radio_receiver_visual' => 'required',
        'radio_stalo_check' => 'required',
        'radio_afc_check' => 'required',
        'radio_mrp_check' => 'required',
        'radio_rcu_check' => 'required',
        'radio_iq2_check' => 'required',
        'radio_antenna_visual' => 'required',
        'radio_inspect_motor' => 'required',
        'radio_clean_slip' => 'required',
        'radio_grease_gear' => 'required',
        'running_time' => 'required',
        'radiate_time' => 'required',
        'hvps_v_0_4us' => 'required',
        'hvps_i_0_4us' => 'required',
        'mag_i_0_4us' => 'required',
        'hvps_v_0_8us' => 'required',
        'hvps_i_0_8us' => 'required',
        'mag_i_0_8us' => 'required',
        'hvps_v_1_0us' => 'required',
        'hvps_i_1_0us' => 'required',
        'mag_i_1_0us' => 'required',
        'hvps_v_2_0us' => 'required',
        'hvps_i_2_0us' => 'required',
        'mag_i_2_0us' => 'required',
        'forward_power' => 'required',
        'reverse_power' => 'required',
        'vswr' => 'required',
        'remark' => 'required',
    ]);
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance_type = "pm";
        $headReports = HeadReport::where('maintenance_type', $maintenance_type)
        //select eecid expertise only
        ->with(array('experts'=>function ($query) {
            $query->where('expert_company', 'Era Elektra Corpora Indonesia');
        }))
        ->get();

        // foreach ($headReports as $hr) {
        //     foreach ($hr->experts as $expert) {
        //         dump($expert->name);
        //     }
        // }
        // dd($headReports);
        
        return view('expert.report.index', compact('headReports', 'maintenance_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $experts = Expert::all();
        // $uniqueCompany = $experts->unique('expert_company');

        // dd($experts);
        return view('expert.report.pm.create');
    }

    /**
     * Rawan akan kesalahan data, Semisal head sudah di store namun pmbodyreport gagal di store
     * akan menyebabkan itegeritas data menjadi rusak, sehingga data yg akan dimasukan setelahnya
     * menjadi error semua. misal akan terjadi sebuah head yg tidak memiliki body.
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        //INSERT HEADREPORT
        Headreport::create([
            'head_id' => $request->head_id,
            'site_id' => $request->site_id,
            'maintenance_type' => 'pm',
            'report_date_start' => $request->report_date_start,
            'report_date_end' => $request->report_date_end,
        ]);

        //INSERT EXPERTREPORT
        foreach ($request->experts as $expert) {
            if ($expert['expert_id']) {
                ExpertReport::create([
                    'head_id' => $request->head_id,
                    'expert_id' => $expert['expert_id'],
                    'role' => $expert['expert_role']
                ]);
            }
        }

        //INSERT NEW EXPERT
        if ($request->manualExperts) {
            foreach ($request->manualExperts as $manualExpert) {
                if ($manualExpert['expert_name']) {
                    Expert::create([
                        'name' => $manualExpert['expert_name'],
                        'nip' => $manualExpert['expert_nip'],
                        'expert_company' => $manualExpert['expert_company'],
                        ]);
                    $expertId = Expert::select('expert_id')->orderByDesc('expert_id')->first()->expert_id; //used to determine the expert_id of this report
                    ExpertReport::create([
                        'head_id' => $request->head_id,
                        'expert_id' => $expertId,
                        'role' => $manualExpert['expert_role']
                    ]);
                }
            }
        }
                
        //INSERT BODY REPORT
        PmBodyReport::create($request->all());

        //INSERT RECOMENDATION
        // cek apakah sudah ada record dengan id yg sama sebelumnya
        $oldRecommendationId = [];
        if ($request->old_recommendation_id) {
            foreach($request->old_recommendation_id as $index => $old_recommendation_id){
                $oldRecommendationId[$index] = $old_recommendation_id;
            }
        }
        if ($request->recommends) {
            foreach ($request->recommends as $index => $recommend) {
                if ($recommend['name']) {
                    //jika iya, maka lakukan update pada record tersebut
                    if($index >= count($oldRecommendationId)) {
                        Recommendation::create([
                            'head_id' => $request->head_id,
                            'name' => $recommend['name'],
                            'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                            'year' => now()->year
                        ]);
                    }
                }
            }
        }

        //INSERT MANUAL RECOMENDATION
        if ($request->manualRecommends) {
            foreach ($request->manualRecommends as $manualRecommend) {
                if ($manualRecommend['name']) {
                    Recommendation::create([
                    'head_id' => $request->head_id,
                    'name' => $manualRecommend['name'],
                    'jumlah_unit_needed' => $manualRecommend['jumlah_unit_needed'],
                    'year' => now()->year
                ]);
                }
            }
        }
        
        //INSERT IMAGE

        return redirect()->route('pm.index')->with('status_success', 'Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headReport = HeadReport::Where('head_id', $id)->first();
        abort_unless($headReport, 404, 'Report not found');

        $pmBodyReport = HeadReport::Where('head_id', $id)->first()->pmBodyReport;
        abort_unless($pmBodyReport, 404, 'Report not found');

        $recommendations = HeadReport::Where('head_id', $id)->first()->recommendations;
        $reportImages = HeadReport::Where('head_id', $id)->first()->reportImages;

        return view('expert.report.pm.show', compact('pmBodyReport', 'headReport', 'recommendations', 'reportImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('expert.report.pm.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //UPDATE HEADREPORT
        Headreport::where('head_id', $request->head_id)
        ->update([
            'site_id' => $request->site_id,
            'report_date_start' => $request->report_date_start,
            'report_date_end' => $request->report_date_end,
        ]);


        //UPDATE EXPERTREPORT
        // cek apakah sudah ada record dengan id yg sama sebelumnya
        $oldExpertReportId = [];
        if ($request->old_expert_report_id) {
            foreach($request->old_expert_report_id as $index => $old_expert_report_id){
                $oldExpertReportId[$index] = $old_expert_report_id;
            }
        }
        foreach ($request->experts as $index => $expert) {
            if ($expert['expert_id']) {
                //jika iya, maka lakukan update pada record tersebut
                if($index < count($oldExpertReportId)) {
                    ExpertReport::where('head_id', $request->head_id)
                    ->where('expert_report_id', $oldExpertReportId[$index])
                    ->update([
                        'head_id' => $request->head_id,
                        'expert_id' => $expert['expert_id'],
                        'role' => $expert['expert_role']
                    ]);
                }
                //jika tidak, buat record baru
                else{
                    ExpertReport::create([
                        'head_id' => $request->head_id,
                        'expert_id' => $expert['expert_id'],
                        'role' => $expert['expert_role']
                    ]);
                }
            }
        }

        //INSERT NEW EXPERT, selalu buat baru
        if ($request->manualExperts) {
            foreach ($request->manualExperts as $manualExpert) {
                if ($manualExpert['expert_name']) {
                    Expert::create([
                        'name' => $manualExpert['expert_name'],
                        'nip' => $manualExpert['expert_nip'],
                        'expert_company' => $manualExpert['expert_company'],
                        ]);
                    $expertId = Expert::select('expert_id')->orderByDesc('expert_id')->first()->expert_id; //used to determine the expert_id of this report
                    ExpertReport::create([
                        'head_id' => $request->head_id,
                        'expert_id' => $expertId,
                        'role' => $manualExpert['expert_role']
                    ]);
                }
            }
        }

        //INSERT BODY REPORT
        // PmBodyReport::where('head_id', $request->head_id)
        // ->update($request->all());
        $input = $request->all();
        $pmBodyReport = PmBodyReport::where('head_id', $request->head_id)->first();
        $pmBodyReport->fill($input)->save();

        //mengambil nilai tahun dari record sebelumnya
        if (Recommendation::select('year')->where('head_id', $request->head_id)->first()) {
            $year = Recommendation::select('year')->where('head_id', $request->head_id)->first()->year;
        } else {
            $year = now()->year;
        }

        //UPDATE RECOMENDATION
        // cek apakah sudah ada record dengan id yg sama sebelumnya
        $oldRecommendationId = [];
        if ($request->old_recommendation_id) {
            foreach($request->old_recommendation_id as $index => $old_recommendation_id){
                $oldRecommendationId[$index] = $old_recommendation_id;
            }
        }
        if ($request->recommends) {
            foreach ($request->recommends as $index => $recommend) {
                if ($recommend['name']) {
                    //jika iya, maka lakukan update pada record tersebut
                    if($index < count($oldRecommendationId)) {
                        Recommendation::where('rec_id', $oldRecommendationId[$index])
                        ->update([
                            'name' => $recommend['name'],
                            'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                            'year' => $year
                        ]);
                    }
                    //jika tidak, buat record baru
                    else{
                        Recommendation::create([
                            'head_id' => $request->head_id,
                            'name' => $recommend['name'],
                            'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                            'year' => $year
                        ]);
                    }
                }
            }
        }

        //INSERT MANUAL RECOMENDATION, selalu buat baru
        if ($request->manualRecommends) {
            foreach ($request->manualRecommends as $manualRecommend) {
                if ($manualRecommend['name']) {
                    Recommendation::create([
                        'head_id' => $request->head_id,
                        'name' => $manualRecommend['name'],
                        'jumlah_unit_needed' => $manualRecommend['jumlah_unit_needed'],
                        'year' => $year
                    ]);
                }
            }
        }

        return redirect()->route('pm.index')->with('status_edit', 'Data Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // $reportImageFiles = ReportImage::where('head_id', $id)->get();
        // foreach ($reportImageFiles as $reportImageFile) {
        //     \Storage::delete('public/'.$reportImageFile->image);
        // }

        HeadReport::destroy($id);
        // ReportImage::where('head_id', $id)->delete();
        // PmBodyReport::where('head_id', $id)->delete();
        // Recommendation::where('head_id', $id)->delete();
        // ExpertReport::where('head_id', $id)->delete();

        return redirect()->route('pm.index')->with('status_delete', 'Data Dihapus');
    }
}
