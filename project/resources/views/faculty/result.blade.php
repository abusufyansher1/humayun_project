@extends('layouts.teacher')
@section('title','Result')
<?php
use App\Http\Controllers\TeacherController;?>

@section('mainbody')
@if( Session::has( 'data' ))
     <div class='alert alert-info'>{{ Session::get( 'data' ) }}</div>
@endif
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class='col-lg-12'>
                </div>
         <div class='col-lg-12'>
             <table class='table table-sm'>
                 <thead>
                     <tr>
                         <th>RollNo</th> <th>Student name</th><th>ObtM.</th>
                     </tr>
                 </thead>

             
             <tbody>
                <form action='/teacher/saveresult' method='post'>
            @csrf
              <?php   $no=0;?>
            
            @foreach($enrol_std as $row)
            <?php 
           $no++;
             $c_exam_id= $c_exam_id;
             $std_id=$row->user_id;
         
            $result= App\Http\Controllers\TeacherController:: get_std_result_by_c_exam($c_exam_id,$std_id)->first();
            if($result)
            {
            $obt_marks=$result->obt_marks;
            
            }
            else{
                $obt_marks=0;
            }
            // $obt_marks=0;
            ?>

            
                <tr>
                     <td>{{$row->user_id}}</td><td>{{$row->stdname}}</td>
                     <td>
                     <input type='hidden' name='std_id[{{$no}}]' value='{{$std_id}}'>
                     
                    
                     <input  type='number' name='obtmark[{{$no}}]' value='{{$obt_marks}}'>
                    </td>
                 </tr>
           
            @endforeach
            <input type='hidden' name='no' value='{{$no}}'>
            <input type='hidden' name='c_exam_id' value='{{$c_exam_id}}'>
            <tr><td><input type='submit' name='submit' value='Save' class='btn btn-info'></td></tr>
            
            </form>
            </tbody>
            </table>
         </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   <!-- Modal -->

  @endsection