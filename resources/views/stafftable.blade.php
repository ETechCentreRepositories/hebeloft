@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div>
            <a href="/staffsignup"><button type="button" class="btn btn-warning">Add new staff</button></a>
        </div>
    </div>
    <br><br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Doe</td>
                    <td>john@example.com</td>
                    <td>
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <a href="/staffsignup"><button type="button" class="btn btn-primary">Edit</button></a>
                            </div>
                            <div class="p-2">
                                <a href="/staffsignup"><button type="button" class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Moe</td>
                    <td>mary@example.com</td>
                    <td>
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <a href="/"><button type="button" class="btn btn-primary">Edit</button></a>
                            </div>
                            <div class="p-2">
                                <a href="/"><button type="button" class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Dooley</td>
                    <td>july@example.com</td>
                    <td>
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <a href="/staffsignup"><button type="button" class="btn btn-primary">Edit</button></a>
                            </div>
                            <div class="p-2">
                                <a href="/staffsignup"><button type="button" class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
