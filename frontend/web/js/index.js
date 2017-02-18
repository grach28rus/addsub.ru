$(document).ready(function () {
    $(document).on('click', '#submit-form', submitForm);
    $(document).on('click', 'a.action-link', actionLink);
    $(document).on('click', '#action-delete', actionDelete);
    $(document).on('click', '#log-out', actionLogout);
    $(document).on('click', 'a.change-language', actionChangeLanguage);
    $(document).on('change', '.change-filter', actionSearch);

    getStatistics();
});

function actionLogout(e) {
    e.preventDefault();
    $.post('/logout', function (data) {
    })
}

function actionLink(e) {
    e.preventDefault();
    var url = $(this).attr('href');

    Pace.track(function(){
        $.post(url, function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $('#content-data').html(data.actionTemplate);
            } else {
                toastr.error(data.messages);
            }
        });
    });
}

function submitForm(e) {
    e.preventDefault();
    var form = $(this).parents('form');
    var formAction = form.attr('action');
    var formId = form.attr('id');
    var formData = getMapAusForm(formId, true);
    Pace.track(function(){
        $.post(formAction, formData, function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $('#content-data').html(data.actionTemplate);
                toastr.success(data.messages);
            } else {
                toastr.error(data.messages);
            }
        });
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

function actionSearch() {
    var formID = $(this).parents('form').attr('id');
    var url = $(this).parents('form').attr('action');
    var dataForm = getMapAusForm(formID, true);
    Pace.track(function(){
        $.post(url, dataForm, function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $('div.table-result-search').html(data.actionTemplate);
            } else {
                toastr.error(data.messages);
            }
        });
    });
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

function getStatistics() {
    $.post('/site/get-statistics', function (data) {
        data = JSON.parse(data);
        var balance = data.add - data.sub;
        $('#balance').html(balance + 'p.');
        $('#add').html(data.add + 'p.');
        $('#sub').html(data.sub + 'p.');
        var categories = data.category;
        var doughnutData = [];
        var i = 0;
        var colorRed = randomColor({
            count: 100,
            hue: 'red'
        });
        var colorGreen = randomColor({
            count: 100,
            hue: 'green'
        });
        var color;
        for(var category in categories) {
            var categoryData = categories[category];
            color = colorRed[i]
            if (categoryData.add) {
                color = colorGreen[i]
            }
            doughnutData[i] = {
                value: categoryData.count,
                color: color,
                highlight: "#1ab394",
                label: category
            };
            i++;
        }
        console.log('mas', color);
        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 3,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
        };

        var ctx = document.getElementById("doughnutChart").getContext("2d");
        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);
    });

}

function actionChangeLanguage(e) {
    e.preventDefault();
    var language = $(this).data('lang');
    $.get('/site/set-language', {lang: language});
}