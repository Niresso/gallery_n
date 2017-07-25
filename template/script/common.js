// show form addPicture

$(document).ready(function () {
    $('#btn-add-picture').click(function () {
        document.getElementById("add-pictures").style.display = "block";//показать
    })
});
// show form update
$(document).ready(function () {
    $("#btn-sort").click(function () {
        jQuery.ajax({
            url: '/components/response.php',
            type: "POST",
            dataType: "html",
            data: {update: 1},
            success: function (response) {
                result = jQuery.parseJSON(response);

                $("div#gallery").empty();
                document.getElementById("add-pictures").style.display = "none";
                var aa = null;
                for (var n = 0; n < result.length; n++) {
                    aa += $('#gallery').append("<div class='col-lg-4' id='helped_" + result[n].id + "'>" + result[n].date
                        + "<p><img src='/template/images/pic" + result[n].id + "." + result[n].format
                        + "' width='300' height='220' alt='' /></p><textarea cols='40' class='comment' id='commentid-"
                        + result[n].id + "'>" + result[n].comment
                        + "</textarea><br /><a href='#' id='del-" + result[n].id + "' class='btn btn-primary'>Delete</a>"
                    );
                }
            }
        });
    });
});

// show form sort date

$(document).ready(function () {
    $("#btn-sort-date").click(function () {
        jQuery.ajax({
            url: '/components/response.php',
            type: "POST",
            dataType: "html",
            data: {date: 1},
            success: function (response) {
                result = jQuery.parseJSON(response);

                $("div#gallery").empty();
                document.getElementById("add-pictures").style.display = "none";
                var aa = null;
                for (var n = 0; n < result.length; n++) {
                    aa += $('#gallery').append("<div class='col-lg-4' id='helped_" + result[n].id + "'>" + result[n].date
                        + "<p><img src='/template/images/pic" + result[n].id + "." + result[n].format
                        + "' width='300' height='220' alt='' /></p><textarea cols='40' class='comment' id='commentid-"
                        + result[n].id + "'>" + result[n].comment
                        + "</textarea><br /><a href='#' id='del-" + result[n].id + "' class='btn btn-primary'>Delete</a>"
                    );
                }
            }
        });
    });
});

// show form sort size

$(document).ready(function () {
    $("#btn-sort-size").click(function () {
        jQuery.ajax({
            url: '/components/response.php',
            type: "POST",
            dataType: "html",
            data: {size: 1},
            success: function (response) {
                result = jQuery.parseJSON(response);

                $("div#gallery").empty();
                document.getElementById("add-pictures").style.display = "none";
                var aa = null;
                for (var n = 0; n < result.length; n++) {
                    aa += $('#gallery').append("<div class='col-lg-4' id='helped_" + result[n].id + "'>" + result[n].date
                        + "<p><img src='/template/images/pic" + result[n].id + "." + result[n].format
                        + "' width='300' height='220' alt='' /></p><textarea cols='40' class='comment' id='commentid-"
                        + result[n].id + "'>" + result[n].comment
                        + "</textarea><br /><a href='#' id='del-" + result[n].id + "' class='btn btn-primary'>Delete</a>"
                    );
                }
            }
        });
    });
});

// add Picture

$(document).ready(function () {
    $('#ajax_form').on('submit', function (e) {
        e.preventDefault();
        var $that = $(this),
            formData = new FormData($that.get(0));
        $.ajax({
            url: '/components/response.php',
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: "html",
            success: function (response) {
                result = jQuery.parseJSON(response);
                if (result.status === 0) {
                    $("#exampleInputTextarea").val('');
                    $("#exampleInputFile").val('');
                    $("#exampleInputName").val('');
                    document.getElementById("add-pictures").style.display = "none";
                } else {
                    alert('Размер файла превышает больше 1МБ');
                }

            }
        });
    });
});

// delete picture and update comment

$("body").on("click", ".col-lg-4 a", function (e) {
    e.preventDefault();
    var clickedID = this.id.split("-");
    var DbNumberID = clickedID[1];
    var myData = 'recordToDelete=' + DbNumberID;

    jQuery.ajax({
        type: "POST",
        url: '/components/response.php',
        dataType: "text",
        data: myData,
        success: function () {
            $('#helped_' + DbNumberID).fadeOut("slow");
        }
    });
}).on("blur", ".col-lg-4 .comment", function (e) {
    e.preventDefault();
    var clickedID = this.id.split("-");
    var DbNumberID = clickedID[1];
    var Date = $(this).text();
    var comment = $('#commentid-' + DbNumberID).val();
    if (Date !== comment) {
    jQuery.ajax({
        type: "POST",
        url: '/components/response.php',
        dataType: "text",
        data: {id: DbNumberID, comm: comment},
        success: function () {
            alert('Вы изменили комментарий!');

        }
    });}
});



