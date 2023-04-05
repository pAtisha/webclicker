@extends('layouts.app')

@section('content')

    @include('professor_pages.answers.create')
    @include('professor_pages.answers.edit')
    @include('professor_pages.answers.delete')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                    <button class="btn btn-primary btn-create-answer" value="{{$question->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addAnswerModal">Dodaj Odgovor</button>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home">Početna</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses">Kursevi</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses/{{$course_id}}">Testovi</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses/questions/test/{{$question->test_id}}">Pitanja</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Odgovori</li>
                    </ol>

                </nav>

                @include('messages.errors')
                @include('messages.success')


                <hr class="border border-dark border-2 opacity-50">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Odgovor</th>
                        <th scope="col">Poeni</th>
                        <th scope="col" colspan="2">Akcija</th>
                        <th scope="col">Aktivnost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr>
                            <td>{{$answer->id}}</td>
                            <td>{{$answer->answer}}</td>
                            <td>{{$answer->points}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-edit-answer" data-bs-toggle="modal" data-bs-target="#editAnswerModal" id="editAnswerButton" value="{{$answer->id}}">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-answer" data-bs-toggle="modal" data-bs-target="#deleteAnswerModal" id="deleteAnswerButton" value="{{$answer->id}}">Obriši</button>
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/active/questions/test/answers/active',$answer->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($answer->active)checked @endif>
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



