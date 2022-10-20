

$('.on_modal').on('click', function () {
    $("#modal").show();
    $("#update_post").val($(this).prev().text());
    $("#update_postid").val($(this).data("id"));
});

$('.off_modal').on('click', function () {
    $("#modal").hide();
});
