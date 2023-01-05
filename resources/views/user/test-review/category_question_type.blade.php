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
                            <h2 class="fs-base lh-base fw-medium text-muted mb-0">
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
                        <h3 class="block-title">(BEST SO FAR..) QUESTION TYPE CATEGORIZATION</h3>
                    </div>
                    <div class="block-content">
                        <div class="block-content p-0">       
        
                            <div class="tab-content" id="myTabContent">
                                <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                    <div class="accordion accordionExample">
        
                                        {{-- accordian tab 1 --}}
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                <table>
                                                    <tr >
                                                        <td class="text-center">
                                                            <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                        </td>
                                                        <td class="pl-4">
                                                            <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Category Type">CT</button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ct1" class="btn btn-dark fs-xs fw-semibold me-1">Arithmetic</button>

                                                            <!-- MODAL -->
                                                            <div class="modal" id="modal-block-large-ct1" tabindex="-1" aria-labelledby="modal-block-large-ct1" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="block block-rounded">
                                                                            <div class="block-header block-header-default">
                                                                                <h3 class="block-title">Arithmetic </h3>
                                                                            </div>
                                                                            <div class="block-content">
                                                                                <p class="fs-sm mb-0">
                                                                                </p>
                                                                        
                                                                                <div class="row items-push">
                                                                                    <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">Description</h3>
                                                                                            <div class="block-options">
                                                                                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p>other words</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                        
                                                                            <div class="block-content block-content-full text-end bg-body">
                                                                                <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             <!-- END MODAL -->

                                                            <div class="text-white text-start mt-2 incorrect">
                                                                2 Incorrect
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                <div class="odd">    
                                                    <div class="fw-semibold fs-sm">
                                                       <div>
                                                            <div>
                                                                <div class="odd p-3 ps-4">
                                                                    <div></div>
                                            
                                                                    <div class="fw-semibold fs-sm">
                                                                        <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Arithmetic Operations</button>
                                                
                                                                        <!-- MODAL -->
                                                                        <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="block block-rounded">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">Arithmetic Operations</h3>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p class="fs-sm mb-0"></p>
                                                                                
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Description</h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p>words</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                        
                                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END MODAL -->
                                                                        
                                                                        <div class="text-danger">
                                                                            1 Incorrect
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="border-top-tr p-3 ps-4">
                                                                    <div></div>
                                                                    <div class="fw-semibold fs-sm">
                                                                        <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1qt2" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Order of Operations</button>
                                        
                                                                        <!-- MODAL -->
                                                                        <div class="modal" id="modal-block-large-cg1ct1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1qt2" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="block block-rounded">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">Order of Operations</h3>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p class="fs-sm mb-0"></p>
                                                                                
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Description</h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p>words dddd</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                        
                                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END MODAL -->
                                                                        <div class="text-danger">
                                                                        1 Incorrect
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- END accordian tab 1 --}}

                                        {{-- accordian tab 2 --}}
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                <table>
                                                    <tr >
                                                        <td class="text-center">
                                                            <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                        </td>
                                                        <td class="pl-4">
                                                            <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Category Type">CT</button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ct1" class="btn btn-dark fs-xs fw-semibold me-1">Fractions</button>

                                                            <!-- MODAL -->
                                                            <div class="modal" id="modal-block-large-ct1" tabindex="-1" aria-labelledby="modal-block-large-ct1" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="block block-rounded">
                                                                            <div class="block-header block-header-default">
                                                                                <h3 class="block-title">FRACTIONS </h3>
                                                                            </div>
                                                                            <div class="block-content">
                                                                                <p class="fs-sm mb-0">
                                                                                </p>
                                                                        
                                                                                <div class="row items-push">
                                                                                    <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">Description</h3>
                                                                                            <div class="block-options">
                                                                                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p>frac words</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                        
                                                                            <div class="block-content block-content-full text-end bg-body">
                                                                                <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             <!-- END MODAL -->

                                                            <div class="text-white text-start mt-2 incorrect">
                                                                4 Incorrect
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                <div class="odd">    
                                                    <div class="fw-semibold fs-sm">
                                                       <div>
                                                            <div>
                                                                <div class="odd p-3 ps-4">
                                                                    <div></div>
                                            
                                                                    <div class="fw-semibold fs-sm">
                                                                        <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct2qt1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Converting Between Fractions, Decimals, and Percents</button>
                                                
                                                                        <!-- MODAL -->
                                                                        <div class="modal" id="modal-block-large-cg1ct2qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct2qt1" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="block block-rounded">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">Converting Between Fractions, Decimals, and Percents</h3>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p class="fs-sm mb-0"></p>
                                                                                
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Description</h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p>conv frac words</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                        
                                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END MODAL -->
                                                                        
                                                                        <div class="text-danger">
                                                                            3 Incorrect
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="border-top-tr p-3 ps-4">
                                                                    <div></div>
                                                                    <div class="fw-semibold fs-sm">
                                                                        <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct2qt2" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Find New Value</button>
                                        
                                                                        <!-- MODAL -->
                                                                        <div class="modal" id="modal-block-large-cg1ct2qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1ct2qt2" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="block block-rounded">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">ORDER OF OPERATIONS</h3>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p class="fs-sm mb-0"></p>
                                                                                
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Description</h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p>new words dddd</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                        
                                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END MODAL -->
                                                                        <div class="text-danger">
                                                                        1 Incorrect
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- END accordian tab 2 --}}
                                    </div>
                                </div>
                            </div>
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