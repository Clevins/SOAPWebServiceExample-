$(document).ready(function () {
    $("#yearSelect").click(function () {
        ajaxGetBookYear($("#year1").val(), $("#year2").val());
    });
});


function init() {
    ajaxLoadData();
    ajaxLoadTags();
}

function ajaxLoadData() {

    $.ajax({
        type: "POST",
        url: "client.php",
        data: {data: "getAllBooks"},
        dataType: "html",
        success: function (result) {
            $("#books").html(result);
        }
    });
}

function ajaxLoadTags() {
    $.ajax({
        type: "POST",
        url: "client.php",
        data: {data: "getAllTags"},
        dataType: "html",
        success: function (result) {
            $("#tags").html(result);
        }

    });
}

function ajaxGetBookCategory(tags) {
    $.ajax({
        type: "POST",
        url: "client.php",
        data: {data: "getBookCategory", tagsValue: tags}, 
        dataType: "html",
        success: function (result) {
            $("#books").html(result);
        }

    });
}

function ajaxGetBookYear(year1, year2) {
    $.ajax({
        type: "POST",
        url: "client.php",
        data: {data: "getBookYear", yearValue1: year1, yearValue2: year2}, 
        dataType: "html",
        success: function (result) {
            $("#books").html(result);
        }
    });
}