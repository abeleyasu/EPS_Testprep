<section id="about" class="section-padding position-relative">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-lg-9 text-sm-start text-center wow fadeInLeft" data-wow-delay="200ms">
        <div class="heading-title mb-4">
          <h2 class="darkcolor font-normal bottom30">College Prep System <br><br><span class="defaultcolor">Everything you need</span> to achieve your college dreams</h2>
        </div>
        <p class="darkcolor bottom10">Experience the advantage of College Prep System, a platform designed by college admissions and test prep experts to maximize your potential through our unique, integrated approach. Our tools and step-by-step guidance are your key to achieving high test scores, gaining admission to your ideal college, and securing scholarships to make college more affordable.</p>
        <p class="darkcolor bottom10">College Prep System is the only resource that prepares students for both college admissions and test prep in one combined platform. It seamlessly merges the roles of a college advisor, test prep tutor, career resource center, college application specialist, essay guidance expert, and application notification system. Experience the advantage of the College Prep System, your key to a bright academic future.</p>
      </div>
      <div class="col-lg-3 wow fadeInRight" data-wow-delay="200ms">
        <div class="image">
          <img alt="SEO" src="{{ asset('static-image/v2/girloutside.png') }}">
        </div>
      </div>
    </div>
    <div class="text-center">
      <a href="{{route('signup')}}" class="nav-link">
        <h3 class="defaultcolor">Sign Up Free</h3>
      </a>
    </div>
    <div class="top30">
      <h2 class="darkcolor font-normal bottom30">Features</h2>
      @include('landing-page-component.components.about-feature', [
        'title' => 'Admissions Tools',
        'content' => [
          [
            'title' => 'High School Resume',
            'description' => 'Automatically generate a personalized resume to share with recommendation writers, college, internships, and more.',
            'image' => asset('static-image/v2/home/highschoolresumeicon.png')
          ],
          [
            'title' => 'College Search',
            'description' => 'Create your college list and dive into detailed description, maps, acceptance statistics and more.',
            'image' => asset('static-image/v2/home/collegesearchicon.png')
          ],
          [
            'title' => 'Application Deadline Organizer',
            'description' => 'Track your colleges application scholarshop, and other deadlines with text & email notification.',
            'image' => asset('static-image/v2/home/applicationdeadlineicon.png')
          ],
          [
            'title' => 'College Cost COmparison',
            'description' => 'Calculate cost of attendance(COA) with tutation room & board, scholarship calculations, then easily compare COA between shcools on your college.',
            'image' => asset('static-image/v2/home/costcomparisonicon.png')
          ],
        ]
      ])

      @include('landing-page-component.components.about-feature', [
        'title' => 'Test Prep Tools (ACT & Digital SAT/PSAT)',
        'description' => 'Featuring the only system that gives simultaneous access to ACT and Digital SAT/PSAT prep, removing the need to choose which test to focus on before starting test prep, empowering students to leverage their aptitude and preference and identify the most suitable test for them.',
        'content' => [
          [
            'title' => 'Accurate Practice Tests',
            'description' => 'Take and grade quality practice tests that simulate real ACT & SAT tests with our realistic questions and digital test proctor.',
            'image' => asset('static-image/v2/home/practicetesticon.png')
          ],
          [
            'title' => 'Targeted Skill Analysis',
            'description' => 'Quickly identify missed question types and focus areas for study by simply inputting your ACT, SAT or PSAT answer choice.',
            'image' => asset('static-image/v2/home/skillanalysisicon.png')
          ],
          [
            'title' => 'Powerful test review',
            'description' => 'Navigate missed concepts with a click unlocking immediate, focused lessions and video, Benefit from smart concept prioritization for quick score improvements.',
            'image' => asset('static-image/v2/home/testreviewicon.png')
          ],
          [
            'title' => 'Custom Quizzes',
            'description' => 'Create custom quizzes based on targeted content areas practice with 1000\'s of high-quality that emulate real test question.',
            'image' => asset('static-image/v2/home/customquizicon.png')
          ],
        ]
      ])

      @include('landing-page-component.components.about-feature', [
        'title' => 'Bonus Tools & Features',
        'content' => [
          [
            'title' => 'Notification System',
            'description' => 'Set text and email remiders for application and scholarship deadlin, study sessions, practice tests, meetings with tutors and college advisors, and more.',
            'image' => asset('static-image/v2/home/notificationsystemicon.png')
          ],
          [
            'title' => 'Calendar',
            'description' => 'Integrate your google calendar with your college prep system college deadline and test prep study calendar',
            'image' => asset('static-image/v2/home/calendaricon.png')
          ],
          [
            'title' => 'Learning Modules',
            'description' => 'Detailed modules offer step-by-step lessons and guidance for students and parents to understand every stage of college planning and prep.',
            'image' => asset('static-image/v2/home/modulesicon.png')
          ],
          [
            'title' => 'Detailed videos',
            'description' => 'Step-by-step, easy to follow along video that guide you through all aspects of profile development, carrer and college search, test prep, applications, FAFSA and scholarships.',
            'image' => asset('static-image/v2/home/videosicon.png')
          ],
        ]
      ])
    </div>
    <div class="heading-title">
      <h2>
        <div>Every Student Has a Dream </div>
        <span class="defaultcolor">Let's Achieve Yours</span>
      </h2>
    </div>
    <div data-wow-delay="200ms" class="text-center mt-3">
      <img alt="SEO" width="100%" src="{{ asset('static-image/v2/studentstudying.jpg') }}">
    </div>
    <div class="heading-title text-center mt-3">
      <h3>Start Your Journey Now</h3>
      <a class="nav-link" href="{{route('signup')}}">
        <h3 class="defaultcolor">Sign Up Free</h3>
      </a>
  </div>
</section>