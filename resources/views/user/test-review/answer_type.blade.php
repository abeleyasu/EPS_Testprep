@extends('layouts.user')

@section('title', 'Question & Concept Review : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            {{-- Test review title  --}}
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                        <div class="flex-grow-1">
                            <h1 class="h3 fw-bold mb-2">
                                Test Review
                            </h1>
                            <h2 class="fs-base lh-base fw-medium text-white mb-0">
                                Official ACT 1576C (Z04) - April 2021
                            </h2>
                        </div>
                        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">
                                    <a class="link-fx" href="#">
                                        Official ACT 1576C / Z04 - April 2021 Review Summary
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    ACT English Review (1576C / Z04)
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            {{-- END Test review title --}}

            <div class="content">
                {{-- Pick a Review Option --}}
                <h2 class="content-heading">Pick a Review Option</h2>
                <div class="row">
                    <div class="col-md-4 col-xl-4">
                        <a class="block block-rounded bg-primary-dark" href="{{ route('test-review.question-concept-review') }}">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Question & Concept Review MOBILE</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    Practice Test 1576C
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-4">
                        <a class="block block-rounded bg-primary-dark" href="{{ route('test-review.category-question-type') }}">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Category & Question Type Summary</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    from your missed questions.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-4">
                        <a class="block block-rounded bg-primary-dark" href="{{ route('test-review.answer-type') }}">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Answer Type Summary</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    from your missed questions.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                {{-- END Pick a Review Option --}}

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">INCORRECT ANSWER TYPE SUMMARY</h3>
                    </div>
                    <div class="block-content">
                        <div class="block-content p-0">       
                            <table class="js-table-sections table table-hover table-vcenter js-table-sections-enabled">
                                <thead>
                                  <tr>
                                    <th style="width: 30px;"></th>
                                    <th style="width: 20%;">Type</th>
                                    <th>Name</th>
                                    <th style="width: 20%;">FREQUENCY OF INCORRECT ANSWER TYPES</th>
                                  </tr>
                                </thead>
                                
                                <tbody class="fs-sm">
                
                                    <!-- Answer Type 1 -->
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <button type="button" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Answer Type</button>
                                        </td>
                                        <td class="fw-semibold fs-sm">                
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ag1" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Doesn't Meet Keyword Goal</button>
                        
                                            <div class="modal" id="modal-block-large-ag1" tabindex="-1" aria-labelledby="modal-block-large-ag1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="block block-rounded">
                                                            <div class="block-header block-header-default">
                                                                <h3 class="block-title">Answer Type: Doesn't Meet Keyword Goal</h3>
                                                            </div>
                                                        <div class="block-content">
                                                            <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                    <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                                                        <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                                                                    </div>
                                                                    <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                                                        <div class="block-content">
                                                                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="block-content block-content-full text-end bg-body">
                                                                <button type="button" class="btn btn-sm block-header-default text-white text-white" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                
                                        <td class="fw-semibold fs-sm">
                                            <div class="py-1">
                                                <p>1</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- END Answer Type 1 -->
                
                                    <!-- Answer Type 2 -->
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <button type="button" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Answer Type</button>
                                        </td>
                                        <td class="fw-semibold fs-sm">                    
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ag2" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Vocabulary Definition Doesn't Match Context</button>
                    
                                            <div class="modal" id="modal-block-large-ag2" tabindex="-1" aria-labelledby="modal-block-large-ag2" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="block block-rounded">
                                                            <div class="block-header block-header-default">
                                                                <h3 class="block-title">Answer Type: Vocabulary Definition Doesn't Match Context</h3>
                                                            </div>
                                                            <div class="block-content">
                                                                <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                        <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                                                                        </div>
                                                                        <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                                                            <div class="block-content">
                                                                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content block-content-full text-end bg-body">
                                                                    <button type="button" class="btn btn-sm block-header-default text-white text-white" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            <div class="py-1">
                                                <p>2</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Answer Type 2 -->
                
                                    <!-- Answer Type 3 -->
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <button type="button" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Answer Type</button>
                                        </td>
                                        <td class="fw-semibold fs-sm">                    
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-at3" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Incorrectly Used Literal Vocabulary Definition</button>
                        
                                            <div class="modal" id="modal-block-large-at3" tabindex="-1" aria-labelledby="modal-block-large-at3" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="block block-rounded">
                                                            <div class="block-header block-header-default">
                                                                <h3 class="block-title">Answer Type: Incorrectly Used Literal Vocabulary Definition</h3>
                                                            </div>
                                                            <div class="block-content">
                                                                <div id="at3" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                        <div class="block-header block-header-default" role="tab" id="at3_description">
                                                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#at3" href="#at3_description-answer-type" aria-expanded="true" aria-controls="at3_description">Description</a>
                                                                        </div>
                                                                        <div id="at3_description-answer-type" class="collapse show" role="tabpanel" aria-labelledby="at3_description" data-bs-parent="#at3">
                                                                            <div class="block-content">
                                                                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content block-content-full text-end bg-body">
                                                                    <button type="button" class="btn btn-sm block-header-default text-white text-white" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            <div class="py-1">
                                                <p>0</p>
                                            </div>
                                        </td>
                                    </tr>
                
                                  <!-- END ANSWER Type 3 MODAL -->
                                </tbody>
                
                
                
                
                
                                
                
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('css/test-review.css') }}">

<style>
    .border-top-tr{
        border-top: 1px solid #ebeef2;
    }
</style>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/test-review.js') }}"></script>
@endsection