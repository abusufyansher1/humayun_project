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
                <th>Semester</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $sn=0;?>
              @foreach($std_enrollment as $row)
               <?php 
              if($row->status==0)
              {
                $status="Enrol";
              }
              elseif($row->status==1)
              {
                $status="Promoted";
              }
              elseif($row->status==2)
              {
                $status="Not Promoted";
              }
              elseif($row->status==3)
              {
                $status="Droped";
              }
              elseif($row->status==4)
              {
                $status="Admission cancelled";
              }
              elseif($row->status==5)
              {
                $status="Passout";
              } ?>
              <tr>
            
                <td>{{$row->semester}}</td>
                <td>{{$status}}</td>
               
              
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

  @endsection