<section id="our-partners" class="section-padding position-relative">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div id="partners-slider" class="owl-carousel owl-loaded owl-drag">
          <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(-1833px, 0px, 0px); transition: all 1.5s ease 0s; width: 4584px;">
              @for($i = 0; $i < 25; $i++)
              <div class="owl-item cloned" style="width: 199.2px; margin-right: 30px;">
                <div class="item">
                  <div class="logo-item">
                    <img alt="" src="{{ asset('static-image/logo-1.png') }}">
                  </div>
                </div>
              </div>  
              @endfor    
            </div>
            <div class="owl-nav disabled">
              <button type="button" role="presentation" class="owl-prev">
                <span aria-label="Previous">‹</span>
              </button>
              <button type="button" role="presentation" class="owl-next">
                <span aria-label="Next">›</span>
              </button>
            </div>
            <div class="owl-dots disabled"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>