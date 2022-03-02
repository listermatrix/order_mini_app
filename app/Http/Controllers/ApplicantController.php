<?php /** @noinspection PhpUndefinedMethodInspection */

/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\AdmissionStatus;
use App\AdmissionType;
use App\Applicant;
use App\Helpers\Masters;
use App\OtherCourses;
use App\Payment;
use App\ProcessCompleted;
use App\UnderGradEmploymentRecord;
use App\UnderGradHonorAndPledge;
use App\UnderGradQualification;
use App\UnderGradRecommendation;
use App\UnderGradSecSchool;
use App\UnderGradSponsorship;
use App\UnderGradSubjects;
use App\UnderGraduatePersonalInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{

    use Masters;

    public function records(Request $request)
    {
        $code = $request->request_code;

        //1. we will verify the request code
        //2. Determine if the request code already exist.
        //3. if yes, then determine  if the request code belongs to masters or undergraduate or diploma/certificate
        //4 if yes, then redirect to masters or undergraduate respectively



        /****   validate request code  *****/
        $verify  = AdmissionType::query()->where('request_code',$request->request_code)->first();


        //if it is not empty then....
        if(!empty($verify))
        {
            //if not empty then verify the admission type of the request
            $verify2 = AdmissionType::query()->where('request_code' ,$request->request_code)->pluck('type')->first();


            if ($verify2 == 'masters')
            {
                $route= route('applicant.masters.records',['request_code'=>$request->request_code]);

                return redirect($route);
            }



        }

        $admission_type = AdmissionType::query()->where('request_code',$code)->pluck('type')->first();
        $records  = UnderGraduatePersonalInfo::query()->where('request_code',$code)->first();
        $schools  = UnderGradSecSchool::query()->where('request_code',$code)->get();
        $subjects = UnderGradSubjects::query()->where('request_code',$code)->get();
        $qualifications = UnderGradQualification::query()->where('request_code',$code)->get();
        $employment = UnderGradEmploymentRecord::query()->where('request_code',$code)->get();

        $others = OtherCourses::query()->where('request_code',$code)->first();
        $sponsorship = UnderGradSponsorship::query()->where('request_code',$code)->first();
        $honor = UnderGradHonorAndPledge::query()->where('request_code',$code)->first();
        $recommendation = UnderGradRecommendation::query()->where('request_code',$code)->get();
        $payment = Payment::query()->where('request_code',$code)->first();
        $process = ProcessCompleted::query()->where('request_code',$code)->first();


        return view('applicants.index',compact(
            'code','records','schools','sponsorship','recommendation',
                     'subjects','qualifications','others','employment','honor',
                     'payment','admission_type','process'));
    }

    public function index()
    {
        return view('applicants.index');
    }

    public function store_info(Request $request)
    {

        //validation to check required form fields are filled and contain the required data
        //$request->validate  == passing form fields or field_names to to a validation method


         $request->validate([
            'title' => 'required|max:100',
            'surname' => 'required|max:100',
            'first_name' => 'required|max:100',

            'middle_name' => 'required|max:100',
            'dob' => 'required|max:100',
            'passport_pic' => 'sometimes|nullable|image|max:2000',
            'pob' => 'required|max:100',
            'gender' => 'required|max:100',

            'nationality' => 'required|max:100',
            'postal_address' => 'required|max:100',
            'residential_address' => 'required|max:100',
            'mobile_phone' => 'required|max:100',

            'home_phone' => 'required|max:100',
//            'regular_email_address' => 'required|unique:under_graduate_personal_infos|max:100,'.$email->id,
            'regular_email_address' => 'required|max:100',
            'prog_first' => 'required|max:100',
            'prog_second' => 'required|max:100',

            'prog_third' => 'required|max:100',
            'session' => 'required|max:100',
            'source_of_info' => 'required|max:100',
            'pub_or_advert' => 'required|max:100',

        ]);



          $data = request()->all();  //requesting all form fields and pass them to the variable $data.

          /*
           * We first check if the user has already submitted some records or not
           * if  yes, then we update the existing records, if no, then we create the records
           */
          $verify    = UnderGraduatePersonalInfo::query()->where('request_code',$request->request_code)->first();
          $applicant = Applicant::query()->where('request_code',$request->request_code)->first();

          $status =    AdmissionStatus::query()->where('request_code',$request->request_code)->first();

          DB::transaction(function () use ($verify,$applicant,$data,$request,$status){
                //transaction is used to make sure records are committed to the database only when everything
                //is properly processed.
          if($verify && $applicant):

                $data['full_name'] = $verify->getFullName();
                $data['phone_no']  = $data['mobile_phone'];
                $data['email']     = $data['regular_email_address'];

                                // function for uploading image to public folder//
                          if ($request->hasFile('passport_pic')):
                                $code = $request->request_code;
                                $filename = $code.'_'.$request->passport_pic->hashName();
                                $request->passport_pic->storePubliclyAs('public/passport',$filename);

                                //then we delete the old file which was uploaded earlier
                                $old_file = $verify->passport_pic;

                                Storage::delete('public/passport/' . $old_file);
                                $data['passport_pic'] = $filename;  //give the pass_port picture a new name
                          endif;


                //updates the undergraduate personal info table and also update the applicant table
                $verify->update($data);
                $applicant->update($data);
                $status->update(['status'=>'pending']);

          else:

              $update = UnderGraduatePersonalInfo::query()->create($data);

              $data['full_name'] = $update->getFullName();
              $data['phone_no']  = $data['mobile_phone'];
              $data['email']     = $data['regular_email_address'];


              // function for uploading image to public folder//
          $filename = null;
              if ($request->hasFile('passport_pic')):
                  $code = $request->request_code;
                  $filename = $code.'_'.$request->passport_pic->hashName();
                  $request->passport_pic->storePubliclyAs('public/passport',$filename);
              endif;

              $data['passport_pic'] = $filename;

                 Applicant::query()->create($data);
                 AdmissionStatus::query()->create($data);
          endif;

          });
           //if form is successfully filled//
        return redirect()->back()->with('success','Records successfully inserted');
    }

    //for storing schools
    public function store_school(Request $request)
    {
        $request->validate([
            'sch_name' => 'required',
            'subject_name' => 'required',
            'first_sitting' => 'sometimes|nullable',
            'second_sitting' => 'sometimes|nullable',
            'third_sitting' => 'sometimes|nullable',
            'index_number' => 'sometimes|nullable',
            'from' => 'sometimes|nullable|date',
            'to' => 'sometimes|nullable|date',
        ]);

        $data = request()->all();

        /*
         * the carbon is used to format the incoming date string to pick only the date
         */
        DB::transaction(function() use ($data){

            empty($data['from']) ? $data['from'] = 'N/A' :  $data['from'] = Carbon::parse($data['from'])->format('Y');
            empty($data['to']) ? $data['to'] = 'N/A' :  $data['to'] = Carbon::parse($data['to'])->format('Y');

            UnderGradSecSchool::query()->create($data);

        });

        return redirect()->back()->with('success','Records successfully inserted');

    }

    //for editing schools attended
    public function school_edit($id)
    {
        $school = UnderGradSecSchool::query()->find($id);
        $data = request()->all();

        empty($data['from']) ? $data['from'] = 'N/A' :  $data['from'];
        empty($data['to']) ? $data['to'] = 'N/A' :  $data['from'];

        DB::transaction(function () use ($school, $data){
            $school->update($data);
        });

        return redirect()->back()->with('success','School(s) successfully updated');
    }

    //for storing subjects
    public function store_subject(Request $request)
    {

        $request->validate([
            'subject_name' => 'required',
            'first_sitting' => 'required',
            'second_sitting' => 'required',
            'index_number' => 'required',
        ]);
        $data = request()->all();

        DB::transaction(function () use ($data){
            UnderGradSubjects::query()->create($data);
        });
        return redirect()->back()->with('success','Subject successfully inserted');
    }

    public function subject_edit(Request $request,$id)
    {
        $request->validate([
            'subject_name' => 'required',
            'first_sitting' => 'required',
            'second_sitting' => 'required',
            'index_number' => 'required',
        ]);
        $subject = UnderGradSubjects::query()->find($id);
        $data = request()->all();
        DB::transaction(function () use ($subject, $data){
            $subject->update($data);
        });

        return redirect()->back()->with('success','Subject successfully updated');
    }

    public function store_qualification(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'from' => 'sometimes|nullable|date',
            'to' => 'sometimes|nullable|date',

        ]);
        $data = request()->all();


        empty($data['from']) ? $data['from'] = Carbon::parse('0000-01-12')->format('Y'):  $data['from'] = Carbon::parse($data['from'])->format('Y');
        empty($data['to']) ? $data['to'] =  Carbon::parse('0000-01-12')->format('Y') :  $data['to'] = Carbon::parse($data['to'])->format('Y');

        DB::transaction(function () use ($data){
//            $data['from']  = Carbon::parse($data['from'])->format('Y');
//            $data['to'] = Carbon::parse($data['to'])->format('Y');



            UnderGradQualification::query()->create($data);
        });
        return redirect()->back()->with('success','Records Successfully Inserted');
    }

    public function qualification_edit(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'from' => 'required|numeric',
             'to'  => 'required|numeric',
        ]);

        $data = request()->all();
        $verify = UnderGradQualification::query()->find($id);

        DB::transaction(function () use ($data,$verify){
            $verify->update($data);
        });
        return redirect()->back()->with('success','Records Successfully Updated');
    }

    public function other_courses(Request $request)
    {
        $request->validate([
            'summary' => 'required|max:500',
        ]);
        $data = request()->all();
        /*
         * We first check if the user has already submitted some records or not
         * if the yes, then we update the existing records, if no, then we create the records
         */
        $verify = OtherCourses::query()->where('request_code',$request->request_code)->first();

        DB::transaction(function () use ($verify,$data){

            if($verify):

                $verify->update($data);
            else:

                OtherCourses::query()->create($data);
            endif;

        });

        return redirect()->back()->with('success','Records successfully inserted');
    }



     public function store_employment_records(Request $request)
     {
         $request->validate([
            'organization'=>'required',
            'position'=>'required',
            'salary'=>'required',
         ]);

         $data = $request->all();
         DB::transaction(function () use ($data){

             empty($data['from']) ? $data['from'] = 'N/A' :  $data['from'] = Carbon::parse($data['from'])->format('Y');
             empty($data['till']) ? $data['till'] = 'N/A' :  $data['till'] = Carbon::parse($data['till'])->format('Y');

            UnderGradEmploymentRecord::query()->create($data);
         });

         return redirect()->back()->with('success','Records Successfully Inserted');
     }

     public function employment_records_edit(Request $request,$id)
     {
         $request->validate([
             'from'=>'required|numeric',
             'till'=>'required|numeric',
             'organization'=>'required',
             'position'=>'required',
             'salary'=>'required',
         ]);

         $data = $request->all();
         $verify = UnderGradEmploymentRecord::query()->find($id);
         DB::transaction(function () use ($verify, $data){
             $verify->update($data);
         });

      return   redirect()->back()->with('success','Records Successfully Updated');
     }

     public function store_sponsorships(Request $request)
     {
             $request->validate([

                 'relationship_of_sponsor' => 'required|max:100',
                 'name_of_sponsor' => 'required|max:100',
                 'nationality' => 'required|max:100',

                 'address_of_sponsor' => 'required|max:100',
                 'phone_no_of_sponsor' => 'required|max:100',
                 'email_of_sponsor' => 'required|max:100',
                 'country_of_sponsor' => 'required|max:100',
                 'is_english' => 'required|max:100',

                 'is_english_studies' => 'required|max:100',

                 'medical_condition' => 'required|max:255',
//                 'medical_condition_description' => 'required|max:255',

                 'study_reason' => 'required|max:255',
                 'impression' => 'required|max:255',
                 'achievement' => 'required|max:255',

         ]);

         $data = $request->all();

         $verify    = UnderGradSponsorship::query()->where('request_code',$request->request_code)->first();

         DB::beginTransaction();
            if($verify):


                if ($request->hasFile('certificate')):
                    $code = $request->request_code;

                    $filename = $code.'_'.$request->certificate->hashName();
                    $request->certificate->storePubliclyAs('public/certificate',$filename);

                    //then we delete the old file which was uploaded earlier
                    $old_file = $verify->passport_pic;

                    Storage::delete('public/certificate/' . $old_file);
                    $data['certificate'] = $filename;  //give the pass_port picture a new name
                endif;
                $verify->update($data);
            else:
                if ($request->hasFile('certificate')):
                    $code = $request->request_code;

                    $filename = $code.'_'.$request->certificate->hashName();
                    $request->certificate->storePubliclyAs('public/certificate',$filename);
                    $data['certificate'] = $filename;  //give the pass_port picture a new name
                endif;
                UnderGradSponsorship::query()->create($data);
            endif;

         DB::commit();

         return redirect()->back()->with('success','Records Successfully Inserted');
     }


     public function store_honor_and_pledge(Request $request)
     {
         $verify = UnderGradHonorAndPledge::query()->where('request_code',$request->request_code)->first();

        $request->validate([
            'state' => 'required',
        ]);

        $data = $request->all();
        $status = $data['state'];

        if($status == 1){

            $status = true;
        }
        else{
            $status = false;
        }

        $data['status'] = $status;
        $data['date'] = Carbon::parse(now());

        DB::beginTransaction();
            if($verify):
                $verify->update($data);
            else:
             UnderGradHonorAndPledge::query()->create($data);
            endif;
        DB::commit();

        return redirect()->back()->with('success','Record successfully Inserted');
     }

     public function store_recommendation(Request $request)
     {

        if($request->hasFile('recommendation_file')):
            $file = $request->recommendation_file;

            foreach ($file as $checkMimeType):

                $mime = $checkMimeType->getMimeType();
                /*
                 * Mime type validations here
                 */
                if($mime != 'application/pdf'):
                    return redirect()->back()->withErrors('the file: '.$checkMimeType->getClientOriginalName().' can not be uploaded. Only PDFs are allowed');
                endif;
                endforeach;

                /*
                 * At this point we loop through the submitted images and process them once they pass the first level validation (mime types).
                 */

            foreach ($file as $uploadedform):

                $code = $request->request_code;
                $filename = $code.'_'.$uploadedform->hashName();
                $uploadedform->storePubliclyAs('public/forms/recommendations',$filename);
                $data['request_code'] = $code;
                $data['file_name'] = $filename;
                UnderGradRecommendation::query()->create($data);

            endforeach;

                return redirect()->back()->with('success','File successfully uploaded');

            endif;
            return redirect()->back();
     }

     public function delete_recommendation($id)
     {
         $purge = UnderGradRecommendation::query()->find($id);

         DB::beginTransaction();
         try {
             $purge->delete();
             Storage::delete('public/forms/recommendations/' . $purge->file_name);
         } catch (\Exception $e) {
             return redirect()->back()->withErrors('File: '.$purge->file_name.' could not be deleted !!');
         }
         DB::commit();
         return redirect()->back()->with('success','File: '.$purge->file_name.' successfully deleted');
     }

     public function store_payment(Request $request)
     {
         $request->validate([
             'receipt_no' => 'required',
         ]);

         $code = $request->receipt_no;
         $data = $request->all();
         $data['pay_receipt_no'] = $code;
         $data['bank'] = empty($request->input('bank')) ? 'N/A' : $request->input('bank');
         $data['mobile_number'] = empty($request->input('mobile_number')) ? 'N/A' : $request->input('mobile_number');

         $r_code =$request->request_code;
         $verify = Payment::query()->where('request_code',$r_code)->first();

         $reference = Payment::query()->where('pay_receipt_no',$code)->first();
         if($reference  && $reference->request_code != $r_code)
             return redirect()->back()->withErrors('REFERENCE NUMBER HAS ALREADY BEEN USED !!!');

         DB::beginTransaction();
         if($verify):
             $verify->update($data);
             else:
              $insert = Payment::query()->create($data);
             endif;
         DB::commit();

         return redirect()->back()->with('success',"{$code} successfully inserted");


     }

    public function admission_type(Request $request)
    {
        $request->validate([
            'admission_type' => 'required',
            'request_code' => 'required',
        ]);

        $data = $request->all();
        $data['type'] = $request->admission_type;


        //refer to the comments under Public function Undergraduate Personal Info.

        $verify = AdmissionType::query()->where('request_code',$request->request_code)->first();

        DB::beginTransaction();

        if($verify):


            $verify->update($data);

        else:

           AdmissionType::query()->create($data);


        endif;
        DB::commit();
        if($request->admission_type=='masters')
        {
            $route= route('applicant.masters.records',['request_code'=>$request->request_code]);
        }
        elseif($request->admission_type=='diploma' || $request->admission_type=='undergraduate')
        {
            $route= route('applicant.records',['request_code'=>$request->request_code]);
        }
        else{
            $route = route('app.home');
        }



        return redirect($route)->with('success',"Admission type successfully set to {$data['admission_type']}");



    }

    public function getCode()
    {
        $code = $this->accessCode(6);    //this calls a method called accessCode which takes an integer as a parameter and returns the unique code.
        return response()->json($code);         //returns the access code as json response
    }

    private function accessCode($length)
    {
        /** receives the length as an integer and generates a random code with respect to the length
         * specified then returns the response to be used by another function **/

        $random = substr(str_shuffle(str_repeat($x='0123456789',ceil($length/strlen($x)))),1,$length);
        return $random;
    }

    public function CheckStatus(Request $request)
    {
        $response = AdmissionStatus::query()->where('request_code',$request->input('code'))->first();
        if(!empty($response)):
            $msg = $response->comment;
            $status = $response->status;
        else:
            $msg = null;
            $status = null;
            endif;
            return response()->json(['msg'=>$msg,'status'=>$status]);
    }
}
