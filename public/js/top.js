

$('.on_modal').on('click', function () {
    $("#modal").show();
    $("#update_post").val($(this).prev().text());
    $("#update_postid").val($(this).data("id"));
});

$('.off_modal').on('click', function () {
    $("#modal").hide();
});

$('.delete_post').on('click', function () {
    if (confirm('このつぶやきを削除します。よろしいでしょうか？')) {
        location.href = '/delete-post/' + $(this).data("id");
    } else {
        return false;
    }
});
