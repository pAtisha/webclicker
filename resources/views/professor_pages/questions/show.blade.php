@extends('layouts.app')

@section('content')

    @include('professor_pages.questions.create')
    @include('professor_pages.questions.edit')
    @include('professor_pages.questions.delete')

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
                        <th scope="col">Pitanje</th>
                        <th scope="col">Poeni</th>
                        <th scope="col" colspan="3">Akcija</th>
                        <th scope="col">Aktivnost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td>{{$question->id}}</td>
                            <td>{{$question->question}}</td>
                            <td>{{$question->points}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-edit-question" data-bs-toggle="modal" data-bs-target="#editQuestionModal" id="editQuestionButton" value="{{$question->id}}">Izmeni</button>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{url('/professor/courses/questions/test/answers/'. $question->id)}}">Odgovori</a>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-question" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal" id="deleteQuestionButton" value="{{$question->id}}">Obriši</button>
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/active/questions/test/active',$question->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($question->active)checked @endif>
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



