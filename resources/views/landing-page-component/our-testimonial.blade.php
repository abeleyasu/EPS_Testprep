<section id="our-testimonial" class="padding_bottom position-relative bglight bg-black-board">
  <div class="parallax page-header testimonial-bg bg-testimonial-image">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-6 col-md-12 text-center text-lg-end">
          <div class="heading-title wow fadeInUp padding_testi" data-wow-delay="300ms">
            <h2 class="whitecolor font-normal">What Students and Parents Are Saying</h2>
            <p class="whitecolor font-normal">About College Prep System</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="owl-carousel owl-loaded" id="testimonial-slider">
      <div class="owl-stage-outer">
        <div class="owl-stage" style="transform: translate3d(-2292px, 0px, 0px); transition: all 0s ease 0s; width: 9168px;">
          @for($i = 0; $i < 25; $i++)
            <div class="owl-item cloned" style="width: 1116px; margin-right: 30px;">
              <div class="item testi-box">
                <div class="row align-items-center">
                  <div class="col-lg-4 col-md-12 text-center">
                    <div class="testimonial-round d-inline-block">
                      <img src="{{ asset('static-image/testimonial-3.jpg') }}" alt="">
                    </div>
                    <h4 class="defaultcolor font-light top15"><a href="#">Kevin Miller {{ $i }}</a></h4>
                    <p>ENVATO, Australia</p>
                  </div>
                  <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                    <p class="bottom15 top90">Trax is a company that provides tools to help professional event planning and execution, and their customers are very happy folks! The thing I love about their customer testimonial page provides content formats.</p>
                    <span class="d-inline-block test-star">
                      <i class="fas fa-star"></i> 
                      <i class="fas fa-star"></i> 
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i> 
                      <i class="fas fa-star"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div> 
          @endfor   
        </div>
        <div class="owl-nav">
          <button type="button" role="presentation" class="owl-prev">
            <i class="fas fa-angle-left"></i>
          </button>
          <button type="button" role="presentation" class="owl-next">
            <i class="fas fa-angle-right"></i>
          </button>
        </div>
        <div class="owl-dots disabled"></div>
      </div>
    </div>
  </div>
</section>