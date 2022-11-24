@extends('layouts.user')

@section('title', 'High School Resume : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 text-white mb-0">High School Resume Tool</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="custom-tab-container ">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Personal Info</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Education </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.honors') }}"
                            id="step3-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Honors </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Activities</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employementCertified') }}"
                            id="step5-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Employment & <br> Certifications</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Featured <br> Attributes</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.preview') }}" id="step7-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Preview</p>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" action="" method="POST">
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed"> Academic Honors, Achievements, & Other
                                            Awards</a>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="position">Position</label>
                                                            <input type="number" class="form-control" id="position"
                                                                name="position" placeholder="position" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="honor">Honor / Achievement /
                                                                Award</label>
                                                            <input type="text" class="form-control" id="honor"
                                                                name="honor" placeholder="Ex: National Honor Society"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="AP-Courses">IB Courses</label>
                                                            <select class="js-select2 select" id="AP-Courses"
                                                                name="AP-Courses" multiple="multiple">
                                                                <option value="1st grade">1st grade</option>
                                                                <option value="2st grade">2st grade</option>
                                                                <option value="3st grade">3st grade</option>
                                                                <option value="4st grade">4st grade</option>
                                                                <option value="5st grade">5st grade</option>
                                                                <option value="6st grade">6st grade</option>
                                                                <option value="7st grade">7st grade</option>
                                                                <option value="8st grade">8st grade</option>
                                                                <option value="9st grade">9st grade</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Location">Location</label>
                                                            <input type="text" class="form-control" id="Location"
                                                                name="Location" placeholder="Ex: DRHS" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Location">Action</label>

                                                        </div>
                                                    </div>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="position-td">Mark</td>
                                                                <td class="honor-td">Mark</td>
                                                                <td class="location-td">Mark</td>
                                                                <td>Mark</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="position-td">Mark</td>
                                                                <td class="honor-td">Mark</td>
                                                                <td class="location-td">Mark</td>
                                                                <td>Mark</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="position-td">Mark</td>
                                                                <td class="honor-td">Mark</td>
                                                                <td class="location-td">Mark</td>
                                                                <td>Mark</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="prev-btn">
                                    <a href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                                        class="btn btn-alt-primary next-step"> Prev
                                    </a>
                                </div>
                                <div class="next-btn">
                                    <a href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                                        class="btn btn-alt-primary next-step"> Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <style>
        .main-tab-container {
            padding: 40px 30px;
        }

        ul,
        li {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .location-td{
            width: 322px;
        }
        .honor-td{
            width: 317px;
        }
        .position-td{
            width: 210px;
        }

        .custom-tab-container {
            padding: 50px 0;
        }

        .custom-tab-container ul li:focus-visible,
        .nav-link:focus-visible {
            outline: 0 !important;
        }

        .invalid {
            width: 100%;
            margin-top: 0.375rem;
            font-size: .875rem;
            color: #dc2626;
        }

        .is-invalid {
            border-color: #dc2626
        }

        .valid {
            border: 1px solid green;
            position: relative;
        }

        .select2-container .select2-selection--multiple {
            min-width: 19vw !important;
        }

        .custom-drodown-course {
            width: 100%;
            border: 1px solid #dfe3ea;
            border-radius: 5px;
            display: none
        }

        .fa-pen {
            color: #1f2937;
            font-size: 16px;
            cursor: pointer;
        }

        .fa-circle-xmark {
            color: #ff3b3b;
            font-size: 16px;
            cursor: pointer;
        }

        table,
        th,
        td {
            border: none;
        }

        .custom-drodown-course ul {
            display: unset !important;
            justify-content: unset !important;
        }

        .custom-drodown-course ul li {
            margin-right: unset !important;
            text-align: unset !important;
            display: block !important;
            cursor: unset !important;
        }

        .custom-drodown-course ul li a {
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            width: 100%;
            display: inline-block;
            padding: 10px
        }

        .custom-drodown-course ul li a:hover {
            background: #1f2937;
            color: #fff
        }

        .nav-link {
            background: transparent !important;
        }


        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            min-height: 33px;
            user-select: none;
            -webkit-user-select: none;
        }

        .custom-tab-container ul li i {
            width: 50px;
            height: 50px;
            font-size: 22px;
            background-color: #a8a8a8;
            text-align: center;
            border-radius: 50%;
            line-height: 50px;
            margin-bottom: 20px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dfe3ea !important;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #232d3a;
            position: absolute;
            top: -2px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            color: #1f2937 !important;
        }




        .fa-check {
            display: none;
        }

        .custom-tab-container ul li a.active i {
            background-color: #1f2937;
            color: #fff;
        }

        .custom-tab-container ul li a {
            color: #1f2937;
        }

        .custom-tab-container ul li {
            margin-right: 50px;
            text-align: center;
            display: inline-block;
            cursor: pointer;
        }

        .nav-link {
            font-size: 16px !important;
            font-weight: 600;
            text-transform: uppercase;
            margin: 0;
            color: #545454 !important;
            padding: 0 !important;
            border: unset !important;
        }

        .custom-tab-container ul {
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
        }

        .nav-tabs {
            border: 0;
        }

        p {
            margin-bottom: 0;
        }

        .block-header-tab {
            background-color: #1f2937;
            text-align: center;
            justify-content: center;
            cursor: pointer;
        }

        .custom-tab-main {
            padding: 20px 0;
        }

        .add-btn i {
            width: 30px;
            height: 30px;
            background-color: #1f2937;
            color: #fff;
            text-align: center;
            border-radius: 50%;
            line-height: 31px;
            font-size: 16px;
        }

        .addbutton {
            position: absolute;
            top: 34px;
            right: 8px;
        }

        
        .fa-check-block{
            display: inline-block;

        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/boostrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_forms_validation.min.js') }}"></script>


    <script>
        $(document).ready(() => {
            // var navListItems = $('.custom-tab-container ul li a'),
            //     allWells = $('.setup-content'),
            //     allNextBtn = $('.next-step');
            //     allPrevBtn = $('.prev-step');

            // navListItems.click(function(e) {
            //     e.preventDefault();
            //     var $target = $($(this).attr('href')),
            //         $item = $(this);

            //     if (!$item.hasClass('disabled')) {
            //         navListItems.removeClass('active');
            //         $item.addClass('active');
            //         allWells.hide();
            //         $target.show();
            //         $target.find('input:eq(0)').focus();
            //     }
            // });


            // allNextBtn.click(function() {
            //     var curStep = allNextBtn.closest('.setup-content'),
            //         curStepBtn = curStep.attr("id"),
            //         nextStepWizard = $('.custom-tab-container ul li a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            //         // curInputs = curStep.find("input[type='text'],input[type='email']"),
            //         isValid = true;

            //         console.log(nextStepWizard);
            //     if (isValid)
            //         nextStepWizard.removeClass().trigger('click');
            // });

            // allPrevBtn.click(function() {
            //     var curStep = allPrevBtn.closest('.setup-content'),
            //         curStepBtn = curStep.attr("id"),
            //         prevtStepWizard = $('.custom-tab-container ul li a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
            //         // curInputs = curStep.find("input[type='text'],input[type='email']"),
            //         isValid = true;

            //         console.log(curStepBtn);

            //     if (isValid)
            //     prevtStepWizard.addClass().trigger('click');
            // });


            $(".select").select2({
                tags: true
            })

            $(".form-drop").click(function() {
                $(".custom-drodown-course").toggle();
            });

        });
    </script>
@endsection
