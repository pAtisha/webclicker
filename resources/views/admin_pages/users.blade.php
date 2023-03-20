@extends('layouts.app')

@section('content')

    @include('admin_pages.delete')
    @include('admin_pages.edit')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Početna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Korisnici</li>
                    </ol>
                </nav>

                @include('messages.errors')
                @include('messages.success')

                <hr class="border border-dark border-2 opacity-50">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ime i Prezime</th>
                        <th scope="col">Tip</th>
                        <th scope="col">Broj indeksa</th>
                        <th scope="col">Email</th>
                        <th scope="col">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                            @if($user->role == 0)
                                {{'Student'}}
                            @else
                                {{'Profesor'}}
                            @endif
                        </td>
                        <td>
                            @if($user->role == 0)
                                {{$user->index_number}}
                            @endif

                        </td>
                        <td>{{$user->email}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal" id="editUserButton" value="{{$user->id}}">Izmeni</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-delete-user" data-bs-toggle="modal" data-bs-target="#deleteUserModal" id="deleteUserButton" value="{{$user->id}}">Obriši</button>
                        </td>
                        <td><button class="btn btn-primary">Profesor</button></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
