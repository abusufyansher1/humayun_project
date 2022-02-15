<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Student_info;
use App\Models\student_enrollment;
use App\Models\Teacher_info;
use App\Models\Designation;
use App\Models\Employment_type;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Conducted_exam;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
function test()
{
    $std_id=session('userid');
    $result=DB::table('results')->get;
    return $result;
}
       
    Protected function index()
    { 
    $std_id=session('userid');
    $role=session('role');
       $student_info=Student_info::join('users','users.id','=','student_infos.std_id')
                                    ->where('users.id','=',$std_id)->first();
      


       $subjects=DB::table('student_enrollments')
                                ->join('subjects','subjects.class_id','=','student_enrollments.class_id')
                                ->where('student_enrollments.std_id','=',$std_id);
        $conducted_exams=DB::table('student_enrollments')
                                ->join('subjects','subjects.class_id','=','student_enrollments.class_id')
                                ->join('conducted_exams','conducted_exams.subject_id','=','subjects.subject_id')
                                ->where('student_enrollments.std_id','=',$std_id);
       
        $get_enrol_class=$this->get_enrol_class($std_id)->first();
         $class_id=    $get_enrol_class->class_id;
         $enrol_class=    $get_enrol_class->class;           
        $classmates=DB::table('student_enrollments')
                        ->where('class_id','=',$class_id);

        return view('student/index',['student_info'=> $student_info,'enrol_class'=>$enrol_class,'classmates'=>$classmates,'subjects'=>$subjects,'conducted_exams'=>$conducted_exams]);
    }
    function  get_enrol_class($std_id)
    {
        $get_enrol_class=DB::table('student_enrollments')
        ->select('student_enrollments.class_id','classes.class')  
        ->join('classes','classes.class_id','student_enrollments.class_id')        
        ->where('student_enrollments.std_id','=',$std_id); 
        return  $get_enrol_class;
    }
    function get_subjects()
    {
        $std_id=session('userid');
       
      $get_enrol_class=  $this->get_enrol_class($std_id)->first();
        $class_id=    $get_enrol_class->class_id;
      $subjects=  Subject::select('subjects.credit','subjects.subject','users.name','subjects.subject_id')
                        ->join('users','users.id','=','subjects.faculty_id')
                        ->where('subjects.class_id', $class_id)->get();
        
      return view('student/subjects',['subjects'=>$subjects]);

    }
    function conducted_exams_by_subject($subject_id)
    {
        $std_id=session('userid');
  
        if($subject_id==0)
        {
            $conducted_exams=DB::table('student_enrollments')
                                ->select('subjects.credit','users.name','subjects.subject','conducted_exams.id as c_exam_id','exams.exam')
                                ->join('subjects','subjects.class_id','=','student_enrollments.class_id')
                                ->join('conducted_exams','conducted_exams.subject_id','=','subjects.subject_id')
                                ->join('exams','exams.id','=','conducted_exams.exam_id')
                                ->join('users','users.id','=','subjects.faculty_id')
                                ->where('student_enrollments.std_id','=',$std_id);
            
        }
        else
        {
            $conducted_exams=DB::table('conducted_exams')
            ->select('subjects.credit','users.name','subjects.subject','conducted_exams.id as c_exam_id','exams.exam')
            ->join('subjects','subjects.subject_id','=','conducted_exams.subject_id')
            ->join('exams','exams.id','=','conducted_exams.exam_id')
             ->join('users','users.id','=','subjects.faculty_id')
            ->where('subjects.subject_id',$subject_id);
        }
        return $conducted_exams;
    }
    function get_exams($subject_id)
    {
        $conducted_exam=$this->conducted_exams_by_subject($subject_id)->get();
        return view('student/exams',['conducted_exam'=>$conducted_exam]);
    }
    function get_result_by_c_exam($conducted_exam_id)
    {
        // $data=['c_exam_id'=>$conducted_exam_id];
        // Validator::make($data,['c_exam_id'=>['required','numeric']]);
        $std_id=session('userid');
        $result=Result::where('std_id', $std_id)
        ->join('conducted_exams','conducted_exams.id','=','results.c_exam_id')
        ->where('results.c_exam_id','=',$conducted_exam_id)
        ->where('conducted_exams.published_status',1);
        return $result;
    }
}
