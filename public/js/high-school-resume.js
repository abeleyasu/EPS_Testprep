$(document).ready(() => {
    $(".select").select2({
        tags: true
    })

    $(".form-drop").click(function() {
        $(".custom-dropdown-course").toggle();
    });

    $(document).mouseup(function (e) {
        if ($(e.target).closest(".custom-dropdown-course").length
                    === 0) {
            $(".custom-dropdown-course").hide();
        }
    });

    $(".form-college").click(function() {
        $(".custom-dropdown-college").toggle();
    });

    $(document).mouseup(function (e) {
        if ($(e.target).closest(".custom-dropdown-college").length
                    === 0) {
            $(".custom-dropdown-college").hide();
        }
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
    
    $('.social_link_div').append(html);
}

function removeLinks(data) {
    $(data).parents('.remove_links').remove();
}

