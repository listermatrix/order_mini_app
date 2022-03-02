<?php

namespace App\Http\Controllers\TRANS;

use App\Applicant;
use App\DataTables\ReportDataTable;
use App\MscPersonalInformation;
use App\UnderGraduatePersonalInfo;
//use Barryvdh\DomPDF\PDF;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function index(ReportDataTable $report)
    {
        Auth::user()->log("OPENED REPORT WINDOW");
        return $report->render('report.index');
    }

    public function generate(Request $request)
    {
        if($request->isMethod('POST')):

            $request->validate([
                'from' => 'required',
                'to' => 'required'
            ]);

            $from = $request->input('from');
            $to = $request->input('to');

            $from = Carbon::parse($from);
            $to = Carbon::parse($to);

            session(['to'=>$to,'from'=>$from]);

            $total = Applicant::query()->whereBetween('created_at',[$from,$to])->get()->count();

            $msc  = Applicant::query()
            ->join('admission_types','applicants.request_code','admission_types.request_code')
            ->where('admission_types.type','masters')
            ->whereBetween('applicants.created_at',[$from,$to])->get()->count();


            $under  = Applicant::query()
                ->join('admission_types','applicants.request_code','admission_types.request_code')
                ->where('admission_types.type','undergraduate')
                ->whereBetween('applicants.created_at',[$from,$to])->get()->count();

            $diploma = Applicant::query()
                ->join('admission_types','applicants.request_code','admission_types.request_code')
                ->where('admission_types.type','diploma')
                ->whereBetween('applicants.created_at',[$from,$to])->get()->count();


            $underPerson =  UnderGraduatePersonalInfo::query()
                ->join('admission_types','under_graduate_personal_infos.request_code','admission_types.request_code')
                ->where('admission_types.type','undergraduate')
                ->whereBetween('under_graduate_personal_infos.created_at',[$from,$to])->get();

            $mscPerson = MscPersonalInformation::query()
                ->join('admission_types','msc_personal_informations.request_code','admission_types.request_code')
                ->where('admission_types.type','undergraduate')->whereBetween('msc_personal_informations.created_at',[$from,$to])->get();

            $diplomaPerson = UnderGraduatePersonalInfo::query()
                ->join('admission_types','under_graduate_personal_infos.request_code','admission_types.request_code')
                ->where('admission_types.type','diploma')
                ->whereBetween('under_graduate_personal_infos.created_at',[$from,$to])->get();


//            dd($diploma,$mscPerson);


            return view ('report.report',compact('from','to','total','msc','under','mscPerson','diploma','underPerson','diplomaPerson'));
        endif;

        return view('report.generate');
    }


    public  function print()
    {
        Auth::user()->log("OPENED PRINT WINDOW");

        $from = session()->get('from');
        $to = session()->get('to');


        $total = Applicant::query()
            ->join('admission_types','applicants.request_code','admission_types.request_code')
            ->whereBetween('applicants.created_at',[$from,$to])->get()->count();

        $msc  = Applicant::query()
            ->join('admission_types','applicants.request_code','admission_types.request_code')
            ->where('admission_types.type','masters')
            ->whereBetween('applicants.created_at',[$from,$to])->get()->count();


        $under  = Applicant::query()
            ->join('admission_types','applicants.request_code','admission_types.request_code')
            ->where('admission_types.type','undergraduate')
            ->whereBetween('applicants.created_at',[$from,$to])->get()->count();

        $diploma = Applicant::query()
            ->join('admission_types','applicants.request_code','admission_types.request_code')
            ->where('admission_types.type','diploma')
            ->whereBetween('applicants.created_at',[$from,$to])->get()->count();


        $underPerson =  UnderGraduatePersonalInfo::query()
            ->join('admission_types','under_graduate_personal_infos.request_code','admission_types.request_code')
            ->where('admission_types.type','undergraduate')
            ->whereBetween('under_graduate_personal_infos.created_at',[$from,$to])->get();

        $mscPerson = MscPersonalInformation::query()
            ->join('admission_types','msc_personal_informations.request_code','admission_types.request_code')
            ->where('admission_types.type','undergraduate')->whereBetween('msc_personal_informations.created_at',[$from,$to])->get();

        $diplomaPerson = UnderGraduatePersonalInfo::query()
            ->join('admission_types','under_graduate_personal_infos.request_code','admission_types.request_code')
            ->where('admission_types.type','diploma')
            ->whereBetween('under_graduate_personal_infos.created_at',[$from,$to])->get();



//        $pdf = PDF::loadView('report.print2',
//            [
//
//                'total' => $total,
//                'msc' => $msc,
//                'under' => $under,
//                'mscPerson' => $mscPerson,
//                'diploma' => $diploma,
//                'underPerson' => $underPerson,
//                'diplomaPerson' => $diplomaPerson
//            ]
//        );
//
//
//        $pdf->setTimeout(60);
//        $pdf->save(storage_path('reports/'.'AdmissionReport.pdf'));

//        return $pdf->download('AdmissionReport.pdf');


        return view('report.print2',[

            'total'         => $total,
            'msc'           => $msc,
            'under'         => $under,
            'mscPerson'     => $mscPerson,
            'diploma'       => $diploma,
            'underPerson'   => $underPerson,
            'diplomaPerson' => $diplomaPerson
        ]);
    }
}
