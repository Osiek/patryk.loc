$(function(ready){
    $('#model_name').change(function() {
        //alert($(this).find(":selected").val());
        $("#model_name").load("load_data.php?type=model&parentid="+$('#make_name').find(":selected").val(), function () {
            $("#version_name").load("load_data.php?type=version&parentid="+$('#model_name').find(":selected").val());
        });
    });

    //Gdy zmienia się producent samochodu
    $('#make_name').change(function() {
        //alert($(this).find(":selected").val());
        $("#model_name").load("load_data.php?type=model&parentid="+$('#make_name').find(":selected").val(), function () {
            $("#version_name").load("load_data.php?type=version&parentid="+$('#model_name').find(":selected").val());
        });
    });

    $(document).ready(function () {
        console.log( "ready!" );
        $("#model_name").load("load_data.php?type=model&parentid="+$('#make_name').find(":selected").val(), function () {
            $("#version_name").load("load_data.php?type=version&parentid="+$('#model_name').find(":selected").val());
        });

    })
});

$(document).ajaxStop(function () {
    // 0 === $.active
});