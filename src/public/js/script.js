$(document).ready(function() {
    $('#commentForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/comments/create',
            data: $(this).serialize(),
            success: function(response) {
                // обновление списка комментариев
                location.reload();
            },
            error: function(xhr) {
                alert('Ошибка: ' + xhr.responseText);
            }
        });
    });
});

function deleteComment(id) {
    $.ajax({
        type: 'POST',
        url: '/comments/delete/' + id,
        success: function() {
            location.reload();
        },
        error: function(xhr) {
            alert('Ошибка: ' + xhr.responseText);
        }
    });
}