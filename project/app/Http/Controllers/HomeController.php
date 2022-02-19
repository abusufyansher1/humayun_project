<?php


namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Student_info;
use App\Models\Teacher_info;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
   function index()
   {
     $classes= $this->get_classes();
     $students=  User::where('role','=',3);
     $faculties=$this->get_faculties();
     return view('welcome',['classes'=>$classes,'students'=>$students,'faculties'=>$faculties]);
   }
   function get_faculties()
   {
    $faculties=  User::join('teacher_infos','teacher_infos.user_id','users.id')
        ->join('designations','designations.id','teacher_infos.designation_id')
        ->where('users.role','=',2);
    return  $faculties;
   }
   function get_classes()
   {
    $classes=  Classes::where('class_id','>',0);
    return $classes;
   }
function programpage()
{
  $classes=  $this->get_classes();
return view('programs',['classes'=>$classes]);
}
function facultypage()
{
    $faculties=$this->get_faculties();
return view('faculties',['faculties'=>$faculties]);
}


}
