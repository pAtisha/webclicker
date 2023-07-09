@extends('layouts.app')
<section>
@section('content')

    @include('professor_pages.tests.create')
    @include('professor_pages.tests.delete')
    @include('professor_pages.tests.edit')
    @include('professor_pages.tests.export')

    <div class="container form-floating">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home" class="text-white">Početna</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses" class="text-white">Kursevi</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Testovi</li>
                    </ol>
                </nav>

                @include('messages.errors')
                @include('messages.success')


                <hr class="border border-white border-1 opacity-100">
                <h4 class="text-center fw-bold text-white">{{$course->name}}</h4>
                <button class="btn btn-outline-light btn-white-blue btn-create-test" value="{{$course->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addTestModal">Dodaj Test</button>

                <table class="table text-white sortable">
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
                                <a class="btn btn-outline-light btn-white-blue" href="{{url('/professor/courses/questions/test/'. $test->id)}}">Idi na pitanja</a>
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

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
