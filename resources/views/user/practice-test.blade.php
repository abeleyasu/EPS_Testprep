@extends('layouts.user')

@section('title', 'practice-test : CPS')

@section('user-content')
<!-- Main Container -->
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-boxed py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="be_pages_elearning_courses.html">Practice Tests</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">College Prep System SAT Practice Test #1</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="bg-body-extra-light">
        <div class="content content-boxed py-3">
            <div class="row">
                <div class="col-xl-4">
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-arrow-left me-1"></i>Previous</button>
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3">Next<i class="fa fa-fw fa-arrow-right me-1"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-list-check me-1"></i>Review</button>
                    <button type="button" class="btn btn-sm btn-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-clock me-1"></i> 35:12</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="col-xl-6">
                <!-- Lessons -->
                <div class="block block-rounded">
                    <div class="block-content fs-sm">

                        <h5 class="h5 mb-4">
                            PASSAGE I
                        </h5>
                        <h5 class="h5 mb-4">
                            <strong>PASSAGE TYPE: NATURAL SCIENCE</strong><br />This is adapted from author Blah.
                        </h5>
                        <div class="mb-4">
                            <textarea class="form-control" id="example-textarea-input" name="example-textarea-input" rows="4" placeholder="Textarea content..">The first prehistoric avian bird of its kind was discovered in Antarctica in December of the year 2032. Its unique features, which include an obvious membranous extension to its fin and a fold in its flight-bends, put its scientific discovery into the same realms as that of Darwin's fin-flap animal. This incredible bird is a truly remarkable feat. It was discovered in deep waters in the Beaufort Gyre, an area of the southern ocean that is one of the most important underwater ecosystems for biological discovery, in a collection of fossils that span the entire 400 million year history of the animal.
                      Notably, this remarkable feat is the result of a scientific exploration by veteran experts in Antarctic science who are passionate about the advancement of paleoceanography. 
                      Astronaut Dr. Stephen Wright joins Bryan Johnson to detail the remarkable life and legacy of Dr. Frank White, a scientist who spent 32 days in space, leaving behind much scientific knowledge. It is estimated that at least 500 additional species of plant and animal have now been discovered. This volume documents that entire collection of scientific specimens from Dr. White, who is considered the father of modern scientific exploration.</textarea>
                        </div>

                    </div>
                </div>
                <!-- END Lessons -->
            </div>
            <div class="col-xl-6">
                <!-- Question -->
                <div class="mb-4">
                    <label class="form-label">Question 1 Text</label>
                    <div class="space-y-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="example-radios-default1" name="example-radios-default" value="option1" checked>
                            <label class="form-check-label" for="example-radios-default1">A. This is answer A text.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="example-radios-default2" name="example-radios-default" value="option2">
                            <label class="form-check-label" for="example-radios-default2">B. This is answer B text.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="example-radios-default3" name="example-radios-default" value="option3">
                            <label class="form-check-label" for="example-radios-default3">C. This is answer C text.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="example-radios-default4" name="example-radios-default" value="option4">
                            <label class="form-check-label" for="example-radios-default4">D. This is answer D text.</label>
                        </div>
                    </div>
                </div>
                <!-- END Subscribe -->


            </div>
        </div>
    </div>
    <!-- END Page Content -->
    <!-- Navigation -->
    <div class="bg-body-extra-light">
        <div class="content content-boxed py-3">
            <div class="row">
                <div class="col-xl-4">
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-arrow-left me-1"></i>Previous</button>
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3">Next<i class="fa fa-fw fa-arrow-right me-1"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-list-check me-1"></i>Review</button>
                    <button type="button" class="btn btn-sm btn-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-clock me-1"></i> 35:12</button>
                </div>
                <div class="col-xl-4">
                    <button type="button" class="btn btn-sm btn-outline-danger fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-flag me-1" style="color:red"></i>Flag</button>
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-forward me-1"></i>Skip</button>
                    <button type="button" class="btn btn-sm btn-outline-warning fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-circle-question me-1"></i>Guess</button>
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-calculator me-1" style="color:black"></i>Calculator</button>
                </div>
                <div class="col-xl-4">
                    <button type="button" class="btn btn-sm btn-outline-success fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-circle-check me-1"></i>Submit Section</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Navigation -->
</main>
<!-- END Main Container -->
@endsection

@section('page-style')
<style>
    .content {
        width: 90%;
    }
</style>
@endsection