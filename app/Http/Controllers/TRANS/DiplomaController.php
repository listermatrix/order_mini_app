<?php /** @noinspection PhpUndefinedMethodInspection */

namespace App\Http\Controllers\TRANS;

use App\AdmissionStatus;
use App\Applicant;
use App\DataTables\DiplomaDataTable;
use App\DataTables\UnderGraduateDataTable;
use App\OtherCourses;
use App\Payment;
use App\UnderGradEmploymentRecord;
use App\UnderGradHonorAndPledge;
use App\UnderGradQualification;
use App\UnderGradRecommendation;
use App\UnderGradSecSchool;
use App\UnderGradSponsorship;
use App\UnderGradSubjects;
use App\UnderGraduatePersonalInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiplomaController extends Controller
{
    public function index(DiplomaDataTable $dataTable)
    {
        Auth::user()->log('VIEWED DIPLOMA DETAILS');

        return $dataTable->render('transaction.diploma.index');
    }


    public function edit(Request $request,$request_code)
    {

        Auth::user()->log('VIEWED DETAILS OF APPLICANT WITH REQUEST CODE '.$request_code);


        $personal_info    = $this->getResult(UnderGraduatePersonalInfo::class,false,$request_code);

        $applicant        =  $this->getResult(Applicant::class,false,$request_code);

        $academic_records = $this->getResult(UnderGradSecSchool::class,true,$request_code);

        $subjects = $this->getResult(UnderGradSubjects::class,true,$request_code);

        $qualifications = $this->getResult(UnderGradQualification::class,true,$request_code);

        $employment = $this->getResult(UnderGradEmploymentRecord::class,true,$request_code);

        $otherCourses =  $this->getResult(OtherCourses::class,false,$request_code);

        $sponsorship = $this->getResult(UnderGradSponsorship::class,false,$request_code);

        $honor = $this->getResult(UnderGradHonorAndPledge::class,false,$request_code);

        $recommendation = $this->getResult(UnderGradRecommendation::class,true,$request_code);

        $payment = $this->getResult(Payment::class,false,$request_code);


//        if(!empty($personal_info) || !empty($applicant) || !empty($academic_records)  || !empty($subjects) || !empty($qualifications)&& !empty($employment)|| !empty($otherCourses)|| !empty($sponsorship) || !empty($honor)|| !empty($recommendation)|| !empty($payment))
//                return redirect()->back()->withErrors('THE APPLICANT WITH REQUEST CODE '.$request_code .' HAS NOT COMPLETED ALL PROCESS REQUIRED FOR REGISTRATION');

        $verify =  $this->getResult(AdmissionStatus::class,false,$request_code);




        return view('requests.diploma.edit',
            compact('personal_info','applicant','verify','request_code','academic_records','subjects','qualifications','otherCourses',
                'employment','honor','recommendation','payment','sponsorship'));
    }


    private function getResult($model,$orMulti,$request_code)
    {

        $product =  ($orMulti == true) ? $model::query()->where('request_code',$request_code)->get() :
            (($orMulti == false) ?
                $model::query()->where('request_code',$request_code)->first() : '');
        return $product;

    }
}
