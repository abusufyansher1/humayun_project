<?php
use App\Http\Controllers\AdminController;
?>
@extends('layouts.admin')
@section('title','Classes')


@section('mainbody')

  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm float-right">+ Add class</button>
           <table class="table table-sm ">
            <thead>
              <tr>
                <th>#</th>
                <th>Class</th>
                <!-- <th>Course(s)</th>                -->
                <th>Action</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $sn=0;?>
              @foreach($class_list as $row)
                <?php $class_id=$row->class_id; ?>
              <tr>
                <td>{{++$sn}}</td>
                <td>{{ $row->class }}</td>

                <td><a href='/admin/subjects/{{$class_id}}'>View subject(s)</a> | <a href='#' data-class_id="{{$row->class_id}}" class="addsubjectbtn">Add subject</a></td>
                <td><a href='#' data-class_id="{{$row->class_id}}" data-classname="{{$row->class}}" class="editclass">Edit</a> | <a href='/admin/class/delete/{{$row->class_id}}' onclick='return confirm("Are you sure?");'>Delete</a></td>
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Register new class</h4>
      </div>
      <div class="modal-body">
        <form action="class/add" method="post">
          @csrf()
          <label>Class name</label>
          <input class="form-control" type="" name="class">

          <label>Equivallent</label>
          <input class="form-control" type="" name="equal">
          <label>Eligibility Criteria</label>
          <input class="form-control" type="" name="eligibility">

        

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


  <!-- Modal -->
  <div id="subjectmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- add subject Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Register new subject</h4>
      </div>
      <div class="modal-body">
        <form action="course/add" method="post">
          @csrf()
          <input id='modal_class_id' type='hidden' name='class_id'>
          <label>Subject</label>
          <input class="form-control" type="" name="subject">
          <label>Credit Hrs</label>
          <input class="form-control" type="" name="credit">
          <label>Assign Teacher</label>
          <select class='form-control' name='teacher_id'>
          @foreach($teacher_list as $rowtech)
          
          
            <option value='{{$rowtech->id}}'>{{$rowtech->name}}
          </option>
          @endforeach
          </select>
          <label>Semester</label>
          <select class='form-control' name='teacher_id'>
          <option value="">Select Semester</option>
          @foreach($semesters as $rowsemester)
          <option value='{{$rowsemester->id}}'>{{$rowsemester->semester}}</option>
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

  </div>
</div>

<!-- Modal -->
<div id="editclassmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- add subject Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit class</h4>
      </div>
      <div class="modal-body">
        <form action="class/edit" method="post">
          @csrf()
          <input id='edit_modal_class_id' type='hidden' name='class_id'>
          <label>Class</label>
          <input class="form-control" type="" id='edit_modal_classname' name="classname">
         
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
    $(".addsubjectbtn").on("click", function(){
        var class_id = $(this).attr("data-class_id");
        $("#modal_class_id").val(class_id);
        $("#subjectmodal").modal('show');
    });
});
</script>
<script>
    
    $(document).ready(function(){
        $(".editclass").on("click", function(){
            var class_id = $(this).attr("data-class_id");
            var classname = $(this).attr("data-classname");
            $("#edit_modal_class_id").val(class_id);
            $("#edit_modal_classname").val(classname);
            $("#editclassmodal").modal('show');
            
        });
    });
    </script>
  @endsection
  
 