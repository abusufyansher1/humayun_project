@extends('layouts.admin')
@section('title','Faculty')


@section('mainbody')

  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm float-right">+ Add faculty</button>
           <table class="table table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                
                <th>Type</th>
                <th>DoJ</th>
                
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $sn=0;?>
              @foreach($teacher_list as $row)
             
              <tr>
                <td>{{++$sn}}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->designation }}</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->doj }}</td>
                <td><a href='#' data-userid="{{$row->id}}" data-username="{{$row->name}}" data-doj="{{$row->doj}}" class="editteacher" >Edit</a> | <a href='/admin/user/delete/{{$row->id}}'  onclick='return confirm("Are you sure?");'>Delete</a></td>
            
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
        <h4 class="modal-title">Add new teacher</h4>
      </div>
      <div class="modal-body">
        <form action="teacher/add" method="post">
          @csrf()
          <label>Student name</label>
          <input class="form-control" type="" name="name">

          <label>DOJ</label>
          <input class="form-control" type="date" name="doj">
           <label>Email address</label>
          <input class="form-control" type="email" name="email">
           <label>Password</label>
          <input class="form-control" type="password" name="password">

          <label>Qualification </label>
          <input class="form-control" type="" name="qualification">

          <label>Designation</label>
          <select class="form-control" type="" name="designation">
            <option value="">Select designation</option>
          @foreach($designations as $rowdesig)
          <option value='{{$rowdesig->id}}'>{{$rowdesig->designation}}</option>
          @endforeach
          </select>
          <label>Employment Type</label>
          <select class="form-control" type="" name="employment_type">
            <option value="">Select type</option>
          @foreach($employment_type as $rowemp_type)
          <option value='{{$rowemp_type->id}}'>{{$rowemp_type->type}}</option>
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
<div id="editteachermodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- add subject Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit teacher</h4>
      </div>
      <div class="modal-body">
        <form action="/admin/user/edit" method="post">
          @csrf()
          <input id='edit_modal_user_id' type='hidden' name='userid'>
          <label>Name</label>
          <input class="form-control" type="" id='edit_modal_username' name="username">
          <label>DOJ</label>
          <input class="form-control" type="date" id='edit_modal_doj' name="doj">
         
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
        $(".editteacher").on("click", function(){
          // alert('Hello world');
            var userid = $(this).attr("data-userid");
            var username = $(this).attr("data-username");
            var doj = $(this).attr("data-doj");
            $("#edit_modal_user_id").val(userid);
            $("#edit_modal_username").val(username);
            $("#edit_modal_doj").val(doj);
            $("#editteachermodal").modal('show');

            
        });
    });
    </script>
  @endsection
