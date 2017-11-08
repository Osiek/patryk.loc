$(function(ready){
    $('#model_name').change(function() {
        //alert($(this).find(":selected").val());
        $("#version_name").load("load_data.php?type=version&parentid="+$('#model_name').find(":selected").val());
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

    $('.table tr').click(function(event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });

    $("input[type='checkbox']").change(function (e) {
        if ($(this).is(":checked")) { //If the checkbox is checked
            $(this).closest('tr').addClass("danger");
            //Add class on checkbox checked
        } else {
            $(this).closest('tr').removeClass("danger");
            //Remove class on checkbox uncheck
        }
    });

});