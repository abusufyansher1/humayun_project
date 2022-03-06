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
                <!-- <th>Action</th> -->
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
 
  @endsection
  
 