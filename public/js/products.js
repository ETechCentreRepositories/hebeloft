$(document).ready(function () {
    $("#image_add").change(function(){
        readURL(this);
    });

    $("#bulkUpdate10").click(function () {
        $.ajax({
            type: GET,
            url: "/products/updatePrice10%/",
            cache: false,
            datatype: JSON,
            success:function(response) {

            },
            error: function (obj, textStatus, errorThrown) {

            }
        });
    });

    $("#bulkUpdate20").click(function () {
        $.ajax({
            type: GET,
            url: "/products/updatePrice20%/",
            cache: false,
            datatype: JSON,
            success:function(response) {

            },
            error: function (obj, textStatus, errorThrown) {

            }
        });
    });

    $("#revert").click(function () {
        $.ajax({
            type: GET,
            url: "/products/revertPrice/",
            cache: false,
            datatype: JSON,
            success:function(response) {

            },
            error: function (obj, textStatus, errorThrown) {

            }
        });
    });
});



function readURL(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
            $('#addImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}