@extends('layouts.student')
@section('title','DMC')
<?php

use App\Http\Controllers\StudentController;?>

@section('mainbody')

<section class="content">
      <div class="container-fluid">
        <div class="row">
            <p>Ctrl+P = Print/PDF</p>
         <div class='col-lg-12'>
             <table class='table example2'>
                 <thead>
                     <tr>
                         <th>#</th><th>Subject</th><th>Semester</th><th>Credit.Hr</th><th>Obt marks</th><th>GP</th><th>NP</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php $sn=0;
                 $totalnp=0;
                 $totalcredit=0;
                 ?>
                 @foreach($enrollments as $rowenrollment)
           
                  <?php
                  $semester_id=$rowenrollment->semester_id;
            $class_id=$rowenrollment->class_id;
            
               $subjects=StudentController:: get_subject_by_class_semester($class_id,$semester_id);
         ?>
          <tr>
                 <td colspan='7'>Semester:{{$semester_id}} </td>
             </tr>
       @foreach($subjects as $rowsubject)
       <?php 
       $subject_id=$rowsubject->subject_id;
       
                $obt_marks=0;
                $conducted_exams=StudentController:: conducted_exams_by_subject($subject_id)->get();
                foreach($conducted_exams as $row2)
                {
                    $c_exam_id=$row2->c_exam_id;
                $result=    StudentController::get_result_by_c_exam($c_exam_id)->get();
                    foreach($result as $row3)
                    {
                        $obt_marks=$row3->obt_marks;
                    }
                }
                if($obt_marks>=50 && $obt_marks<=90)
                {
                    $gp=(($obt_marks-50)*0.05)+2;
                }
                elseif($obt_marks>90)
                {
                    $gp=4;
                }
                else{
                    $gp=0;
                }

               $np=$rowsubject->credit*$gp;
               $totalnp+=$np;
               $totalcredit+=$rowsubject->credit;

                ?>
                 <tr>
                 <td>{{++$sn}}</td>
                   <td>{{$rowsubject->subject}}</td>
                 <td>{{$rowsubject->semester}}</td>
                 <td>{{$rowsubject->credit}}</td>
                 <td>{{$obt_marks}}</td>
                <td>{{$gp}}</td>
                <td>{{$np}}</td>
            </tr>
                 
            
         @endforeach
       
                <tr>
                    <td colspan='6'>GPA</td><td></td>
                </tr>
                 @endforeach
                 </tbody>
             </table>
         </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    
  @endsection