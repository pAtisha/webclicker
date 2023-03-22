@extends('layouts.app')

@section('content')

    @include('professor_pages.questions.create')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                    <button class="btn btn-primary btn-create-question" value="{{$test->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Dodaj Pitanje</button>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home">Početna</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses">Kursevi</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses/{{$course_id}}">Testovi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pitanja</li>
                        <li style="margin-left: 50px;"><h4 class="text-center fw-bold">{{$test->name}}</h4></li>
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
                        <th scope="col" colspan="3">Akcija</th>
                        <th scope="col">Aktivnost</th>
                        <th scope="col">Otvoren</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection



