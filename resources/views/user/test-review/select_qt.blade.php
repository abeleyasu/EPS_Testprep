@extends('layouts.user')

@section('title', 'Question & Concept Review : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                        <div class="flex-grow-1">
                            <h1 class="h3 fw-bold mb-2 w-75">
                                All Tests Insight Reports

                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <label class="fw-bold mb-3 fs-3">Select Format</label>
                    <select class="form-select" id="test-select" aria-label="Default select example">
                        <option selected disabled>Select Format</option>
                        <option value="ACT">ACT</option>
                        <option value="SAT">SAT</option>
                        <option value="PSAT">PSAT</option>
                        <option value="DSAT">DSAT</option>
                        <option value="DPSAT">DPSAT</option>
                    </select>

                </div>
                <div class="col-md-6">
                    <label class="fw-bold mb-3 fs-3">Select Test</label>
                    <select class="form-select" id="test-name" aria-label="Default select example"></select>
                </div>
            </div>
            <div class='col-md-12 text-end mt-3'>
                <button id="show-results-btn" class="btn btn-primary" style="display: none;">Get Insights</button>
            </div>

            @if (Session::has('error'))
                <div class="alert alert-danger mt-3">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
    </main>
    <style>
        .custom-loader {
            width: 50px;
            height: 50px;
            display: grid;
            border-radius: 50%;
            -webkit-mask: radial-gradient(farthest-side, #0000 40%, #000 41%);
            background: linear-gradient(0deg, #766DF480 50%, #766DF4FF 0) center/4px 100%,
                linear-gradient(90deg, #766DF440 50%, #766DF4BF 0) center/100% 4px;
            background-repeat: no-repeat;
            animation: s3 1s infinite steps(12);
            position: fixed;
            top: 50%;
            left: 50%;
            visibility: hidden;
        }

        .custom-loader::before,
        .custom-loader::after {
            content: "";
            grid-area: 1/1;
            border-radius: 50%;
            background: inherit;
            opacity: 0.915;
            transform: rotate(30deg);
        }

        .custom-loader::after {
            opacity: 0.83;
            transform: rotate(60deg);
        }

        @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
@endsection
@section('page-script')

    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        $('#test-select').change(function() {
            var selectedFormat = $(this).val();
            // AJAX request to fetch tests for the selected format
            $.ajax({
                url: '/user/get-tests',
                method: 'GET',
                data: {
                    format: selectedFormat
                },
                success: function(response) {
                    if (Array.isArray(response)) {
                        // Clear existing options
                        $('#test-name').empty();

                        // Add the "All Test" option at the top
                        $('#test-name').append('<option value="">Select Test</option>');
                        $('#test-name').append('<option value="all">All Test</option>');

                        // Populate options based on the response
                        response.forEach(function(test) {
                            $('#test-name').append(
                                `<option value="${test.id}">${test.title}</option>`);
                        });
                    } else {
                        console.error('Invalid response format:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        });

        $('#test-name').change(function() {
            // Check if any option is selected
            if ($(this).val() !== '') {
                // If an option is selected, show the button
                $('#show-results-btn').show();
            } else {
                // If no option is selected, hide the button
                $('#show-results-btn').hide();
            }
        });
        $('#show-results-btn').click(function() {
            // Check if any option is selected in #test-name dropdown
            const selectedTest = $('#test-name').val();
            const selectedFormat = $('#test-select').val();
            // console.log(selectedTest);
            // Check if selectedTest is "All Test"
            if (selectedTest === 'all') {
                // If selectedTest is "All Test", redirect accordingly
                $('.custom-loader').css('visibility', 'visible');
                $('#test-select').prop('disabled', true);
                $('#test-name').prop('disabled', true);
                $('#show-results-btn').prop('disabled', true);
                window.location.href = `/user/test-prep-insights?test=${selectedFormat}`;
            } else {
                // Otherwise, redirect to the selected test
                $('.custom-loader').css('visibility', 'visible');
                $('#test-select').prop('disabled', true);
                $('#test-name').prop('disabled', true);
                $('#show-results-btn').prop('disabled', true);
                window.location.href =
                    `/user/single/test-prep-insights?test=${selectedFormat}&testid=${selectedTest}`;
            }
        });
    </script>
@endsection
