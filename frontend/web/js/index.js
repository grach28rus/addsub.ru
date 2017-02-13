$(document).ready(function () {
    $(document).on('click', '#submit-form', submitForm);
    $(document).on('click', 'a.action-link', actionLink);
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
    var url = $(this).attr('href');
    $.post(url, function (data) {
        data = JSON.parse(data);
        if (data.success) {
            $('#content-data').html(data.actionTemplate);
        } else {
            toastr.error(data.messages);
        }
    });
}

function submitForm(e) {
    e.preventDefault();
    var form = $(this).parents('form');
    var formAction = form.attr('action');
    var formId = form.attr('id');
    var formData = getMapAusForm(formId, true);
    $.post(formAction, formData, function (data) {
        data = JSON.parse(data);
        if (data.success) {
            $('#content-data').html(data.actionTemplate);
            toastr.success(data.messages);
        } else {
            toastr.error(data.messages);
        }
    });
}

function actionDelete() {
    var button = $(this);
    var id = button.data('id');
    var url = '/' + button.data('controller') + '/delete?id=' + id;
    var hiddenElement = $(this).parents('tr');
    $.post(url, {id: id}, function (data) {
        console.log('dfv', data);
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
