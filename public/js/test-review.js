$('button[type="button"]').click(function (e) {
    e.stopPropagation();
});

$(function () {
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
        extendedTimeOut: "10000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    let selectedCategories = [];
    let selectedQuestionTypes = [];
    $(".generate_custom_quiz_two").hide();
    $(".add_to_custom_quiz").change(function () {
        console.log(
            $(this).val(),
            $(this).attr("data-category-id"),
            $(this).is(":checked")
        );
        const element = $(this);
        const dataId = element.attr("data-category-id");
        const questionType = element.attr("data-question-type");
        if (element.is(":checked")) {
            //add
            selectedCategories.push(dataId);
            selectedQuestionTypes.push(questionType);
        } else {
            //remove
            selectedCategories = selectedCategories.filter(
                (item) => item !== dataId
            );
            selectedQuestionTypes = selectedQuestionTypes.filter(
                (item) => item !== questionType
            );
        }
    });

    $(window).on("scroll", function () {
        if ($(this).scrollTop() < 5) {
            $(".generate_custom_quiz_two").hide();
            $(".generate_custom_quiz_one").show();
        }
        if ($(this).scrollTop() > 50) {
            $(".generate_custom_quiz_two").show();
            $(".generate_custom_quiz_one").hide();
        }
    });

    $("#generate_custom_quiz").on("click", function (e) {
        e.preventDefault();
        const test_type = $("#test_type").val();
        const test_id = $("#test_id").val();
        if (selectedCategories.length > 0) {
            $.ajax({
                type: "post",
                url: "/user/generate-custom-quiz",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    selectedCategories,
                    selectedQuestionTypes,
                    test_type,
                    test_id,
                },
                success: function (res) {
                    window.location.href = `/user/practice-test-sections/${res.test_id}`;
                },
            });
        } else {
            toastr.error("Please select atleast 1 option to continue.");
        }
        console.log(selectedCategories);
    });
});
