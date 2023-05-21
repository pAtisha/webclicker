@extends('layouts.app')

@section('content')

    @include('professor_pages.tests.create')
    @include('professor_pages.tests.delete')
    @include('professor_pages.tests.edit')
    @include('professor_pages.tests.export')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home">Početna</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses">Kursevi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Testovi</li>
                    </ol>
                </nav>

                @include('messages.errors')
                @include('messages.success')


                <hr class="border border-dark border-2 opacity-50">
                <h4 class="text-center fw-bold">{{$course->name}}</h4>
                <button class="btn btn-primary btn-create-test" value="{{$course->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addTestModal">Dodaj Test</button>

                <table class="table table-striped sortable">
                    <thead>
                    <tr>
                        <th scope="col">Naziv</th>
                        <th scope="col">Šifra</th>
                        <th scope="col">Vreme za test</th>
                        <th scope="col">Maks.</th>
                        <th scope="col">Vidljivost testa</th>
                        <th scope="col">Otvoren test</th>
                        <th scope="col" colspan="4"></th>
                    </tr>
                    </thead>
                    <tbody id="test_table" >
                    @foreach($tests as $test)
                        <tr data-id="{{ $test->id }}">
                            <td>{{$test->name}}</td>
                            <td>
                                @if($test->password)
                                    <i class="bi bi-lock-fill bigger-icon"></i>
                                @else
                                    <i class="bi bi-unlock-fill bigger-icon"></i>
                                @endif
                            </td>
                            <td>{{$test->time}} minuta</td>
                            <td>{{$test->max_points}} poena</td>
                            <td>
                                <form action="{{ url('/professor/courses/active/test',$test->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" @if($test->active)checked @endif>
                                    </div>

                                </form>
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/open/test',$test->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" @if($test->open)checked @endif>
                                    </div>

                                </form>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{url('/professor/courses/questions/test/'. $test->id)}}">Idi na pitanja</a>
                            </td>
                            <td>
                                <form method="post" action="{{url('/professor/test/export')}}">
                                    @csrf
                                    <input hidden="hidden" name="test_id" value="{{$test->id}}">
                                    <button class="btn btn-success">Rezultati <i class="bi bi-download"></i></button>
                                </form>
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

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#chooseTestsForResults" id="chooseTestsForResults">Rezultati više testova <i class="bi bi-download"></i></button>
            </div>
        </div>
    </div>

@endsection


