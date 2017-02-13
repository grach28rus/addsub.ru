$(document).ready(function () {
    $(document).on('click', '#actionForm', actionForm);
    $(document).on('click', '#action-delete', actionDelete);
    $(document).on('click', '#log-out', actionLogout);
});

function actionLogout(e) {
    e.preventDefault();
    $.post('/logout', function (data) {
    })
}

function actionLink(e) {
    e.preventDefault();
    var url = $(this).data('href');
    $.post(url, function (data) {
        data = JSON.parse(data);
        if (data.success) {
            toastr.success(data.messages);
        } else {
            toastr.error(data.messages);
        }
    })
}

function actionForm() {
    var form = $('#' + $(this).data('form_id'));
    var formUrl = $(this).data('url');
    var operation = $(this).data('operation');
    form.attr('action', formUrl);
    if ( form.attr('action') == formUrl) {
        form.submit();
    }
}

function actionDelete() {
    var button = $(this);
    var id = button.data('id');
    var url = '/' + button.data('controller') + '/delete?id=' + id;
    var hiddenElement = $(this).parents('tr');
    $.post(url, {id: id}, function (data) {
        data = JSON.parse(data);
        if (data.success) {
            hiddenElement.hide("slow");
            toastr.success(data.messages);
        } else {
            toastr.error(data.messages);
        }
    })
}

function pushUrl(url) {
    history.pushState(null, '', url);
}

function getMapAusForm(id, isSetOnly) {
    var map = {},
        nodes = document.getElementById(id).elements,
        i1 = 0,
        currentNode;
    while (currentNode = nodes[i1++]) {
        switch (currentNode.nodeName.toLowerCase()) {
            case 'input':
                if ('checkbox' === currentNode.type.toLowerCase()) {
                    if (isSetOnly && !currentNode.checked) {
                        break;
                    }
                    map[currentNode.name] = currentNode.checked;
                    break;
                }
                if (currentNode.value.length) {
                    map[currentNode.name] = currentNode.value;
                }
                break;
            case 'textarea':
                if (currentNode.value.length) {
                    map[currentNode.name] = currentNode.value;
                }
                break;
            case 'select':
                if (currentNode.value.length) {
                    map[currentNode.name] = currentNode.value;
                }
                break;
        }
    }

    return map;
}
