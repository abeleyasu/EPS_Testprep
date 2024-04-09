@extends('layouts.user')

@section('title', 'Student View Dashboard : CPS')

@section('page-script')
    <style>
        .modal-backdrop {
            background-color: rgba(0, 0, 0, .0001) !important;
        }
    </style>
@endsection
@section('user-content')
    <main id="main-container">
        <div class="modal d-block" id="staticBackdrop" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="background: #1414146b">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $test_info->title }}</h5>
                    </div>
                    <div class="modal-body">
                        {{-- @if ($test_info->format == 'DSAT' || $test_info->format == 'DPSAT') --}}
                            <a href="{{ route('single_test', ['id' => $test_info->id,'test_section' => 'proctored']) }}"
                                title="Take, time, and grade an official paper practice test." class="btn btn-secondary"
                                id="proctored">Start Proctored Section</a>
                        {{-- @else --}}
                            {{-- <a href="{{ route('single_test', ['id' => $test_info->id,'test_section' => 'proctored']) }}"
                                title="Take, time, and grade an official paper practice test."
                                class="btn btn-secondary">Start Proctored Section</a> --}}
                        {{-- @endif --}}
                        <a href="{{ route('single_test', ['id' => $test_info->id]) }}"
                            title="Grade a paper test you've already taken." class="btn btn-primary">Start Grade Section</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
