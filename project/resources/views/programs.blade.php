@extends('layouts.homepage')
@section('title','Programs')
@section('mainbody')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/">Home</a></li>
          <li>Programs</li>
        </ol>
        <h2>Programs</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="row">
        <div class="col-lg-12 col-md-12 d-flex align-items-stretch">
        <table class='table'>
        <tbody>
            <thead>
                <tr>
                    <th>#</th> <th>Program</th> <th>Equivallent</th>  <th>Eligibilty</th>
                </tr>
            </thead>
        @foreach($classes->get() as $rowclasses)
        
        
      
           
                <tr>
                    <td></td><td>{{$rowclasses->class}}</td><td>{{$rowclasses->equivallent}}</td><td>{{$rowclasses->eligibility}}</td>
                </tr>
              
          @endforeach
          </tbody>
        </table> 

        </div>

      </div>
    </section><!-- End Services Section -->



  @endsection