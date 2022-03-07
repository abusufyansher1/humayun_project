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
use App\Models\Semester;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	Protected function index()
  {
  	return view('admin/index');
  }
	// function test( $req)
	// {
	// 	return $req;
	// }
	function add_class(Request $req)
	{
		$data=	new Classes;
		$data->class=$req->input('class');
		$data->equivallent=$req->input('equal');
		$data->eligibility=$req->input('eligibility');
		$data->save();
		return redirect('/admin/classes');
	}
	function add_course(Request $req)
	{
		$data=	new Subject;
		$data->class_id=$req->input('class_id');
		$data->subject=$req->input('subject');
		$data->faculty_id=$req->input('teacher_id');
		$data->credit=$req->input('credit');
		$data->semester_id=$req->input('semester_id');
		$data->save();
		return redirect('admin/classes');
	}
  
   function get_classes()
  {
  	$data=DB::table('classes')->get();
  	return $data;
  }
   function add_student(Request $req)
  {
  	$data = new User;
  	$data->name=$req->input('name');
  	$data->email=$req->input('email');
  	$data->password=$req->input('password');
  	$data->role='3';
  	$data->save();
  	$last_user_id=	$data->id;
  	$data2= new Student_info;
  	$data2->father_name= $req->input('fname');
  	$data2->address= $req->input('address');
  	$data2->contact= $req->input('contact');
	  $data2->admission_year= $req->input('admission_year');
  	$data2->std_id= $last_user_id;
  	$data2->save();
  	$data3 = new student_enrollment;
  	$data3->class_id= $req->input('class_id');
  	$data3->semester_id= $req->input('semester_id');
  	$data3->std_id= $last_user_id;
  	$data3->save();
	return  redirect('/admin/students');
  }
    function view_students()
  {
  	$data=User::select(DB::raw('DISTINCT(users.id)'),'users.name','student_infos.father_name',
	  'student_infos.admission_year','classes.class')
	  ->join('student_infos','student_infos.std_id','=','users.id')
	  
	  ->join('student_enrollments','student_enrollments.std_id','=','users.id')
	  ->join('classes','classes.class_id','=','student_enrollments.class_id')
	  ->get();
  	// return $data;
  	$classes=$this->get_classes();
	  $semesters=Semester::all();
	//   return $semesters;
  	return view('admin/students',['semesters'=>$semesters,'student_list'=>$data,'classes'=>$classes]);
  }
  
  function get_designations()
  {
  	$data=DB::table('designations')->get();
  	return $data;
  }
  function get_employment_types()
  {
  	$data=DB::table('employment_types')->get();
  	return $data;
  }
  function view_teachers()
  {
  	$data=User::Join('teacher_infos','teacher_infos.user_id','=','users.id')
  		->join('employment_types','employment_types.id','=','teacher_infos.employment_type_id')
  		->join('designations','designations.id','=','teacher_infos.designation_id')
  	  	->where(['users.role'=> '2'])->get();
  	// return $data;
  	$designations=$this->get_designations();
  	$emp_types=$this->get_employment_types();
  	return view('admin/teachers',['teacher_list'=>$data,'designations'=>$designations,'employment_type'=>$emp_types]);
  }
  function add_teacher(Request $req)
  {
  	$data= new User;
  	$data->name=$req->input('name');

  	$data->email=$req->input('email');

  	$data->password=$req->input('password');

  	$data->role='2';
  	$data->save();
    $last_user_id=	$data->id;
  	$data2= new Teacher_info;
  	$data2->user_id=$last_user_id;
  	$data2->qualification=$req->input('qualification');
  	$data2->doj=$req->input('doj');
  	$data2->designation_id=$req->input('designation');
  	$data2->employment_type_id=$req->input('employment_type');
  	$data2->save();

  }
  function get_teachers()
  {
	  $data=DB::table('users')->where('role','=','2')->get();
	  return $data;
  }
  function view_classes()
  {
  	$classes=$this->get_classes();
	  $teachers=$this->get_teachers();
	$semesters=Semester::all();
  	return view('admin/classes',['semesters'=>$semesters,'class_list'=>$classes,'teacher_list'=>$teachers]);

  }
  function get_subjects_by_class($req)
  {
	$subjects=DB::table('subjects')->join('users','users.id','=','subjects.faculty_id')->join('semesters','semesters.id','=','subjects.semester_id')->where('subjects.class_id','=',$req)->get();
	return view('admin/subjects',['subjects'=>$subjects]);
  }
  function view_result(Request $req)
  {
  	$classes=$this->get_classes();
	 $semesters=Semester::get();

  	return view('admin/results',['class_list'=>$classes,'semesters'=>$semesters]);	
	 

  }
  function view_conducted_exams(Request $req)
  {
	$classes=$this->get_classes();
$class_id=$req->input('class_id');
$semester_id=$req->input('semester_id');
  $conducted_exam=DB::table('conducted_exams')
			->select('conducted_exams.published_status','conducted_exams.id as c_exam_id','exams.exam','classes.class','subjects.subject')
  ->join('exams','exams.id','=','conducted_exams.exam_id')
  ->join('subjects','subjects.subject_id','=','conducted_exams.subject_id')
  ->join('classes','classes.class_id','=','subjects.class_id')
	
			  ->where('subjects.class_id','=',$class_id)
			  ->where('subjects.semester_id','=',$semester_id)
			  
			  ->get();
  	
	// return $class_id;
	$semesters=Semester::get();

		  return view('admin/results',['semesters'=>$semesters,'class_list'=>$classes,'conducted_exam'=>$conducted_exam]);	
	 

  }
  function display_result($req)
  {
	  $conducted_exam_id=$req;
	$data=  DB::table('results')
	 	->select('users.name','results.obt_marks') 
	  ->join('users','users.id','=','results.std_id')
	  ->join('conducted_exams','conducted_exams.id','=','results.c_exam_id')
	  ->where('conducted_exams.id','=',$conducted_exam_id)->get();
	//   return $data;
	
	  return view('admin/display_result',['data'=>$data]); 
  }
 function student_detail($std_id)
 {
	$std_enrollment=Student_enrollment::join('semesters','semesters.id','=','student_enrollments.semester_id')->where('student_enrollments.std_id','=',$std_id)->get();
	return view('admin/detail',['std_enrollment'=>$std_enrollment]); 
 }
 function update_exam_status($c_exam_id,$status) 
 {
	$query = DB::table('conducted_exams')
              ->where('id', $c_exam_id)
              ->update(['published_status' => $status]);
return redirect('/admin/result/');
 }
}