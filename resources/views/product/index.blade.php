@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@include('inc.unauthorized')
@endif

<br>
<div class="topMargin container">
    <div class="row justify-content-end">
        <div class="col-d-2">
        <a href="/products/create"><button type="button" class="btn btn-warning" onclick="openCreateProductModal()">Add new Product</button>
        </div>
    </div>
    <br>
    @if(count($products) > 0)
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>UnitPrice</th>
                    @if ($users_id->roles_id == '1')
                    <th class="emptyHeader"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr id="{{$product->id}}">
                    <td><img style="width:60px; height:60px" src="/storage/product_images/{{$product->image}}"></td>
                    <td>{{$product->Brand}}</td>
                    <td>{{$product->Name}}</td>
                    <td>{{$product->Description}}</td>
                    <td>{{$product->Category}}</td>
                    <td>{{$product->UnitPrice}}</td>
                    @if ($users_id->roles_id == '1')
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row product-buttons">
                                <div class="p-2">
                                <a href=""><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                                <div class="p-2">
                                    <button type="button" class="btn btn-danger" onclick="openDeleteProductModal()" id="delete">Delete</button>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No products found</p> 
    @endif
</div>
<div class="pagination">
    {{$products->links()}}
</div>

@endsection

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>