@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="drop-down_brand row">
        <div class="col-md-3">
        <p>Search Item name/brand</p>
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control">
            </select>
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>Show Location</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" >
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <input type="text" class="form-control" style="background:transparent; height:0.8cm;">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default" id="refreshInventory">Refresh</button>
        </div>
    </div>
    <br>
    <div class="row">
        <a href="{{ route('export.file',['type'=>'csv']) }}">Download CSV</a>
    </div>
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                {{-- <th>BHG SKU</th>
                <th>OG SKU</th>
                <th>Metro SKU</th> --}}
                <th>SKU</th>
                <th>Quantity/Thresold</th>
            </tr>
        </thead>
        <tbody>
            @if(count($inventoryOutlets) > 0) 
            @foreach($inventoryOutlets as $inventoryOutlet)
            <tr>
                <td>
                    <img style="width:60px; height:60px" src="/storage/product_images/{{$inventoryOutlet->products['image']}}">    
                </td>
                <td>{{$inventoryOutlet->products['Brand']}}</td>
                <td>{{$inventoryOutlet->products['Name']}}</td>
                <td>{{$inventoryOutlet->products['UnitPrice']}}</td>
                {{-- <td></td>
                <td></td>
                <td></td> --}}
                <td></td>
            <td>{{$inventoryOutlet->stock_level}}/{{$inventoryOutlet->threshold_level}}</td>
            </tr>
            @endforeach
            {{-- {{dd($inventoryOutlet->products['Brand'])}}  --}}
            @else
                <p>No Inventory found</p>
            @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.get("{{ URL::to('ajax/inventory')}}",function(data){
            console.log(data);
            $("#product_brand").empty();
            $.each(data,function(i,value){
                var brand = value.Brand;
                $("#product_brand").append("<option value='" +
                value.id + "'>" +brand + "</option>");
                    //  $('#product_brand').append(tr);
            });
        });
    });
</script>
<div class="pagination">
    {{$inventoryOutlets->links()}}
</div>
@endsection
