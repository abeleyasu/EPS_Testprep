$('button[type="button"]').click(function (e) {
    e.stopPropagation();
});

$(function () {
    var ref_this = "#btabs-animated-fade-home";
    $(".nav-tabs").on("click", function (e) {
        //debugger
        ref_this = $("ul.nav-tabs li button.active").attr("data-bs-target");
        if (ref_this !== "#btabs-animated-fade-home") {
            $(".generate_custom_quiz_two").hide();
        }
    });
    toastr.options = {
        closeButton: true,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    let selectedCategories = [];
    let selectedQuestionTypes = [];
    var count_data = {};
    $(".generate_custom_quiz_two").hide();
    $(".add_to_custom_quiz").change(function () {
        const element = $(this);
        const dataId = element.attr("data-category-id");
        const questionType = element.attr("data-question-type");
        if (element.is(":checked")) {
            //add
            selectedCategories.push(dataId);
            selectedQuestionTypes.push(questionType);
            getTypeFunctionality((res) => {
                count_data = res.count;
                $.each(res.count, function (i, v) {
                    $(`.diff_${i}`).html(`(${v.count})`);
                });
            });
        } else {
            //remove
            selectedCategories = selectedCategories.filter(
                (item) => item !== dataId
            );
            selectedQuestionTypes = selectedQuestionTypes.filter(
                (item) => item !== questionType
            );
        }

        if (
            selectedQuestionTypes.length == 0 &&
            selectedCategories.length == 0
        ) {
            $.each([1, 2, 3, 4, 5, 6], function (i, v) {
                $(`.diff_${v}`).html(`(${0})`);
                $(`#item-${v}`).prop("checked", false);
            });
        }
    });

    $(window).on("scroll", function () {
        if (ref_this === "#btabs-animated-fade-home") {
            if ($(this).scrollTop() < 5) {
                $(".generate_custom_quiz_two").hide();
                $(".generate_custom_quiz_one").show();
            }
            if ($(this).scrollTop() > 50) {
                $(".generate_custom_quiz_two").show();
                $(".generate_custom_quiz_one").hide();
            }
        }
    });

    function getMistakeTypeData(data, callback) {
        $.ajax({
            type: "POST",
            url: ADD_MISTAKE_TYPE_ROUTE,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: data,
            success: function (res) {
                callback(res);
            },
        });
    }
    getMistakeTypeData(
        {
            _token: $('meta[name="csrf-token"]').attr("content"),
            practice_test_section_id: PRACTICE_TEST_SECTION_ID,
        },
        (res) => {
            const mistake_type_count = res?.mistake_type_count;
            let tdata = "";
            for (item in mistake_type_count) {
                tdata += `<tr><td class="text-center">${item}</td><td class="text-center">${mistake_type_count[item]}</td></tr>`;
            }
            if (tdata) {
                $(".table-mistake-types").append(tdata);
            }
        }
    );

    $(".mistake-type").change(function () {
        getMistakeTypeData(
            {
                _token: $('meta[name="csrf-token"]').attr("content"),
                question_id: $(this).attr("data-question-id"),
                mistake_type: $(this).val(),
                practice_test_section_id: PRACTICE_TEST_SECTION_ID,
            },
            (res) => {
                const mistake_type_count = res?.mistake_type_count;
                let tdata = "";
                for (item in mistake_type_count) {
                    tdata += `<tr><td class="text-center">${item}</td><td class="text-center">${mistake_type_count[item]}</td></tr>`;
                }
                if (tdata) {
                    $(".table-mistake-types tbody").empty();
                    $(".table-mistake-types").append(tdata);
                } else {
                    $(".table-mistake-types tbody").empty();
                }
            }
        );
    });

    $("#generate-quiz").on("click", function (e) {
        e.preventDefault();

        let question_ids = [];

        let no_of_questions = $("#no_of_questions").val();

        let checkValue4 = [];

        $(".diff_rating :checkbox").each(function (i) {
            if ($(this).prop("checked")) {
                checkValue4.push($(this).val());
                question_ids = question_ids.concat(
                    count_data[i + 1]?.questions
                );
            }
        });

        if ($("#all_unanswered").is(":checked")) {
            question_ids = count_data[5]?.questions;
        } else {
            no_of_questions = "";
        }

        toastr.options = {
            progressBar: true,
            closeButton: true,
            timeOut: 4000,
        };
        if (
            selectedQuestionTypes.length == 0 &&
            selectedCategories.length == 0
        ) {
            toastr.error(
                "Please choose the category and question type from the review section!"
            );
        } else if (!question_ids || question_ids.length == 0) {
            toastr.error("No questions for this difficulty rating!");
        } else if (checkValue4.length == 0) {
            toastr.error("Please choose the difficulty rating!");
        } else {
            let questions_type = $(".questions_type").val();

            $.ajax({
                type: "POST",
                url: GETSELFMADEQUESTION_ROUTE,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    questions_type,
                    questions_type,
                    question_ids,
                    test_type: $("#test_type").val(),
                    section_type: $("#practice_test_type").val(),
                    no_of_questions,
                },
                success: function (res) {
                    if (res.status) {
                        let url = $("#site_url").val();
                        window.location.href = `${url}/user/practice-test-sections/${res.test_id}`;
                    } else {
                        toastr.options = {
                            progressBar: true,
                            closeButton: true,
                            timeOut: 4000,
                        };
                        toastr.error(
                            "No questions for this difficulty rating!"
                        );
                        return false;
                    }
                },
            });
        }
    });
    $(".selected-item").change(function () {
        getTypeFunctionality((res) => {
            count_data = res.count;
        });
    });

    function getTypeFunctionality(callback) {
        let diff_rating = [];
        $(".selected-item").each(function () {
            if ($(this).prop("checked")) {
                diff_rating.push($(this).val());
            }
        });

        $.ajax({
            type: "POST",
            url: GETTYPES_ROUTE,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                test_type: $("#test_type").val(),
                section_type: $("#practice_test_type").val(),
                super_category: [],
                question_category: selectedCategories,
                question_type: selectedQuestionTypes,
                diff_rating: diff_rating,
            },
            success: function (res) {
                callback(res);
            },
        });
    }
});
