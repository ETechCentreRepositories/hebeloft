@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div>
            <a href="/staffsignup"><button type="button" class="btn btn-warning">Primary</button></a>
        </div>
    </div>
    <br><br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
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
                    <td>2</td>
                    <td>Moe</td>
                    <td>mary@example.com</td>
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
                    <td>3</td>
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
