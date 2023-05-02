@extends('layouts.user')

@section('title', 'College Application DeadLine : CPS')

@section('user-content')
<style>
    .over_content {
        margin-left: 23px;
        margin-bottom: 0px;
    }
</style>
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        <div class="bg-black-10">
            <div class="content content-full content-flex">
                <div>
                    <h1 class="h2 text-white">Cost Comparison Tool</h1>
                </div>
            </div>
        </div>
    </div>
    <p class="over_content mt-2">Enter cost for each college <span><u>PER YEAR.</u></span> This is to calculate annual cost, Not total 4 years cost.</p>
    <div class="block block-rounded college-application-wrapper">
        <div class="block-header block-header-default block-header-main">
            <h3 class="block-title">DIRECT COLLEGE COMPARISON: COST & AID</h3>
        </div>
        <div class="block-content">
            <form>
                <table class="js-table-sections table">
                    <thead class="js-table-sections-header table-default-active">
                        <tr>
                            <td class="text-center" style="width:80px">
                                <i class="fa fa-angle-right"></i>
                            </td>
                            <td class="fw-semibold fs-sm" colspan="5">
                                COMPARISON SUMMARY
                            </td>

                        </tr>
                    </thead>
                    <tbody class="table table-border">
                        <tr class="">
                            <td>COLLEGE</td>
                            <td>DIRECT COST</td>
                            <td>MERID AID</td>
                            <td>NEED-BASED AID</td>
                            <td>OUTSIDE SCHLORSHIP AID/YEAR</td>
                            <td>COST OF ATTENDENCE/YEAR</td>
                        </tr>
                        <tr>
                            <td>St John's</td>
                            <td>$66,370</td>
                            <td>$31,500</td>
                            <td>$0</td>
                            <td>$0</td>
                            <td>$34,874</td>
                        </tr>
                        <tr>
                            <td>Temple University</td>
                            <td>$43,230</td>
                            <td>$12,500</td>
                            <td>$0</td>
                            <td>$0</td>
                            <td>$30,730</td>
                        </tr>
                        <tr>
                            <td>Lowa University</td>
                            <td>$43,792</td>
                            <td>$24,500</td>
                            <td>$0</td>
                            <td>$0</td>
                            <td>$19,292</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</main>

<!--Add New College Modal -->
<div class="modal" id="add_new_college" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Header</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    ......
                </div>
                <div class="block-content block-content-full text-end">
                    <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn submit-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Add New College Modal -->
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/college-application-deadline.css') }}">

@endsection

@section('user-script')
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    $('.date-own').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-3d'
    });


    $(document).ready(function() {
        $('#College_checkAll').click(function() {
            $('.form-check-input_all').prop('checked', this.checked);
        });

        $('.form-check-input_all').change(function() {
            var check = ($('.form-check-input_all').filter(":checked").length == $('.form-check-input_all').length);
            $('#College_checkAll').prop("checked", check);
        });
    });

    $(document).ready(function() {
        $('#College_checkAll1').click(function() {
            $('.form-check-input_all1').prop('checked', this.checked);
        });

        $('.form-check-input_all1').change(function() {
            var check = ($('.form-check-input_all1').filter(":checked").length == $('.form-check-input_all1').length);
            $('#College_checkAll1').prop("checked", check);
        });
    });
</script>
<script>
    One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);
</script>
<script>
    // <![CDATA[  <-- For SVG support
    if ('WebSocket' in window) {
        (function() {
            function refreshCSS() {
                var sheets = [].slice.call(document.getElementsByTagName("link"));
                var head = document.getElementsByTagName("head")[0];
                for (var i = 0; i < sheets.length; ++i) {
                    var elem = sheets[i];
                    var parent = elem.parentElement || head;
                    parent.removeChild(elem);
                    var rel = elem.rel;
                    if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                        "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                            .valueOf());
                    }
                    parent.appendChild(elem);
                }
            }
            var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
            var address = protocol + window.location.host + window.location.pathname + '/ws';
            var socket = new WebSocket(address);
            socket.onmessage = function(msg) {
                if (msg.data == 'reload') window.location.reload();
                else if (msg.data == 'refreshcss') refreshCSS();
            };
            if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                console.log('Live reload enabled.');
                sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
            }
        })();
    } else {
        console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
    }
    // ]]>
</script>
@endsection