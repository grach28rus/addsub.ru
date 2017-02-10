$(document).ready(function () {
    $(document).on('click', '#action-delete', actionDelete);
});

function actionDelete() {
    var button = $(this);
    var url = '/' + button.data('controller') + '/delete';
    var id = button.data('id');
    var hiddenElement = $(this).parents('tr');
    $.post(url, {id: id}, function (data) {
        data = JSON.parse(data);
        if (data.success) {
            hiddenElement.hide("slow");
            toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');
        }
    })
}