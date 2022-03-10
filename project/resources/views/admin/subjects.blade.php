<?php
use App\Http\Controllers\AdminController;
?>
@extends('layouts.admin')
@section('title','Subjects')


@section('mainbody')

  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- <button data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm float-right">+ Add class</button> -->
           <table class="table table-sm ">
            <thead>
              <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Semester</th>               
                <th>Credit Hr</th>
                <th>Instructor</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $sn=0;?>
              @foreach($subjects as $row)
                
              <tr>
                <td>{{++$sn}}</td>
                <td>{{ $row->subject }}</td>
                <td>{{ $row->credit }}</td>
                <td>{{ $row->semester }}</td>
                <td>{{ $row->name }}</td>  
                <td><a href='#' data-classid="{{$row->class_id}}" data-semester="{{$row->semester}}" data-subjectid="{{$row->subject_id}}" data-subject="{{$row->subject}}" data-credit="{{$row->credit}}" class="editsubject" >Edit</a> | <a href='/admin/course/delete/{{$row->subject_id}}/{{$row->class_id}}'  onclick='return confirm("Are you sure?");'>Delete</a></td>
                         
              </tr>
              @endforeach
            </tbody>
           </table>
          </div>         
         <!-- ./col -->
        </div>
               <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<!-- Modal -->
<div id="editsubjectmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- add subject Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit subject</h4>
      </div>
      <div class="modal-body">
        <form action="/admin/course/edit" method="post">
          @csrf()
          <input id='edit_modal_subject_id' type='hidden' name='subject_id'>
          <input id='edit_modal_class_id' type='hidden' name='class_id'>
          <label>Subject</label>
          <input class="form-control" type="" id='edit_modal_subject' name="subject" required>
          <label>Credit</label>
          <input class="form-control" type="number" id='edit_modal_credit' name="credit" required>
         
          <label></label>
          <input class="form-control btn btn-info" type="submit" value="save"  name="submit">
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
 <script>

$(document).ready(function(){
        $(".editsubject").on("click", function(){
          // alert('Hello world');
            var subject_id = $(this).attr("data-subjectid");
            var classid = $(this).attr("data-classid");
            var subject = $(this).attr("data-subject");
            var credit = $(this).attr("data-credit");
            $("#edit_modal_subject_id").val(subject_id);
            $("#edit_modal_subject").val(subject);
            $("#edit_modal_credit").val(credit);
            $("#edit_modal_class_id").val(classid);
            $("#editsubjectmodal").modal('show');

            
        });
    });
    </script>
 
  @endsection
  
 