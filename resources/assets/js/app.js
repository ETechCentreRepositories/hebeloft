
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/autocomplete';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/autocomplete.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/menu.css';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

function openCreateSalesRecordModal() {
        document.getElementById('createSalesRecordModal').style.display = "block";
    }

function closeCreateSalesRecordModal() {
    document.getElementById('createSalesRecordModal').style.display = "none";
}

// $(document).ready(function(){
//     $.get("{{ URL::to('ajax/outlet')}}",function(data){
//         $("#outlet").empty();
//         $.each(data,function(i,value){
//             var id = value.id;
//             var outlet = value.outlet_name;
//             var outlet_id = value.id;
//             $("#outlet").append("<option value='" +
//             outlet_id + "'>" +outlet + "</option>");
//         });
//     });

//     $("#salesRecordSearchField").autocomplete({
//         source: "{{URL::to('autocomplete-search')}}",
//         minLength:1,
//         select:function(key,value)
//         {
//             console.log(value);
//         }
//     });

// });

// function getPrice(){
//     var value  = $("#quantity").val();
//     console.log(value);
//     $("#price").html(value);
// }

// function getProduct() {
//     var productName = $("#salesRecordSearchField").val();
//     $.ajax({
//         type: "GET",
//         url: "{{URL::TO('/retrieve-inventory-by-product-name')}}/" + productName,
//         // data: productName,
//         cache:false,
//         datatype: "JSON",
//         success: function (response) {
//             {{ route('product.addToCart', ['id' => 1 ])}}
//             for (i = 0; i < response.length; i++) {
//             $("#addSalesRecordContent").append(
//                 "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
//                 + "<td>" + response[i].Brand + "</td>"
//                 + "<td>" + response[i].Name + "</td>"
//                 + "<td>" + response[i].UnitPrice + "</td>"
//                 + "<td><input name='quantity' type='number' id='quantity' onChange='getPrice()' type='text' style='width:60px;' value='1'/></td>"
//                 + "<td><input name='discount' id='discount' type='text' style='width:60px;' value='0'/></td>" 
//                 + "<td id='price'></td>"
//                 + "<td></td></tr>"
//             );
//             }
//         },

//         error: function (obj, testStatus, errorThrown) {
            
//         }
//     });
// }