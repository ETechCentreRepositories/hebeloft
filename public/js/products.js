$(document).ready(function () {
    $("#image_add").change(function(){
        readURL(this);
    });

    $("#bulkUpdate10").click(function () {
        $.ajax({
            type: "GET",
            url: "/products/updatePrice10/",
            cache: false,
            datatype: JSON,
            success:function(response) {
                console.log(response);

                var mysql = require('mysql');

                var con = mysql.createConnection({
                    host: "127.0.0.1",
                    user: "root",
                    password: "",
                    database: "hebeloft"
                });

                con.connect(function(err) {
                    if (err) throw err;
                    con.query("SELECT * FROM products", function (err, result, fields) {
                        if (err) throw err;
                        console.log(result);
                    });
                });
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });

    $("#bulkUpdate20").click(function () {
        $.ajax({
            type: "GET",
            url: "/products/updatePrice20/",
            cache: false,
            datatype: JSON,
            success:function(response) {
                console.log(response);

                var mysql = require('mysql');

                var con = mysql.createConnection({
                    host: "127.0.0.1",
                    user: "root",
                    password: "",
                    database: "hebeloft"
                });

                con.connect(function(err) {
                    if (err) throw err;
                    con.query("SELECT * FROM products", function (err, result, fields) {
                        if (err) throw err;
                        console.log(result);
                    });
                });
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });

    $("#revert").click(function () {
        $.ajax({
            type: "GET",
            url: "/products/revertPrice/",
            cache: false,
            datatype: JSON,
            success:function(response) {
                console.log(response);
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
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