@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="container">
    {{-- <select>
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="opel">Opel</option>
        <option value="audi">Audi</option>
      </select> --}}
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Item</th>
                    <th>Normal Price</th>
                    <th>BHG SKU</th>
                    <th>OG SKU</th>
                    <th>Metro SKU</th>
                    <th>SKU</th>
                    <th>Quantity/Thresold</th>
                </tr>
            </thead>
            <tbody>
               @if(count($products) > 0) 
                @foreach($products as $product)
                <tr>
                    <td>{{$product->image}}</td>
                    <td>{{$product->Brand}}</td>
                    <td>{{$product->Name}}</td>
                    <td>{{$product->UnitPrice}}</td>
                    <td>
                        {{-- <div class="d-flex flex-row user-buttons">
                            <div class="p-2">
                                <a href="/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                            </div>
                            <div class="p-2">
                                {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
                                {!!Form::close()!!}
                            </div>
                        </div> --}}
                    </td>
                </tr>
                @endforeach
                @else
                    <p>No Inventory found</p>
                @endif --}}
            </tbody>
        </table>
    </div>
</div>
<div class="pagination">
    {{-- {{$users->links()}} --}}
</div>
@endsection