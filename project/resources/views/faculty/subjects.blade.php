@extends('layouts.teacher')
@section('title','Subjects')
<?php

use App\Http\Controllers\TeacherController;?>

@section('mainbody')

<section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class='col-lg-12'>
             <table class='table'>
                 <thead>
                     <tr>
                         <th>#</th><th>Subject</th><th>Credit.Hr</th><th>Class</th><th>Exams</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php $sn=0;?>
                 @foreach($subjects as $row)
                <?php  
                $subject_id=$row->subject_id;
                $conducted_exams=TeacherController:: exam_conducted_class($subject_id)->count()
                ?>
                 <tr>
                 
                 <td>{{++$sn}}</td><td>{{$row->subject}}</td><td>{{$row->credit}}</td><td>{{$row->class}}</td>
                <td>{{$conducted_exams}}</td> 
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