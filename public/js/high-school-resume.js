$(document).ready(() => {
    $(".select").select2({
        tags: true,
    });
});

function addLinks(data) {
    let html = ``;
    html += `<div class="row p-0 mt-3 remove_links">`;
    html += `<div class="col-lg-11">`;
    html += `<input type="text" class="form-control" name="social_links" placeholder="Enter Social links">`;
    html += `</div>`;
    html += `<div class="col-lg-1">`;
    html += `<a href="javascript:void(0)" class="add-btn" onclick="removeLinks(this)">`;
    html += `<i class="fa-solid fa-minus"></i>`;
    html += `</a>`;
    html += `</div>`;
    html += `</div>`;

    $(".social_link_div").append(html);
}

function removeLinks(data) {
    $(data).parents(".remove_links").remove();
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

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}