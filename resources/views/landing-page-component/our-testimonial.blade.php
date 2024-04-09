<div class="d-flex flex-column align-items-center justify-content-center gap-2 mb-3">
  <h4 class="text-center">College Prep System has had hundreds of success stories just like these. Make your story the next great success!</h4>
  <a href="#" class="nax-link text-center">
    <h3 class="defaultcolor">Full list of student success stories</h3>
  </a>
</div>
<section id="our-testimonial" class="padding_bottom position-relative bglight bg-testimonial-image">
  <div class="parallax page-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-6 col-md-12 text-center text-lg-end">
          <div class="heading-title wow fadeInUp padding_testi" data-wow-delay="300ms">
            <h2 class="defaultcolor font-normal">What Students and Parents Are Saying</h2>
            <p class="defaultcolor font-normal">About College Prep System</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="owl-carousel owl-loaded" id="testimonial-slider">
      @for($i = 0; $i < 25; $i++)
      <div class="row align-items-center">
        <div class="col-lg-4 col-md-12 text-center">
          {{---<div class="testimonial-round d-inline-block">
            <img src="{{ asset('static-image/testimonial-3.jpg') }}" alt="">
          </div> --}}
          <h5 class="whitecolor font-light top15">Kevin Miller {{ $i }}</h5>
          {{-- <p>ENVATO, Australia</p> --}}
        </div>
        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-center">
          <h3 class="whitecolor bottom15 top90">Great service! I improved my ACT score 8 points - from 26 to 34!</h3>
          <span class="d-inline-block test-star">
            <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i>
          </span>
        </div>
      </div>
      @endfor   
    </div>
  </div>
</section>