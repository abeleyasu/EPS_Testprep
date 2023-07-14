$('button[type="button"]').click(function (e) {
    e.stopPropagation();
});

$(function () {
    let selectedCategories = [];
    $(".generate_custom_quiz_two").hide();
    $(".add_to_custom_quiz").change(function () {
        console.log(
            $(this).val(),
            $(this).attr("data-category-id"),
            $(this).is(":checked")
        );
        const element = $(this);
        const dataId = element.attr("data-category-id");
        if (element.is(":checked")) {
            //add
            selectedCategories.push(dataId);
        } else {
            //remove
            selectedCategories = selectedCategories.filter(
                (item) => item !== dataId
            );
        }
    });

    $(window).scroll(function () {
        console.log($(this).scrollTop());
        if ($(this).scrollTop() == 0) {
            $(".generate_custom_quiz_two").hide();
            $(".generate_custom_quiz_one").show();
        }
        if ($(this).scrollTop() > 135) {
            $(".generate_custom_quiz_two").show();
            $(".generate_custom_quiz_one").hide();
        }
    });

    $("#generate_custom_quiz").click(function (e) {
        e.preventDefault();
        const test_type = $("#test_type").val();
        const test_id = $("#test_id").val();
        if (selectedCategories) {
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
                    test_type,
                    test_id,
                },
                success: function (res) {
                    window.location.href = `/user/practice-test-sections/${res.test_id}`;
                },
            });
        }
        console.log(selectedCategories);
    });
});
