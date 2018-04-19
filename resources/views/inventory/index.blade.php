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
                    <th>BHG SKU</th>
                    <th>OG SKU</th>
                    <th>Metro SKU</th>
                    <th>SKU</th>
                    <th>Quantity/Thresold</th>
                </tr>
            </thead>
            <tbody>
               @if(count($inventorys) > 0) 
                @foreach($inventorys as $inventory)
                <tr>
                    {{-- {{dd($inventory->Name)}} --}}
                    <td>
                        <img style="width:60px; height:60px" src="/storage/product_images/{{$inventory->products['image']}}">    
                    </td>
                    <td>{{$inventory->products['Brand']}}</td>
                    <td>{{$inventory->products['Name']}}</td>
                    <td>{{$inventory->products['UnitPrice']}}</td>
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$inventory->stock_level}}</td>
                </tr>
                @endforeach
                @else
                    <p>No Inventory found</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="pagination">
    {{-- {{$users->links()}} --}}
</div>
@endsection
