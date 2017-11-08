function loadVersions() {
    $( "#version_name" ).empty();
    var jqxhr = $.getJSON( "load_data.php?type=version&parentid="+$('#model_name').find(":selected").val(), function() {
        console.log( "success" );
    });
    jqxhr.done(function (data) {
        $.each(data, function (i, item) {
            $( "#version_name" ).append("<option value=" + item.id + ">"+item.name+"</option>");
            console.log( item.id + "; " + item.name );
        })
    })
}

function loadModels() {
    $( "#model_name" ).empty();
    var jqxhr = $.getJSON( "load_data.php?type=model&parentid="+$('#make_name').find(":selected").val(), function() {
        console.log( "success" );
    });
    jqxhr.done(function (data) {
        $.each(data, function (i, item) {
            $( "#model_name" ).append("<option value=" + item.id + ">"+item.name+"</option>");
            console.log( item.id + "; " + item.name );
        })
        loadVersions();
    })

}

$(function(ready){
    $('#make_name').change(function() {
        loadModels();
    });

    $('#model_name').change(function() {
        loadVersions();
    });

    $(document).ready(function () {
        loadModels();
        loadVersions();
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

    $("#deleteForm").submit(function() {
        if ($("input[type='submit']").val() == "Usuń") {
            var c = confirm("Czy jesteś pewien, że chcesz usunąć wybrane wpisy?");
            return c;
        }
    });

});