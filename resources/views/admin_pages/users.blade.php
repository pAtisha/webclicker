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
                <h3 class="text-center fw-bold">Studenti</h3>

                <form class="row g-3" action="{{ url('/admin/getUsers') }}" style="float: right;" method="POST">
                    @csrf
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Broj Indeksa</label>
                        <input type="texy" class="form-control" id="inputPassword2" name="index_number" placeholder="Broj Indeksa">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Filtriraj</button>
                        <a href="{{ url('admin/users') }}" class="btn btn-info mb-3">Resetuj</a>
                    </div>
                </form>


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Ime i Prezime</th>
                        <th scope="col">Broj indeksa</th>
                        <th scope="col">Email</th>
                        <th scope="col">Promeni zvanje u</th>
                        <th scope="col">Izmeni</th>
                        <th scope="col">Obriši</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users_students as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>
                            {{$user->index_number}}
                        </td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form action="{{ url('/admin/users/update/role',$user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button class="btn btn-primary" type="submit">
                                    {{'Profesor'}}
                                </button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal" id="editUserButton" value="{{$user->id}}">Izmeni</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-delete-user" data-bs-toggle="modal" data-bs-target="#deleteUserModal" id="deleteUserButton" value="{{$user->id}}">Obriši</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {!! $users_students->links() !!}
                    </ul>
                </nav>

                <h3 class="text-center fw-bold">Profesori</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Ime i Prezime</th>
                        <th scope="col">Email</th>
                        <th scope="col">Promeni zvanje u</th>
                        <th scope="col">Izmeni</th>
                        <th scope="col">Obriši</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users_professors as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <form action="{{ url('/admin/users/update/role',$user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button class="btn btn-primary" type="submit">
                                        {{'Student'}}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal" id="editUserButton" value="{{$user->id}}">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-user" data-bs-toggle="modal" data-bs-target="#deleteUserModal" id="deleteUserButton" value="{{$user->id}}">Obriši</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {!! $users_professors->links() !!}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

@endsection
