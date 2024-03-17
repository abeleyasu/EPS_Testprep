function getApplicationDeadlineOrganizerData() {
    $.ajax({
        url: core.applicationOrganizer,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function (data) {
        if (data.success) {
            if (data.data.length > 0) {
                setApplicationHTML(data.data)
            } else {
                $('#userSelectedCollegeList').html('<div class="no-data">No record found.</div>')
            }
        }
    })
}

function setApplicationHTML(records) {
    $('#userSelectedCollegeList').html('')
    const csrf = $('meta[name="csrf-token"]').attr('content')
    for (let i = 0; i < records.length; i++) {
        const data = records[i]
        let content = ''

        content += `
            <form id="form-${i}" method="POST" data-id="${data.id}">
                <input type="hidden" name="_token" value="${csrf}">
                <input type="hidden" name="college_detail_id" value="${data.college_deadline.id}">

                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-tab row ${data.college_deadline.is_application_checklist == 1 ? 'bg-success' : ''}" id="block-header-${i}">
                        <div class="col-10" type="button" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="true">
                            <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-angle-right" id="toggle${i}"></i><i class="fa fa-bars fa-2x"></i>${data.college_name}</a>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-alt-danger hide-college-from-list me-2" data-id="${data.id}">Hide</button>
                            <button type="button" class="btn btn-sm btn-alt-danger remove-user-college" data-type="college-application-deadline" data-id="${data.id}">Remove</button>
                            ${data.college_deadline.is_application_checklist == 1 ? '<i class="fa fa-2x fa-circle-check text-white"></i>' : ''}
                        </div>
                    </div>
                    <div id="collapse${i}" class="collapse" aria-labelledby="headingOne" data-id="${i}" data-college="${data.college_deadline.id}" data-parent=".accordionExample">
                    </div>
                </div>
            </form>
        `
        $('#userSelectedCollegeList').append(content)
    }
}

function getStatsOption(options, selectedvalue) {
    let option = '';
    option += `<option value="">Select One</option>`
    for (let i = 0; i < options.length; i++) {
        option += `<option value="${options[i]}" ${selectedvalue == options[i] ? 'selected' : ''}>${options[i]}</option>`
    }
    return option;
}

function getAvailableTypesOfApplication(collegeData) {
    const type_of_application = ['common_app', 'coalition_app', 'universal_app', 'college_system_app', 'apply_directly']
    const available_type_of_application = type_of_application.filter((item) => {
        if (collegeData[item] == 1) {
            return item
        }
    })
    return available_type_of_application
}

const typeOfApplications = [{
    name: 'common_app',
    label: 'Common App'
}, {
    name: 'coalition_app',
    label: 'Coalition App'
}, {
    name: 'universal_app',
    label: 'Universal App'
}, {
    name: 'college_system_app',
    label: 'College System App'
}, {
    name: 'apply_directly',
    label: 'Apply Directly'
}]

const getOptionsTypeOfApplications = (options, selectedValue) => {
    let option = '';
    option += `<option value="">Select One</option>`
    for (let i = 0; i < options.length; i++) {
        const opt = options[i]
        option += `<option value="${opt.name}" ${selectedValue == opt.name ? 'selected' : ''}>${opt.label}</option>`
    }
    return option;
}

function convertUnderscoredToSpace(str) {
    return str.replace(/_/g, ' ')
}

function populateApplicationDeadline(collegeInformation) {
    if (collegeInformation.AP_DL_EACT_DAY && collegeInformation.AP_DL_EACT_MONTH) {
        // Function Name: generateDate
        // Function Arguments: day, month
        // Return Type of Function: Date (dd/mm/yyyy) based on the day and month and if the year is not provided then it will take the current year and if the date has passed then it will take the next year
        function generateDate(day, month) {
            let year = new Date().getFullYear()
            let date = new Date(year, month - 1, day)
            if (date < new Date()) {
                year++
                date = new Date(year, month - 1, day)
            }
            return date
        }

    }

}
function generateDate(day, month) {
    let year = new Date().getFullYear()
    let date = new Date(year, month - 1, day)
    if (date < new Date()) {
        year++
        date = new Date(year, month - 1, day)
    }
    return date
}

function getDateInDMYFormat(date) {
    let d = new Date(date)
    let month = d.getMonth() + 1
    let day = d.getDate()
    let year = d.getFullYear()
    return `${day}/${month}/${year}`
}




function getSingleApplicationData(dataset, staticdata, elementid) {
    One.layout('header_loader_on');
    $.ajax({
        url: core.getSingleApplicationOrganizer.replace(':id', dataset.college),
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done((response) => {
        if (response.success) {
            const data = response.data
            $('#toggle' + dataset.id).removeClass('fa-angle-right').addClass('fa-angle-down');
            $('#' + elementid).html('')
            let content = '';
            // let availableTypesOfApplication = (getAvailableTypesOfApplication(data.college_details.college_information))
            // console.log('getSingleApplicationData', data)
            // console.log(getDateInDMYFormat(generateDate(15,9)))
            // console.log(generateDate(15,1))

            // filter typeOfApplications by data.college_details.college_information
            const filteredTypeOfApplications = typeOfApplications.filter((item) => {
                if (data.college_details.college_information[item.name] === 1) {
                    return item
                }
            })
            // console.log('filteredTypeOfApplications', filteredTypeOfApplications)


            content += `
                <div class="college-content-wrapper college-content">
                    <div class="row mb-3 list-content">
                        <label class="form-label" for="type_of_application-${dataset.id}">Type of Application</label>
                        <div class="col-10">
                            <select class="form-select update-form" id="type_of_application-${dataset.id}" name="type_of_application" data-index="${dataset.id}">
                                ${getOptionsTypeOfApplications(filteredTypeOfApplications, data.type_of_application)}
                            </select>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <label class="form-label" for="admission_option-${dataset.id}">Admission Open</label>
                        <div class="col-10">
                            <select class="form-select update-form" id="admission_option-${dataset.id}" name="admission_option" data-index="${dataset.id}">
                                ${getStatsOption(staticdata.admision_option, data.admission_option)}
                            </select>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <label class="form-label" for="number_of_essaya-${dataset.id}">Number of Essays</label>
                        <div class="col-10">
                            <select class="form-select update-form" id="number_of_essaya-${dataset.id}" name="number_of_essaya" data-index="${dataset.id}">
                                ${getStatsOption([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15], data.number_of_essaya)}
                            </select>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="admissions_deadline-${dataset.id}">Admissions Deadline</label>
                                    <input type="text" class="date-own form-control update-form" id="admissions_deadline-${dataset.id}" data-index="${dataset.id}" value="${data.admissions_deadline ? data.admissions_deadline : 'mm/dd/yy'}" name="admissions_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="ad_status">Status</label>
                                    <select class="form-select update-form" id="ad_status" name="ad_status" data-index="${dataset.id}">
                                        ${getStatsOption(staticdata.college_list_status, data.ad_status)}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="competitive_scholarship_deadline-${dataset.id}">Competitive Scholarship Deadline</label>
                                    <input type="text" class="date-own form-control update-form" id="competitive_scholarship_deadline-${dataset.id}" data-index="${dataset.id}" value="${data.competitive_scholarship_deadline ? data.competitive_scholarship_deadline : ''}" name="competitive_scholarship_deadline" placeholder="mm/dd/yy" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="csd_status">Status</label>
                                    <select class="form-select update-form" id="csd_status" name="csd_status" data-index="${dataset.id}">
                                        ${getStatsOption(staticdata.college_list_status, data.csd_status)}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="departmental_scholarship_deadline-${dataset.id}">Departmental/STEM Scholarship Deadline</label>
                                    <input type="text" class="date-own form-control update-form" id="departmental_scholarship_deadline-${dataset.id}" data-index="${dataset.id}" value="${data.departmental_scholarship_deadline ? data.departmental_scholarship_deadline : ''}" name="departmental_scholarship_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="dsd_status">Status</label>
                                    <select class="form-select update-form" id="dsd_status" name="dsd_status" data-index="${dataset.id}">
                                        ${getStatsOption(staticdata.college_list_status, data.dsd_status)}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="honors_college_deadline-${dataset.id}">Honors College Deadline</label>
                                    <input type="text" class="date-own form-control update-form" id="honors_college_deadline-${dataset.id}" data-index="${dataset.id}" value="${data.honors_college_deadline ? data.honors_college_deadline : ''}" name="honors_college_deadline" placeholder="mm/dd/yy" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="hcd_status">Status</label>
                                    <select class="form-select update-form" id="hcd_status" name="hcd_status" data-index="${dataset.id}">
                                        ${getStatsOption(staticdata.college_list_status, data.hcd_status)}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="fafsa_deadline-${dataset.id}">FAFSA Deadline</label>
                                    <input type="text" class="date-own form-control update-form" id="fafsa_deadline-${dataset.id}" data-index="${dataset.id}" value="${data.fafsa_deadline ? data.fafsa_deadline : ''}" name="fafsa_deadline" placeholder="mm/dd/yy" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="fafsa_status">Status</label>
                                    <select class="form-select update-form" id="fafsa_status" name="fafsa_status" data-index="${dataset.id}">
                                        ${getStatsOption(staticdata.college_list_status, data.fafsa_status)}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3 list-content">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="css_profile_deadline-${dataset.id}">CSS Profile Deadline</label>
                                    <input type="text" class="date-own form-control update-form" id="css_profile_deadline-${dataset.id}" data-index="${dataset.id}" value="${data.css_profile_deadline ? data.css_profile_deadline : ''}" name="css_profile_deadline" placeholder="mm/dd/yy" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="css_status">Status</label>
                                    <select class="form-select update-form" id="css_status" name="css_status" data-index="${dataset.id}">
                                        ${getStatsOption(staticdata.college_list_status, data.css_status)}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all application_checklist" id="is_application_checklist-${dataset.id}" name="is_application_checklist" ${data.is_application_checklist == 1 ? 'checked' : ''} value="${data.is_application_checklist}" type="checkbox">
                            <b class="ml-4">Application Checklist Complete</b>
                            <i class="fa fa-2x fa-circle-info" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Checklist Information" data-bs-content="Once all of the checkboxes below are checked off, this checkbox will automatically be checked."></i>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_completed_application-${dataset.id}" value="${data.is_completed_application}" ${data.is_completed_application == 1 ? 'checked' : ''} name="is_completed_application" type="checkbox">
                            Completed College Application?
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_request_pay-${dataset.id}" name="is_request_pay" ${data.is_request_pay == 1 ? 'checked' : ''} value="${data.is_request_pay}" type="checkbox">
                            Request & pay for test scores (if applicable) to be sent to the colleges you will apply to
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_high_school_transcript-${dataset.id}" name="is_high_school_transcript" ${data.is_high_school_transcript == 1 ? 'checked' : ''} value="${data.is_high_school_transcript}" type="checkbox">
                            Pay the high school transcript submittal fee (This varies by high school)
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_letter_of_recommedation-${dataset.id}" name="is_letter_of_recommedation" ${data.is_letter_of_recommedation == 1 ? 'checked' : ''} value="${data.is_letter_of_recommedation}" type="checkbox">
                            Request letters of recommedation from your teachers and outside recommenders
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_your_offical_high_school_transcripts-${dataset.id}" name="is_your_offical_high_school_transcripts" ${data.is_your_offical_high_school_transcripts == 1 ? 'checked' : ''} value="${data.is_your_offical_high_school_transcripts}" type="checkbox">
                            Confirm that your official high school transcripts have been sent by your high school's counseling office
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_school_report_and_counselor-${dataset.id}" name="is_school_report_and_counselor" ${data.is_school_report_and_counselor == 1 ? 'checked' : ''} value="${data.is_school_report_and_counselor}" type="checkbox">
                            Confirm that the school report and counselor recommendation have been sent by your high school's counseling office
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_test_scores_sent-${dataset.id}" name="is_test_scores_sent" ${data.is_test_scores_sent == 1 ? 'checked' : ''} value="${data.is_test_scores_sent}" type="checkbox">
                            Confirm that your test scores have been sent
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_letters_of_recommendation_submitted-${dataset.id}" name="is_letters_of_recommendation_submitted" ${data.is_letters_of_recommendation_submitted == 1 ? 'checked' : ''} value="${data.is_letters_of_recommendation_submitted}" type="checkbox">
                            Confirm that your letters of recommendation have been submitted
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_pay_application_fee-${dataset.id}" name="is_pay_application_fee" ${data.is_pay_application_fee == 1 ? 'checked' : ''} value="${data.is_pay_application_fee}" type="checkbox">
                            Pay application fee
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-check-input form-check-input_all app-checklist status application-${dataset.id}" data-index="${dataset.id}" id="is_submit_application-${dataset.id}" name="is_submit_application" ${data.is_submit_application == 1 ? 'checked' : ''} value="${data.is_submit_application}" type="checkbox">
                            Submit application
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col d-flex">
                            <input class="form-check-input form-check-input_all app-checklist inline-block me-1 status application-${dataset.id}" data-index="${dataset.id}" id="is_received_application-${dataset.id}" name="is_received_application" ${data.is_received_application == 1 ? 'checked' : ''} value="${data.is_received_application}" type="checkbox">
                            After you submit your application, set up your student portal to confirm that the college has received your application and required documentation <br>
                            (Usually the college will send you an email with directions on how to set up your student portal once they've received your application)
                        </div>
                    </div>
                </div>
                <script>
                // console.log(${dataset.id})
                $.ajax({
                    url: core.getSingleApplicationOrganizer.replace(':id', ${dataset.id}),
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done((response) => {
                    if (response.success) {
                        const data = response.data;
                        console.log(data);
                    }
                });

                document.getElementById('admission_option-${dataset.id}').addEventListener('change', function(element){
                    console.log(
                        element.target.value
                    );
                    if(element.target.value == 'Early Action'){
                    }
                });
                // Attach Event Listener to admission_option
                </script>
            `
            $('#' + elementid).append(content)
            $('.date-own').datepicker({
                format: 'mm-dd-yyyy',
                // startDate: '-3d',
                autoclose: true
            });
            One.layout('header_loader_off');
        }
    })
}
