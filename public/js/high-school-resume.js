
// social links 
function addLinks(data) {

    let $count = $(data).attr("data-count");
        $count++;

    let value = $('.social_link_div .row:nth-last-child(1) .col-lg-11 input').val();
    if (value == '') {
        toastr.error('Please fill up a current row of social links!');
    } else {
        let html = ``;
        html += `<div class="row p-0 mt-3 remove_links">`;
        html += `<div class="col-lg-11">`;
        html += `<input type="text" class="form-control social_links" name="social_links[${$count}][link]" placeholder="Enter Social links">`;
        html += `</div>`;
        html += `<div class="col-lg-1">`;
        html += `<a href="javascript:void(0)" class="add-btn" onclick="removeLinks(this)">`;
        html += `<i class="fa-solid fa-minus"></i>`;
        html += `</a>`;
        html += `</div>`;
        html += `</div>`;

        $(".social_link_div").append(html);

        $(data).attr('data-count', $count);
    }

    let social_links = $('input[name^="social_links"]');

    social_links.filter('input[name$="[link]"]').each(function() {
        $(this).rules("add", {
            url: true,
            messages: {
                "url": "Social link must be a valid url"
            }
        });
    });
}

function removeLinks(data) {
    $(data).parents(".remove_links").remove();
}

function dropdown_lists(url)
{
    let site_url = $('#site_url').val();
    let option = ``;
    return $.ajax({
        url: `${site_url}${url}`,
        type: "GET",
        async: true,
        dataType: "JSON",
    }).then((resp) => {
        if (resp.success) {
            $(resp.dropdown_list).each((index,value) => {
                option += `<option value="${value.id}">`;
                option += `${value.name}`;
                option += `</option>`;
            });
            return option;
        } else {
            return option;
        }
    });
}

// course data
async function addCourseData(data){
    let $count = $(data).attr("data-count");
        $count++;

    let value = $('.course_table tbody tr:nth-last-child(1) td input').val();
    if (value == '') {
        toastr.error('Please fill up a current row of courses!.');
    } else {
        let html = ``;
            html += `<tr class="course_data_table_row remove_courses">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="course_name_${$count}" name="course_data[${$count}][course_name]" placeholder="Ex: College English 101">`;
            html += `</td>`;
            html += `<td class="select2-container_main select2-container_main-position">`;
            html += `<select class="js-select2 select" multiple="multiple" name="course_data[${$count}][search_college_name][]" id="search_college_name_${$count}" data-placeholder="Select college name" disabled>`;
            html += await dropdown_lists(`/user/colleges/list`);
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" data-count="${$count}" onclick="removeCourses(this)" class="add-btn d-flex plus-icon">`;
            html += `<i class="fa-solid fa-minus"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;
    
        $('.course_table tbody').append(html);

        $(document).ready(() => {
            $(`#search_college_name_${$count}`).select2({
                tags: true,
                placeholder: "Select search college name",
            });            
        });

        let course_name = $(`#course_name_${$count}`).val();
    
        $(`#course_name_${$count}`).change(function(){
            course_name = $(`#course_name_${$count}`).val();
            if(course_name != ''){
                $(`#search_college_name_${$count}`).removeAttr('disabled');
                $(`#search_college_name_${$count}`).attr('required','true');

                // $(`#search_college_name_${$count}`).rules("add",{
                //     required: true,
                //     messages: {
                //         required: "search college name is required"
                //     }
                // })
            }else{
                $(`#search_college_name_${$count}`).attr('disabled','true');

            }
        });

        $(data).attr('data-count', $count);
    }
}

function removeCourses(data) {
    $(data).parents(".remove_courses").remove();
}

// Honors data
async function addHonorCourseData(data){
    let $count = $(data).attr("data-count");
        $count++;

        $(document).ready(() => {
            $(`#honor_course_data_${$count}`).select2({
                tags: true,
                placeholder: "Select honor course name",
            });
        })

    let value = $('.honors_table tr:nth-last-child(1) td select').val();
    if (value == '') {
        toastr.error('Please fill up a current row of honor courses!');
    } else {
        let html =``;
            html += `<tr class="honor_course_data_table_row remove_honors_courses"> `;
            html += `<td class="select2-container_main select2-container_main-position">`;
            html += `<select class="js-select2 select" data-placeholder="Select honor course name" multiple="multiple" name="honor_course_data[${$count}][course_data][]" id="honor_course_data_${$count}">`;
            html += await dropdown_lists(`/user/honors/courses/list`);
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i data-count="${$count}" class="fa-solid fa-minus" onclick="removeHonorsCourses(this)"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.honors_table tbody').append(html);  

        $(document).ready(() => {
            $(`#honor_course_data_${$count}`).select2({
                tags: true,
                placeholder: "Select honors course name",
            });
        })

        $(data).attr('data-count', $count);
    }  

   let honor_course_data = $('select[name^="honor_course_data"]');

    honor_course_data.filter('select[name$="[course_data][]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Honors course name field is required"
            }
        });
    });

}

function removeHonorsCourses(data) {
    $(data).parents(".remove_honors_courses").remove();
}

//Testing data
function addTestingData(data){
    let $count = $(data).attr('data-count');
        $count++;

        $(document).ready(() => {
            $(`#testing-date-${$count}`).datepicker({
                format: 'dd-mm-yyyy',
                endDate : '-1d'
            });
        });

    let value = $('.testing_data_table tr:nth-last-child(1) td input').val();
    if (value == '') {
        toastr.error('Please fill up a current row of testing!');
    } else {
        let html =``;
            html += `<tr class="testing_table_row remove_testing_data">`;
            html += `<td>`;
            html += `<select class="form-select" id="name_of_test" name="testing_data[${$count}][name_of_test]" style="width: 100%;">`;
            html += `<option value="">Select name of test</option>`;
            html += `<option value="PSAT">PSAT</option>`;
            html += `<option value="SAT">SAT</option>`;
            html += `<option value="ACT">ACT</option>`;
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="results_score" name="testing_data[${$count}][results_score]" placeholder="Enter Results score">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="testing-date-${$count}" name="testing_data[${$count}][date]" placeholder="Enter Date" autocomplete="off" readonly>`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i data-count="${$count}" class="fa-solid fa-minus" onclick="removeTestingData(this)"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;
        
        $('.testing_data_table tbody').append(html);

        $(data).attr('data-count', $count);
    } 

    let testing_data = $('input[name^="testing_data"]');

    $('select[name^="testing_data"]').filter('select[name$="[name_of_test]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Name of test field is required"
            }
        });
    });
    testing_data.filter('input[name$="[results_score]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Result score field is required"
            }
        });
    });
    testing_data.filter('input[name$="[date]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Date field is required"
            }
        });
    }); 

    $("#is_tested").click(function () {    
        if($(this).is(':checked')){ 
            $('select[name^="testing_data"]').filter('select[name$="[name_of_test]"]').each(function() {
                $(this).rules("add", {
                    required: false,
                });
            });
            testing_data.filter('input[name$="[date]"],input[name$="[results_score]"]').each(function() {
                $(this).rules("add", {
                    required: false
                });
            });
        }else{
            $('select[name^="testing_data"]').filter('select[name$="[name_of_test]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Name of test field is required"
                    }
                });
            });
            testing_data.filter('input[name$="[results_score]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Result score field is required"
                    }
                });
            });
            testing_data.filter('input[name$="[date]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Date field is required"
                    }
                });
            });
        }
    });
    
}

function removeTestingData(data){
    $(data).parents(".remove_testing_data").remove();
}
//Honors Academic Honors, Achievements & Other Awards data
async function addHonorsData(data){
    let $count = $(data).attr('data-count');
        $count++;

    let value = $('.table_honors_data tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of honors!');
    }else{
        let html = ``;
            html += `<tr class="honors_data_table_row remove_honors_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control"  name="honors_data[${$count}][position]" placeholder="Vice President" autocomplete="off">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" name="honors_data[${$count}][honor_achievement_award]" placeholder="Ex: National Honor Society">`;
            html += `</td>`;
            html += `<td class="select2-container_main">`;
            html += `<select class="js-select2" data-placeholder="Select Grade" id="honor_select_${$count}" name="honors_data[${$count}][grade][]" multiple="multiple">`;
            html += await dropdown_lists(`/user/grades/list`);
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" name="honors_data[${$count}][location]" placeholder="Ex: DRHS">`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn d-flex plus-icon">`;
            html += `<i class="fa-solid fa-minus" data-count="${$count}" onclick="removeHonorsData(this)"></i> `;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.table_honors_data tbody').append(html);

        $(document).ready(() => {
            $(`#honor_select_${$count}`).select2({
                tags: true,
            });
        })

        $(data).attr('data-count', $count);
    }
    let honors_data = $('input[name^="honors_data"]');

    honors_data.filter('input[name$="[position]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Position field is required"
            }
        });
    });
    honors_data.filter('input[name$="[honor_achievement_award]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Achivement awars field is required"
            }
        });
    });
    $('select[name^="honors_data"]').filter('select[name$="[grade][]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Grade field is required"
            }
        });
    });
    honors_data.filter('input[name$="[location]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Location field is required"
            }
        });
    });
    
}

function removeHonorsData(data){
    $(data).parents(".remove_honors_data").remove();
}

async function addDemonstratedData(data) {
    let $count = $(data).attr('data-count');
        $count++;

    let value = $('.table_demonstrated_data tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of demonstrated!');
    }else{
        let html = ``;
            html += `<tr class="demonstrated_data_table_row remove_demonstrated_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="position" name="demonstrated_data[${$count}][position]" placeholder="Vice President" autocomplete="off">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="interest" name="demonstrated_data[${$count}][interest]" placeholder="Enter Interest">`;
            html += `</td>`;
            html += `<td>`;
            html += `<select class="js-select2 select" id="demonstrated_select_${$count}" data-placeholder="Select Demonstrated Grade" name="demonstrated_data[${$count}][grade][]" multiple="multiple">`;
            html += await dropdown_lists(`/user/grades/list`);
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="location" name="demonstrated_data[${$count}][location]" placeholder="Enter Location">`;
            html += `</td>`;
            html += `<td>`;
            html += `<textarea class="form-control" id="details" name="demonstrated_data[${$count}][details]" rows="1" placeholder="Enter Details"></textarea>`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i data-count="${$count}" class="fa-solid fa-minus" onclick="removeDemonstratedData(this)"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.table_demonstrated_data tbody').append(html);

        $(document).ready(() => {
            $(`#demonstrated_select_${$count}`).select2({
                tags: true,
            });
        })

        $(data).attr('data-count', $count);
    }
}

function removeDemonstratedData(data) {
    $(data).parents(".remove_demonstrated_data").remove();
}

async function addLeadershipData(data) {
    let $count = $(data).attr('data-count');
        $count++;

    let value = $('.table_leadership_data tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of leadership!');
    }else{
        let html = ``;
            html += `<tr class="leadership_data_table_row remove_leadership_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="leadership_status" name="leadership_data[${$count}][status]" placeholder="Enter Status">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="leadership_position" name="leadership_data[${$count}][position]" placeholder="Vice President" autocomplete="off">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="leadership_organization" name="leadership_data[${$count}][organization]" placeholder="Enter Organization">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="leadership_location" name="leadership_data[${$count}][location]" placeholder="Ex: DRHS">`;
            html += `</td>`;
            html += `<td>`;
            html += `<select class="js-select2 select" data-placeholder="Select leadership Grade" id="leadership_select_${$count}" name="leadership_data[${$count}][grade][]" multiple="multiple">`;
            html += await dropdown_lists(`/user/grades/list`);
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i data-count="${$count}" class="fa-solid fa-minus" onclick="removeLeadershipData(this)"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.table_leadership_data tbody').append(html);

        $(document).ready(() => {
            $(`#leadership_select_${$count}`).select2({
                tags: true,
            });
        });

        $(data).attr('data-count', $count);
    }

}

function removeLeadershipData(data) {
    $(data).parents(".remove_leadership_data").remove();
}

async function addActivityData(data) {
    let $count = $(data).attr('data-count');
        $count++;

    let value = $('.table_activities_data tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of activities!');
    }else{
        let html = ``;
            html += `<tr class="activity_data_table_row remove_activity_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="activity_position" name="activities_data[${$count}][position]" placeholder="Vice President" autocomplete="off">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="activity" name="activities_data[${$count}][activity]" placeholder="Enter Activity">`;
            html += `</td>`;
            html += `<td>`;
            html += `<select class="js-select2 select" data-placeholder="Select activities Grade" id="activity_select_${$count}" name="activities_data[${$count}][grade][]" multiple="multiple">`;
            html += await dropdown_lists(`/user/grades/list`);
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="activity_location" name="activities_data[${$count}][location]" placeholder="Ex: DRHS">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="activity_honor_award" name="activities_data[${$count}][honor_award]" placeholder="Enter Honor/Award">`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i data-count="${$count}" class="fa-solid fa-minus" onclick="removeActivityData(this)"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.table_activities_data tbody').append(html);

        $(document).ready(() => {
            $(`#activity_select_${$count}`).select2({
                tags: true,
            });
        })

        $(data).attr('data-count', $count);
    }
}

function removeActivityData(data) {
    $(data).parents(".remove_activity_data").remove();
}

// addAthleticsData functions

async function addAthleticsData(data){
    let $count = $(data).attr('data-count');
        $count++;

    let value = $('.athletics_table tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of atheletics!');
    }else{
        let html = ``;
        html += `<tr class="athletics_data_table_row remove_athletics_data">`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="athletics_positions" name="athletics_data[${$count}][position]" placeholder="Vice President" autocomplete="off">`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="athletics_activity" name="athletics_data[${$count}][activity]" placeholder="Enter Activity">`;
        html += `</td>`;
        html += `<td>`;
        html += `<select class="js-select2 select" data-placeholder="Select atheletics Grade" id="athletics_select_${$count}" name="athletics_data[${$count}][grade][]" multiple="multiple">`;
        html += await dropdown_lists(`/user/grades/list`);
        html += `</select>`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="athletics_location" name="athletics_data[${$count}][location]" placeholder="Ex: DRHS">`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="athletics_honor" name="athletics_data[${$count}][honor]" placeholder="Enter Honor">`;
        html += `</td>`;
        html += `<td>`;
        html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
        html += `<i class="fa-solid fa-minus" data-count="${$count}" onclick="removeAthleticsData(this)"></i>`;
        html += `</a>`;
        html += `</td>`;
        html += `</tr>`;

        $('.athletics_table tbody').append(html);

        $(document).ready(() => {
            $(`#athletics_select_${$count}`).select2({
                tags: true
            });
        });
        
        $(data).attr('data-count', $count);
    }
}

function removeAthleticsData(data){
    $(data).parents(".remove_athletics_data").remove();

}

// Comunity service data

async function addCommunityData(data){
    let $count = $(data).attr('data-count');
    $count++;

    let value = $('.comunity_table tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of community services!');
    }else{
        let html = ``;

        html += `<tr class="community_data_table_row remove_comunity_data">`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="participation_level" name="community_service_data[${$count}][level]" placeholder="Enter Participation level">`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="community_service" name="community_service_data[${$count}][service]" placeholder="Enter Service">`;
        html += `</td>`;
        html += `<td>`;
        html += `<select class="js-select2 select" data-placeholder="Select community Grade" id="community_select_${$count}" name="community_service_data[${$count}][grade][]" multiple="multiple">`;
        html += await dropdown_lists(`/user/grades/list`);
        html += `</select>`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="community_location" name="community_service_data[${$count}][location]" placeholder="Enter Location">`;
        html += `</td>`;
        html += `<td>`;
        html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
        html += `<i class="fa-solid fa-minus" data-count="${$count}" onclick="removeCommunityData(this)"></i>`;
        html += `</a>`;
        html += `</td>`;
        html += `</tr>`;

        $('.comunity_table tbody').append(html);

        $(document).ready(() => {
            $(`#community_select_${$count}`).select2({
                tags: true
            });
        });

        $(data).attr('data-count', $count);
    }

}

function removeCommunityData(data){
    $(data).parents(".remove_comunity_data").remove();

}

// employment functions

async function addEmploymentData(data){
    let $count = $(data).attr('data-count');
    $count++;

    let value = $('.employement_table tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of employement!');
    }else{

        let html = ``;

        html += `<tr class="employment_data_table_row remove_employement_data">`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="name_of_company" name="employment_data[${$count}][name_of_company]" placeholder="Ex: Starbucks">`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="job_title" name="employment_data[${$count}][job_title]" placeholder="Enter Job title">`;
        html += `</td>`;
        html += `<td>`;
        html += `<select class="js-select2 select" data-placeholder="Select employment grade" id="employment_select_${$count}" name="employment_data[${$count}][grade][]" multiple="multiple">`;
        html += await dropdown_lists(`/user/grades/list`);
        html += `</select>`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="employment_location" name="employment_data[${$count}][location]" placeholder="Enter Location">`;
        html += `</td>`;
        html += `<td>`;
        html += `<input type="text" class="form-control" id="employment_honor_award" name="employment_data[${$count}][honor_award]" placeholder="Enter Honor / Award">`;
        html += `</td>`;
        html += `<td>`;
        html += `<a href="javascript:void(${$count})" class="add-btn plus-icon d-flex">`;
        html += `<i class="fa-solid fa-minus" data-count="${$count}" onclick="removeEmploymentData(this)"></i>`;
        html += `</a>`;
        html += `</td>`;
        html += `</tr>`;

        $('.employement_table tbody').append(html);

        $(document).ready(() => {
            $(`#employment_select_${$count}`).select2({
                tags: true
            });
        });

        $(data).attr('data-count', $count);
    }
}

function removeEmploymentData(data){
    $(data).parents(".remove_employement_data").remove();
}

// SignificantData function

async function addSignificantData(data)
{
    let $count = $(data).attr('data-count');
    $count++;

    let value = $('.significant_table tbody tr:nth-last-child(1) td input').val();
    
    if (value == '') {
        toastr.error('Please fill up a current row of significant!');
    }else{
        let html = ``;
            html += `<tr class="significant_data_table_row remove_significant_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="responsibility_interest" name="significant_data[${$count}][interest]" placeholder="Enter Responsibility/interest">`;
            html += `</td>`;
            html += `<td>`;
            html += `<select class="js-select2 select" data-placeholder="Select significant grade" id="significant_select_${$count}" name="significant_data[${$count}][grade][]" multiple="multiple">`;
            html += await dropdown_lists(`/user/grades/list`);
            html += `</select>`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="significant_location" name="significant_data[${$count}][location]" placeholder="Enter Location">`;
            html += `</td>`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="significant_honor_award" name="significant_data[${$count}][honor_award]" placeholder="Enter Honor / Award">`;
            html += `</td>`;
            html += `<td>                                                                `;
            html += `<a href="javascript:void(${$count})" class="add-btn plus-icon d-flex">`;
            html += `<i class="fa-solid fa-minus" data-count="${$count}" onclick="removeSignificantData(this)"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.significant_table tbody').append(html);

        $(document).ready(() => {
            $(`#significant_select_${$count}`).select2({
                tags: true
            });
        });

        $(data).attr('data-count', $count);
    }
}

function removeSignificantData(data) {
    $(data).parents(".remove_significant_data").remove();
}

function addFeaturedSkillData(data) {
    let $count = $(data).attr('data-count');
        $count++;

    let value = $('.featured_skill_table tbody tr:nth-last-child(1) td input').val();

    if (value == '') {
        toastr.error('Please fill up a current row of featured qualities!');
    }else{

        let html = ``;
            html += `<tr class="featured_skill_data_table_row remove_featured_skill_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="featured_skill" name="featured_skills_data[${$count}][skill]" placeholder="Enter Featured Qualities">`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i onclick="removeFeaturedSkillData(this)" data-count="${$count}" class="fa-solid fa-minus"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.featured_skill_table tbody').append(html);

        $(data).attr('data-count', $count);
    }
}

function removeFeaturedSkillData(data) {
    $(data).parents(".remove_featured_skill_data").remove();
}

function addFeaturedAwardData(data) {
    let $count = $(data).attr('data-count');
        $count++;
    let value = $('.featured_award_table tbody tr:nth-last-child(1) td input').val();

    if (value == '') {
        toastr.error('Please fill up a current row of featured awards!');
    }else{
        let html = ``;
            html += `<tr class="featured_award_data_table_row remove_featured_award_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="featured_award" name="featured_awards_data[${$count}][award]" placeholder="Enter Featured Award">`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i onclick="removeFeaturedAwardData(this)" data-count="${$count}" class="fa-solid fa-minus"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

        $('.featured_award_table tbody').append(html);

        $(data).attr('data-count', $count);
    }
}

function removeFeaturedAwardData(data) {
    $(data).parents(".remove_featured_award_data").remove();
}

function addDualCitizenShipData(data) {
    let $count = $(data).attr('data-count');
    $count++;

    let value = $('.dual_citizenship_table tbody tr:nth-last-child(1) td input').val();

    if (value == '') {
        toastr.error('Please fill up a current row of dual citizenship!');
    } else {
        let html = ``;
            html += `<tr class="dual_citizenship_table_table_row remove_dual_citizenship_data">`;
            html += `<td>`;
            html += `<input type="text" class="form-control" id="countries" name="dual_citizenship_data[${$count}][country]" placeholder="Ex: Canada">`;
            html += `</td>`;
            html += `<td>`;
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;
            html += `<i data-count="${$count}" onclick="removeDualCitizenShipData(this)" class="fa-solid fa-minus"></i>`;
            html += `</a>`;
            html += `</td>`;
            html += `</tr>`;

            $('.dual_citizenship_table tbody').append(html);

            $(data).attr('data-count', $count);
    }
}

function removeDualCitizenShipData(data) {
    $(data).parents(".remove_dual_citizenship_data").remove();
}

function addFeaturedLanguageData(data) {
    let $count = $(data).attr('data-count');
        $count++;

    let value = $('.featured_language_table tbody tr:nth-last-child(1) td input').val();

    if (value == '') {
        toastr.error('Please fill up a current row of featured languages!');
    }else{
        let html = ``;
            html += `<tr class="featured_language_data_table_row remove_featured_language_data">`;            
            html += `<td>`;            
            html += `<input type="text" class="form-control" id="featured_language" name="featured_languages_data[${$count}][language]" placeholder="Enter Language">`;            
            html += `</td>`;            
            html += `<td>`;            
            html += `<input type="text" class="form-control" id="languages_level" name="featured_languages_data[${$count}][level]" placeholder="Fluent">`;            
            html += `</td>`;            
            html += `<td>`;            
            html += `<a href="javascript:void(0)" class="add-btn plus-icon d-flex">`;            
            html += `<i data-count="${$count}" onclick="removeFeaturedLanguageData(this)" class="fa-solid fa-minus"></i>`;            
            html += `</a>`;            
            html += `</td>`;   
            html += `</tr>`;        
            
        $('.featured_language_table tbody').append(html);

        $(data).attr('data-count', $count);
    }
}

function removeFeaturedLanguageData(data) {
    $(data).parents(".remove_featured_language_data").remove();
}

var $disabledResults = $(".js-example-disabled-results");
$disabledResults.select2();

$("form").on("focus", "input[type=number]", function (e) {
    $(this).on("wheel.disableScroll", function (e) {
        e.preventDefault();
    });
});
$("form").on("blur", "input[type=number]", function (e) {
    $(this).off("wheel.disableScroll");
});
