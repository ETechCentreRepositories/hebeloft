@extends('layouts.app')
<script src="{{ asset('js/products.js') }}" defer></script>
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
@endif

<br>
<div class="topMargin container">
    <div class="row">
        <div class="col-md-10"><a href="{{ route('exportPO.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning">Export</button></a></div>
        <div class="col-md-2 fullWidthButtons">
            <div class="p-2">
            <a href="/purchaseorder/create"><button type="button" class="btn btn-warning btn-search">New Purchase Order</button></a>
            </div>
        </div>
    <br>
    <div>
        <table class="table-striped display" id="productTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Remarks</th>
                    <th>Total Quantity</th>
                    <th>Total Price</th>
                    @if ($users_id->roles_id == '1')
                    <th class="emptyHeader"></th>
                    @endif
                </tr>
            </thead>
            <tbody id="productContent">
                @foreach($products as $product)
                <tr id="{{$product->id}}">
                    <td>{{$product->date}}</td>
                    <td>{{$product->remarks}}</td>
                    <td>{{$product->totalQuantity}}</td>
                    <td>{{$product->totalPrice}}</td>
                    @if ($users_id->roles_id == '1')
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row product-buttons">
                                <div class="p-2">
                                    <a href="/purchaseorder/{{$product->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                                <div class="p-2">
                                    {!!Form::open(['action' => ['PurchaseOrdersController@destroy', $product->id], 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
                                    {!!Form::close()!!}
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
</div>

<script>
    $(document).ready(function () {
        $("#productTable").DataTable();
    });
</script>

@endsection

<style>
    .mobileLogo {
        visibility: hidden;
    }

    .purchaseOrderNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>

