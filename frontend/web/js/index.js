$(document).ready(function () {
    $(document).on('click', '#actionForm', actionForm);
    $(document).on('click', '#action-delete', actionDelete);
    var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July", 'lol'],
        datasets: [
            {
                label: "Example dataset",
                fillColor: "rgba(200,150,100,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 60, 81, 56, 55, 150]
            },
            {
                label: "Example dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.7)",
                pointColor: "rgba(26,179,148,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };

    var lineOptions = {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true,
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
});

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
