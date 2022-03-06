@extends('layouts.student')
@section('title','DMC')
<?php

use App\Http\Controllers\StudentController;?>

@section('mainbody')

<section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class='col-lg-12'>
             <table class='table'>
                 <thead>
                     <tr>
                         <th>#</th><th>Subject</th><th>Semester</th><th>Credit.Hr</th><th>Obt marks</th><th>GP</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php $sn=0;?>
                 @foreach($subjects as $row)
                <?php  
                $subject_id=$row->subject_id;
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
                    $np=(($obt_marks-50)*0.05)+2;
                }
                elseif($obt_marks>90)
                {
                    $np=4;
                }
                else{
                    $np=0;
                }

               

                ?>
                 <tr>
                 <td>{{++$sn}}</td>
                   <td>{{$row->subject}}</td>
                 <td>{{$row->semester}}</td>
                 <td>{{$row->credit}}</td>
                 <td>{{$obt_marks}}</td>
                <td>{{$np}}</td>
                 <td></td>
                 <td></td>
                 
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