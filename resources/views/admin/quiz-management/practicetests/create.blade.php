@extends('layouts.admin')

@section('title', 'Admin Dashboard : Test')

@section('page-style')
    <style>
        .label-check{
            padding:4px;
        }
    </style>
<style>
	/* your CSS goes here*/
 body {
    background: #eee
}


h1 {
    text-align: center
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa
}

input.invalid {
    background-color: #ffdddd
}

.tab {
    display: none
}

button {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer
}

button:hover {
    opacity: 0.8
}

#prevBtn {
    background-color: #bbbbbb
}

.step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5
}

.step.active {
    opacity: 1
}

.step.finish {
    background-color: #4CAF50
}

.all-steps {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px
}

.thanks-message {
    display: none
}

.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}


/* Hide the browser's default radio button */

.container input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}


/* Create a custom radio button */

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}


/* On mouse-over, add a grey background color */

.container:hover input~.checkmark {
    background-color: #ccc;
}


/* When the radio button is checked, add a blue background */

.container input:checked~.checkmark {
    background-color: #2196F3;
}


/* Create the indicator (the dot/circle - hidden when not checked) */

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}


/* Show the indicator (dot/circle) when checked */

.container input:checked~.checkmark:after {
    display: block;
}


/* Style the indicator (dot/circle) */

.container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
</style>
@endsection
@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form action="{{route('practicetests.store')}}" method="POST" id="regForm">
        @csrf
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Dynamic Table Full -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Add Practice Tests</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!----------------->
							
							<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12">
                <div class="all-steps" id="all-steps" style="display: none;"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
                <div class="tab">
                    <div class="row mb-4">
						<div class="col-md-12 mb-2">
							<label class="form-label">Name:</label>
							<input type="text" class="form-control test_title" placeholder="Enter practice test name" name="title" value=""/>
						</div>
						<div class="col-md-12">
							<label class="form-label">Test Type:</label>
							<select id="format" name="format" class="form-control">
								@foreach($testformats as $key=>$testformat)
								<option value="{{$key}}">{{$testformat}}</option>
								@endforeach
							</select>
						</div>
					</div>
                </div>
                <div class="tab">
                    <div class="mb-2 mb-4">
						<label for="testdescription" class="form-label">Description:</label>
						<textarea id="js-ckeditor-desc" name="description" class="form-control form-control-lg form-control-alt" id="description" name="description" placeholder="Description" ></textarea>
						@error('description')
							<div class="invalid-feedback">{{$message}}</div>
						@enderror
					</div>
					<div class="col-md-12 col-xl-12 mb-4">
						<button type="button" class="btn w-25 btn-alt-success add_question_modal_btn">
							<i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question
						</button>
					</div>
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button> </div>
                </div>
        </div>
    </div>
</div>
                            <!----------------->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<!-- END Main Container -->
<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<div class="row">
					<div class="mb-2">
						<label class="form-label">Question Type:</label>
						<select id="format" name="questionformat" class="form-control">
							@foreach($questionformats as $key=>$questionformat)
							<option value="{{$key}}">{{$questionformat}}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label">Tests:</label>
						<select id="practicetestid" name="testid" class="form-control">
							@foreach($tests as $key=>$test)
							<option value="{{$test->id}}">{{$test->title}}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-2 mb-4">
						<label for="description" class="form-label">Description:</label>
						<textarea id="js-ckeditor-que-desc" name="questiondescription" class="form-control form-control-lg form-control-alt" id="description" name="description" placeholder="Description" ></textarea>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary save_question">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->


@endsection
@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>
	<script>
		var allowedContent = true;
		CKEDITOR.replace( 'js-ckeditor-desc',{
			extraPlugins: 'oembed,colorbutton,colordialog,font',
			allowedContent
		});
		CKEDITOR.replace( 'js-ckeditor-que-desc',{
			extraPlugins: 'oembed,colorbutton,colordialog,font',
			allowedContent
		});
		$('.add_question_modal_btn').click(function() {
			var title = $('.test_title').val();
			if ( $("#practicetestid option[value=0]").length > 0 ){
				$("#practicetestid option[value=0]").remove();
			}
			$('#practicetestid').append('<option value="0" selected>'+title+'</option>');
			$('#questionModal').modal('show');
		});
		$('.save_question').click(function() {
			var format = $('#format').val();
			var practicetestid = $('#practicetestid').val();
			var description = CKEDITOR.instances['js-ckeditor-que-desc'].getData();
			$.ajax({
                data:{
					'format': format,
					'practicetestid': practicetestid,
					'description': description,
					'_token': $('input[name="_token"]').val()
				},
                url: '{{route("addPracticeQuestion")}}',
                method: 'post',
                success: (res) => {
					alert('Question Added');
                }
            });
		});
	</script>
<script>
	//your javascript goes here
var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {


    showTab(currentTab);

});

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";

		//$('#nextBtn').prop('type', 'submit');
    } else {
		document.getElementById("nextBtn").innerHTML = "Next";
        //$('#nextBtn').prop('type', 'button');
    }
    fixStepIndicator(n)
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        // return false;
        //alert("sdf");
		
        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";




    }
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }
    if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish"; }
    return valid;
}

function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); }
    x[n].className += " active";
}
</script>

    <script>
        var order = 0;
        var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });
        One.helpersOnLoad(['js-ckeditor']);

        function openOrderDialog() {
            $('#listWithHandle').empty();

            let module_id = $('#module_id').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/modules/${module_id}/questions`,
                method: 'post',
                success: (res) => {
                    res.data.forEach(i => {

                        $('<div class="list-group-item">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary" value="'+i.id+'">'+i.title+'</button>\n' +
                            '</div>').appendTo('#listWithHandle');
                    });

                    myModal.show();
                }
            });
        }

        function saveOrder() {
            $('#order').val(order);
            myModal.hide();
        }

        function showDetail(id) {
            $('.milestone-detail'+id).collapse('toggle')
        }

        // List with handle
        Sortable.create(listWithHandle, {
            handle: '.glyphicon-move',
            animation: 150,
            onEnd: function(evt) {
                let data = {
                    new_index: evt.newIndex+1,
                    old_index: evt.oldIndex+1,
                    item: evt.item.children[1].value
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/questions/${data.item}/reorder`,
                    method: 'post',
                    data:data,
                    success: (res) => {

                    },
                    error: () => {
                        alert('Something went wrong')
                    }
                });
            }
        },);

    </script>
@endsection
