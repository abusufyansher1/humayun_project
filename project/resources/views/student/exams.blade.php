@extends('layouts.student')
@section('title','Exam')
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
                         <th>#</th><th>Subject</th><th>Credit.Hr</th><th>Instructor</th><th>Exams</th><th>Obt marks</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php $sn=0;?>
                 @foreach($conducted_exam as $row)
                <?php
                $obt_mark=0;
                $conducted_exam_id=$row->c_exam_id;
                  $result=  StudentController::get_result_by_c_exam($conducted_exam_id);
                  $result_row=$result->first();
                  
                ?>
                 <tr>
                 
                 <td>{{++$sn}}</td><td>{{$row->subject}}</td><td>{{$row->credit}}</td><td>{{$row->name}}</td>
                 <td>{{$row->exam}}</td>
                 <td>
                 @if($result->count()>0)
 
                 {{$result_row->obt_marks}}
                @endif</td>
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