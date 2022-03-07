@extends('layouts.admin')
@section('title','Result')


@section('mainbody')

  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class='col-lg-12'>
                <form action='/admin/result/' method='post'>
                    @csrf()
                    <select id='class_id' name='class_id'>
                        <option>Select class</option>
                        @foreach($class_list as $row)
                        <option value='{{$row->class_id}}'>{{$row->class}}</option>
                        @endforeach
                    </select>
                    <select id='semester_id' name='semester_id'>
                        <option>Select semester</option>
                        @foreach($semesters as $semrow)
                        <option value='{{$semrow->id}}'>{{$semrow->semester}}</option>
                        @endforeach
                    </select>
                    <input type='submit'>
                
            </form >
            </div>
            <div class='col-lg-12'>
                <table class='table'>
                    <thead>
                        <tr><th>#</th><th>Exam type</th><th>Status</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php if(isset($conducted_exam))
                        { $sn=0; ?>
                        @foreach($conducted_exam as $row2)
                        <tr>
                            <td>{{++$sn}}</td>
                            <td>
                        <a href='/admin/result/display/{{$row2->c_exam_id}}'>{{$row2->exam}} ({{$row2->class}})</a>
                        </td>
                        <td>
                            @if($row2->published_status==0)
                                <p><span class='badge badge-warning'>Not published</span></p>
                            @else
                            <p><span class='badge badge-info'>Published</span></p>
                            @endif
                        </td>
                        <td>
                            @if($row2->published_status==0)
                                <a href='/admin/result/updatestatus/{{$row2->c_exam_id}}/1'><span class='badge badge-warning'>Click to publish</span></a>
                                
                            @endif
                            @if($row2->published_status==1)
                                <a href='/admin/result/updatestatus/{{$row2->c_exam_id}}/0'><span class='badge badge-danger'>Click to unpublish</span></a>
                                
                            @endif
                        </td>
                        
                    </tr>
                        @endforeach
                   
                        <?php }?>
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