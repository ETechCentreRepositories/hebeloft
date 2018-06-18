@extends('layouts.app')
<script src="{{ asset('js/inventory.js') }}" defer></script>
@section('content')

<br>
<a href="{{ route('exportInventory_brand.file',['type'=>'csv', 'brand'=>"+{{$id}}+"]) }}"><button type="button" class="btn btn-primary">Export</button></a>