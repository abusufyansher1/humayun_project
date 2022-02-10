<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Student_info;
use App\Models\student_enrollment;
use App\Models\Teacher_info;
use App\Models\Designation;
use App\Models\Employment_type;
use App\Models\Classes;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	function add_class(Request $req)
	{
		$data=	new Classes;
		$data->class=$req->input('class');
		$data->save();
	}
  Protected function index()
  {
  	return view('admin/index');
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
  	$data2->std_id= $last_user_id;
  	$data2->save();
  	$data3 = new student_enrollment;
  	$data3->class_id= $req->input('class_id');
  	$data3->admission_year= $req->input('admission_year');
  	$data3->std_id= $last_user_id;
  	$data3->save();
  }
    function view_students()
  {
  	$data=User::Join('student_infos','student_infos.std_id','=','users.id')
  	->join('student_enrollments','student_enrollments.std_id','=','users.id')
  	->join('classes','classes.class_id','=','student_enrollments.class_id')
  	->where(['users.role'=> '3'])->get();
  	// return $data;
  	$classes=$this->get_classes();
  	return view('admin/students',['student_list'=>$data,'classes'=>$classes]);
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
  function view_classes()
  {
  	$classes=$this->get_classes();
  	return view('admin/classes',['class_list'=>$classes]);
  }
  function get_subjects_by_class($req)
  {
	$data=DB::table('subjects')->where('class_id','=',$req)->get();
	return $data;
  }
}
