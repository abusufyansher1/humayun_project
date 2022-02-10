@extends('layouts.admin')
@section('title','Students')


@section('mainbody')

  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm float-right">+ Add student</button>
           <table class="table table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Father Name</th>
                
                <th>Session</th>
                <th>Class</th>
                
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $sn=0;?>
              @foreach($student_list as $row)

              <tr>
                <td>{{++$sn}}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->father_name }}</td>
                <td>{{ $row->admission_year }}</td>
                <td>{{ $row->class }}</td>
                <td><a href="">View details</a></td>
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
        <h4 class="modal-title">Add new student</h4>
      </div>
      <div class="modal-body">
        <form action="student/add" method="post">
          @csrf()
          <label>Student name</label>
          <input class="form-control" type="" name="name">

          <label>Father name</label>
          <input class="form-control" type="" name="fname">
           <label>Email address</label>
          <input class="form-control" type="email" name="email">
           <label>Password</label>
          <input class="form-control" type="password" name="password">

          <label>Address </label>
          <input class="form-control" type="" name="address">

          <label>Contact</label>
          <input class="form-control" type="" name="contact">


          <label>Admit in</label>
          <select class="form-control" type="" name="class_id">
            <option value="">Select Class</option>
          @foreach($classes as $rowclass)
          <option value='{{$rowclass->class_id}}'>{{$rowclass->class}}</option>
          @endforeach
          </select>
           <label>Year</label>
          <input class="form-control" type="number" name="admission_year">
           

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
  @endsection
