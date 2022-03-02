<?php /** @noinspection PhpUndefinedMethodInspection */

namespace App\Http\Controllers\TRANS;

use App\AdmissionStatus;
use App\AdmissionType;
use App\Applicant;
use App\DataTables\UnderGraduateDataTable;
use App\MscPersonalInformation;
use App\Notifications\Alertify;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;

class UndergraduateController extends Controller
{
    public function index(UnderGraduateDataTable $dataTable)
    {
        Auth::user()->log('VIEWED UNDERGRADUATE DETAILS');

        return $dataTable->render('transaction.undergraduate.index');
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




        return view('requests.undergraduate.edit',
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



    public function approval(Request $request,$request_code)
    {
        $request->validate([
            'status'=>'required',
            'comment'=>'sometimes|nullable|max:1000'
        ]);
        $data = $request->all();
        $data['request_code'] = $request_code;
        if($request->input('status') == 'Rejected' && empty($request->input('comment')))
            return redirect()->back()->with(Input::all())->withErrors('REJECTION CAN NOT GO WITHOUT A COMMENT');

        $verify =    AdmissionStatus::query()->where('request_code',$request_code)->first();

        DB::beginTransaction();
            if($verify) //check if request already exist then we update the records
                $verify->update($data);
            else  //else we create the records
                AdmissionStatus::query()->create($data);





        $applicant = Applicant::query()->where('request_code',$request_code)->first();
        //we then push the email

        if(!empty($applicant) && $request->input('status') == 'Rejected'):
            $msg = "Your application for admission has been rejected due to the following reason
            {$request->input('comment')}";
        else:
            $msg = "Your application for admission has been accepted visit our nearest campus to pickup your admission letter";
            $attach ="";
        endif;

        $body ="Hello {$applicant->full_name},
{$msg}";
        $head = "Admission Notice";
        $subject = "Admission Notice";
        $from = 'admission@cli.edu.com';
        $to = $applicant->email;

        Auth::user()->log("{$request->input('status')} APPLICANT REGISTRATION WITH REQUEST CODE ".$request_code);
        DB::commit();
        $this->mail_send($body,$head,$subject,$to,$from);

        return redirect()->back()->with('success',"APPLICANT REGISTRATION SUCCESSFULLY {$request->input('status' )}, APPLICANT HAS BEEN NOTIFIED VIA MAIL");
    }

    private  function mail_send($body, $head,$subject,$to,$from)
    {
        Notification::route('mail', $to)->notify(new Alertify($body, $head, $subject, $from));
    }
}
