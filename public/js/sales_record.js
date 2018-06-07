$(document).ready(function(){
    $('#search').click(function(){
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        console.log(startDate + endDate);
        $("#salesRecordContent").empty();
        $.ajax({
            type: "GET",
            url: "/ajax/salesOrder/date/" + startDate + "/" + endDate,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    $("#salesRecordContent").append(
                        "<tr><td>"+ response[i].date+"</td>"
                        + "<td>"+ response[i].status +"</td>"
                        + "<td>"+ response[i].status_name+"</td>"
                        + "@if ($users_id->roles_id == '1')"
                        + "<td><a href='/salesorder/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
                        + "@endif"
                    );
                }
            },

            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });
        
    $("#salesRecordSearchField").autocomplete({
        source: "{{URL::to('autocomplete-search')}}",
        minLength:1,
        select:function(key,value)
        {
            console.log(value);
        }
    });

    $('#refreshInventory').click(function(){
    });
});