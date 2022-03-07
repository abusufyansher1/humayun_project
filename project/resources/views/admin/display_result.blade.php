@extends('layouts.admin')
@section('title','Display result')


@section('mainbody')

  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
           
            <div class='col-lg-12'>
                <table class='table' id='example1'>
                    <thead>
                        <tr><th>#</th><th>Student Name</th><th>Obt Marks</th></tr>
                    </thead>
                    <tbody>
                        <?php if(isset($data))
                        { $sn=0; ?>
                        @foreach($data as $row)
                        <tr>
                            <td>{{++$sn}}</td>
                            <td>
                            {{$row->name}}
                        </td>
                        <td>
                                
                            {{$row->obt_marks}}
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