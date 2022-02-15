@extends('layouts.student')
@section('title','Subjects')
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
                         <th>#</th><th>Subject</th><th>Credit.Hr</th><th>Instructor</th><th>Exams</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php $sn=0;?>
                 @foreach($subjects as $row)
                <?php  
                $subject_id=$row->subject_id;
                $conducted_exams=StudentController:: conducted_exams_by_subject($subject_id)->count()
                ?>
                 <tr>
                 
                 <td>{{++$sn}}</td><td>{{$row->subject}}</td><td>{{$row->credit}}</td><td>{{$row->name}}</td>
                 <td><a href='subject/exam/{{ $subject_id}}'>{{$conducted_exams}}</a></td>
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