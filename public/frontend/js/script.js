$(document).ready(function () {
    $("nav form .key").keyup(function () {
        var pattern = $(this).val();
        if (pattern) {
            $.ajax({
                type: "GET",
                url: "san-pham/search",
                data: { pattern: pattern }
            })
                .done(function (data) {
                    $(".search-result").html(data);
                    $(".search-result").show();
                    console.log(data);
                });
        }

    });
});
