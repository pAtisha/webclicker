@extends('layouts.app')

@section('content')

    @include('professor_pages.tests.create')
    @include('professor_pages.tests.delete')
    @include('professor_pages.tests.edit')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                    <button class="btn btn-primary btn-create-test" value="{{$course->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addTestModal">Dodaj Test</button>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home">Početna</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses">Kursevi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Testovi</li>
                        <li style="margin-left: 50px;"><h4 class="text-center fw-bold">{{$course->name}}</h4></li>
                    </ol>

                </nav>

                @include('messages.errors')
                @include('messages.success')


                <hr class="border border-dark border-2 opacity-50">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Šifra</th>
                        <th scope="col">Vreme</th>
                        <th scope="col" colspan="2">Akcija</th>
                        <th scope="col">Aktivnost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tests as $test)
                        <tr>
                            <td>{{$test->id}}</td>
                            <td>{{$test->name}}</td>
                            <td>{{$test->password}}</td>
                            <td>{{$test->time}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-edit-test" data-bs-toggle="modal" data-bs-target="#editTestModal" id="editTestButton" value="{{$test->id}}">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-test" data-bs-toggle="modal" data-bs-target="#deleteTestModal" id="deleteTestButton" value="{{$test->id}}">Obriši</button>
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/active/test',$test->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($test->active)checked @endif>
                                    </div>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection


