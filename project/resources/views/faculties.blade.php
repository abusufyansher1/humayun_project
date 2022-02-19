@extends('layouts.homepage')
@section('title','Faculties')
@section('mainbody')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/">Home</a></li>
          <li>Faculties</li>
        </ol>
        <h2>Faculties</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    
    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="row">
            @foreach($faculties->get() as $rowfaculty)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/team/team-1.jpg" alt="">
              <h4>{{$rowfaculty->name}}</h4>
              <span>{{$rowfaculty->designation}}</span>
              <p>{{$rowfaculty->qualification}}
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
    @endforeach
          

        </div>

      </div>
    </section><!-- End Team Section -->



  @endsection