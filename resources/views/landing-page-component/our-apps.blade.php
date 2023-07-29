<section id="our-apps" class="section-padding position-relative">
  <div class="container">
    <div class="heading-title mb-3 wow wow fadeInUp" data-wow-delay="300ms">
      <span class="defaultcolor text-center text-md-start">Looking forward to your future</span>
      <h2 class="darkcolor font-normal text-center text-md-start">Universities Our Students Attend</h2>
    </div>
    <div class="row d-flex align-items-center" id="app-feature">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="text-center text-md-end">
          <div class="feature-item mt-3 wow fadeInLeft" data-wow-delay="300ms">
            <img src="{{ asset('static-image/UCLA.jpg') }}">
            <div class="text">
              <h3 class="bottom15">
                <span class="d-inline-block">ULCA</span>
              </h3>
            </div>
          </div>
          <div class="feature-item mt-5 wow fadeInLeft" data-wow-delay="350ms">
            <img src="{{ asset('static-image/USClogo.png') }}">
            <div class="text">
              <h3 class="bottom15">
                <span class="d-inline-block">Customization</span>
              </h3>
              <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 text-center">
        @include('components.iphone-deck')
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="text-center text-md-start">
          <div class="feature-item mt-3 wow fadeInRight" data-wow-delay="300ms"> 
            <img src="{{ asset('static-image/USClogo.png') }}">
            <div class="text">
              <h3 class="bottom15">
                <span class="d-inline-block">Powerful Code</span>
              </h3>
              <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
            </div>
          </div>
          <div class="feature-item mt-5 wow fadeInRight" data-wow-delay="350ms">
            <img src="{{ asset('static-image/UnivStThomas.jpg') }}">
            <div class="text">
              <h3 class="bottom15">
                <span class="d-inline-block">Documentation </span>
              </h3>
              <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>