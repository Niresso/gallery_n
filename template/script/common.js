

$(document).ready(function () {
    $('#btn-add-picture').click(function () {
        document.getElementById("add-pictures").style.display="block";//показать
    })
});

$( document ).ready(function() {
    $("#btn-sort").click(function(){
        jQuery.ajax({
            url:     '/components/response.php',
            type:     "POST",
            dataType: "html",
            data: 'json',
            success: function(response) {
                result = jQuery.parseJSON(response);

                $("div#gallery").empty();
                document.getElementById("add-pictures").style.display="none";
                var aa = null;
                for (var n=0; n<result.length;n++){
                    aa += $('#gallery').append("<div class='col-lg-4'>"+ result[n].date
                        + "<p><img src='/template/images/pic"+result[n].id+"."+result[n].format
                        +"' width='300' height='220' alt='' /></p>" + result[n].comment
                        + "<br /><a href='/delete/"
                        + result[n].id + "' class='btn btn-primary'>Delete</a>"
                    );
                }
            }
        });
    });
});

$( document ).ready(function() {
    $("#btn-sort-date").click(function(){
        jQuery.ajax({
            url:     '/components/response-sort-date.php',
            type:     "POST",
            dataType: "html",
            data: 'json',
            success: function(response) {
                result = jQuery.parseJSON(response);

                $("div#gallery").empty();
                document.getElementById("add-pictures").style.display="none";
                var aa = null;
                for (var n=0; n<result.length;n++){
                    aa += $('#gallery').append("<div class='col-lg-4'>"+ result[n].date
                        + "<p><img src='/template/images/pic"+result[n].id+"."+result[n].format
                        +"' width='300' height='220' alt='' /></p>" + result[n].comment
                        + "<br /><a href='/delete/"
                        + result[n].id + "' class='btn btn-primary'>Delete</a>"
                    );
                }
            }
        });
    });
});

$( document ).ready(function() {
    $("#btn-sort-size").click(function(){
        jQuery.ajax({
            url:     '/components/response-sort-size.php',
            type:     "POST",
            dataType: "html",
            data: 'json',
            success: function(response) {
                result = jQuery.parseJSON(response);

                $("div#gallery").empty();
                document.getElementById("add-pictures").style.display="none";
                var aa = null;
                for (var n=0; n<result.length;n++){
                    aa += $('#gallery').append("<div class='col-lg-4'>"+ result[n].date
                        + "<p><img src='/template/images/pic"+result[n].id+"."+result[n].format
                        +"' width='300' height='220' alt='' /></p>" + result[n].comment
                        + "<br /><a href='/delete/"
                        + result[n].id + "' class='btn btn-primary'>Delete</a>"
                    );
                }
            }
        });
    });
});



$(function(){
    $('#ajax_form').on('submit', function(e){
        e.preventDefault();
        var $that = $(this),
            formData = new FormData($that.get(0));
        $.ajax({
            url:  '/components/add_form.php',
            type:     "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: "html",
            success:function(response){
                result = jQuery.parseJSON(response);
                if(  result.status === 0 ){
                    $("#exampleInputTextarea").val('');
                    $("#exampleInputFile").val('');
                    $("#exampleInputName").val('');
                    document.getElementById("add-pictures").style.display="none";
                }else {
                    alert('Размер файла превышает больше 1МБ');
                }

            }
        });
    });
});


$("body").on("click", ".col-lg-4 a", function(e) {
    e.preventDefault();
    var clickedID = this.id.split("-"); //Разбиваем строку (Split работает аналогично PHP explode)
    var DbNumberID = clickedID[1]; //и получаем номер из массива
    var myData = 'recordToDelete='+ DbNumberID; //выстраиваем  данные для POST

    jQuery.ajax({
        type: "POST", // HTTP метод  POST или GET
        url: '/components/delete.php', //url-адрес, по которому будет отправлен запрос
        dataType:"text", // Тип данных
        data:myData, //post переменные
        success:function(){
            // в случае успеха, скрываем, выбранный пользователем для удаления, элемент
            $('#helped_'+DbNumberID).fadeOut("slow");
        }
    });
});