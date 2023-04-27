@extends('layouts.app')

@section('content')

    @include('professor_pages.tests.create')
    @include('professor_pages.tests.delete')
    @include('professor_pages.tests.edit')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
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

                <button class="btn btn-primary btn-create-test" value="{{$course->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addTestModal">Dodaj Test</button>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Naziv</th>
                        <th scope="col">Šifra</th>
                        <th scope="col">Vreme za test</th>
                        <th scope="col">Vidljivost testa</th>
                        <th scope="col">Otvoren test</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tests as $test)
                        <tr>
                            <td>{{$test->name}}</td>
                            <td>
                                @if($test->password)
                                    <i class="bi bi-lock-fill bigger-icon"></i>
                                @else
                                    <i class="bi bi-unlock-fill bigger-icon"></i>
                                @endif
                            </td>
                            <td>{{$test->time}} minuta</td>
                            <td>
                                <form action="{{ url('/professor/courses/active/test',$test->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($test->active)checked @endif>
                                    </div>

                                </form>
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/open/test',$test->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($test->open)checked @endif>
                                    </div>

                                </form>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{url('/professor/courses/questions/test/'. $test->id)}}">Idi na pitanja</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-edit-test" data-bs-toggle="modal" data-bs-target="#editTestModal" id="editTestButton" value="{{$test->id}}">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-test" data-bs-toggle="modal" data-bs-target="#deleteTestModal" id="deleteTestButton" value="{{$test->id}}">Obriši</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection


