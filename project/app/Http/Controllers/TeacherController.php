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


class TeacherController extends Controller
{
    Protected function index()
    { 
    $faculty_id=session('userid');
    $role=session('role');
       $faculty_info=Teacher_info::join('users','users.id','=','teacher_infos.user_id')
                                    ->where('users.id','=',$faculty_id)->first();
      


         $subjects = $this->get_subjects();
       $conducted_exams=$this->  exam_conducted_class(0);
       

        return view('faculty/index',['faculty_info'=> $faculty_info,'subjects'=>$subjects,'conducted_exams'=>$conducted_exams]);
    }
    function get_subjects()
    {
        $faculty_id=session('userid');
        $subjects=Subject::select('subjects.credit','subjects.subject_id','subjects.subject','classes.class')->join('classes','classes.class_id','=','subjects.class_id')
       ->where('subjects.faculty_id','=',$faculty_id);
        return  $subjects;
    }
    function subjects()
    {
        $subjects = $this->get_subjects()->get();
    //    return $subjects;
    return  view('faculty/subjects',['subjects'=> $subjects]);  
    }
    function exam_conducted_class($class_id)
    {
        $faculty_id=session('userid');
        if($class_id==0)
        {
            $conducted_exams=Conducted_exam::select('conducted_exams.id as c_exam_id','subjects.subject','classes.class','exams.exam')
            ->join('subjects','subjects.subject_id','=','conducted_exams.subject_id')
            ->join('exams','exams.id','=','conducted_exams.exam_id')
            ->join('classes','classes.class_id','=','subjects.class_id')
            ->where('subjects.faculty_id','=',$faculty_id);
        }
        else{
            $conducted_exams=Conducted_exam::select('conducted_exams.id as c_exam_id','subjects.subject','classes.class','exams.exam')
            ->join('subjects','subjects.subject_id','=','conducted_exams.subject_id')
            ->join('exams','exams.id','=','conducted_exams.exam_id')
            ->join('classes','classes.class_id','=','subjects.class_id')
            ->where('subjects.faculty_id','=',$faculty_id)
            ->where('subjects.class_id','=',$class_id);
        }
    return $conducted_exams;
    }
    function conducted_exams_page($req)
    { 
        $faculty_id=session('userid');
        $class_id=0;
       $conducted_exams=  $this-> exam_conducted_class($req)->get();
    //    return $conducted_exams;
   $examtypes= $this ->get_exam_types();
   $subjects= $this ->get_subjects()->get();
      return view('faculty/conducted_exams',['examtypes'=>$examtypes,'conducted_exams'=>$conducted_exams,'subjects'=> $subjects]);

    }
    function get_exam_types()
    {
        $exams=Exam::get();
        return  $exams;
    }
    function conduct_new_exam(Request $req)
    {
        $data= new Conducted_exam;
        $data->exam_id=$req->input('exam_id');
        $data->subject_id=$req->input('subject_id');
        $data->save();
        return redirect('/teacher/conducted_exams/0');
    }
    function result($req)
    {
        $c_exam_id=$req;
       $query= Conducted_exam::select('subjects.class_id')
        ->join('subjects','subjects.subject_id','=','conducted_exams.subject_id')
        ->where('conducted_exams.id','=',$c_exam_id)->first();
        $class_id=$query->class_id;
        $enrol_students=student_enrollment::Select('users.name as stdname','users.id as user_id',)
        ->join('users','users.id','student_enrollments.std_id')
        
        ->where('student_enrollments.class_id',$class_id)->get();
        return view('faculty.result',['enrol_std'=>  $enrol_students,'c_exam_id'=>$c_exam_id]);
    }
    function get_std_result_by_c_exam($c_exam_id,$std_id)
    {
        $query=Result::where('c_exam_id',$c_exam_id)->where('std_id',$std_id);
        return $query;
    }
    function saveresult(Request $req)
    {
        // $data=new Result;
        $no=$req->input('no');
        $c_exam_id=$req->input('c_exam_id');
        $std_ids= $req->input('std_id');
        $marks= $req->input('obtmark');
        
    //    return $req; 
        for($i = 1; $i<=$no;$i++)
        {
       $std_id=$std_ids[$i];
       $obt_marks=$marks[$i];
       $c_exam_id=$c_exam_id;
      
       $data = Result::where('std_id', $std_id)->where('c_exam_id',$c_exam_id)->first();
 
if ($data !== null) {
    $data->update(['obt_marks' => $obt_marks]);
} 
else {
    $data = Result::create([
      'std_id' => $std_id,
      'c_exam_id' => $c_exam_id,
      'obt_marks'=>$obt_marks,
    ]);
}

        }
        if($data)
        {
            session()->flash('data','Data upated');
        }
        else
        {
            session()->flash('data','Internal error occured');
        }
       return redirect('/teacher/result/'.$c_exam_id);
    }

}
