@extends('layouts.teacher')
@section('title','Subjects')
<?php

use App\Http\Controllers\TeacherController;?>

@section('mainbody')

<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class='col-lg-12'>
                <button data-toggle="modal" data-target="#addexam" class='btn btn-info btn-sm float-right'>Add exam</button>
            </div>
         <div class='col-lg-12'>
             <table class='table'>
                 <thead>
                     <tr>
                         <th>#</th><th>Subject</th><th>Exams</th><th>Class</th><th>Result</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php $sn=0;?>
                 @foreach($conducted_exams as $row)
               
                 <tr>
                 
                 <td>{{++$sn}}</td><td>{{$row->subject}}</td>
                 <td>{{$row->exam}}</td>
                 <td>{{$row->class}}</td>
                 <td><a href='/teacher/result/{{$row->c_exam_id}}'>Result</a></td>
             
                </tr>
                 @endforeach
                 </tbody>
             </table>
         </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   <!-- Modal -->
<div id="addexam" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create new exam</h4>
      </div>
      <div class="modal-body">
        <form action="/43teacher/conduct_exam/add" method="post">
          @csrf()
          
          <label>Subject</label>
          <select class="form-control" type="" name="subject_id">
            <option value="">Select subject</option>
         @foreach($subjects as $row1)
         <option value="{{$row1->subject_id}}">{{$row1->subject}}</option> 
         @endforeach
          </select>
          <label>Exam</label>
          <select class="form-control" type="" name="exam_id">
            <option value="">Select exam</option>
         @foreach($examtypes as $row2)
         <option value="{{$row2->id}}">{{$row2->exam}}</option> 
         @endforeach
          </select>
          
          <label></label>
          <input class="form-control btn btn-info" type="submit" value="save"  name="submit">
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
</div></div>
  @endsection