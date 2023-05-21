@extends('layouts.app')

@section('content')

    @include('professor_pages.questions.create')
    @include('professor_pages.questions.edit')
    @include('professor_pages.questions.delete')
    @include('professor_pages.questions.create_old')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">


                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home">Početna</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses">Kursevi</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses/{{$course_id}}">Testovi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pitanja</li>
                    </ol>

                </nav>

                @include('messages.errors')
                @include('messages.success')


                <hr class="border border-dark border-2 opacity-50">
                <h4 class="text-center fw-bold">{{$test->name}}</h4>
                <button class="btn btn-primary btn-create-question" value="{{$test->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Dodaj Novo Pitanje</button>
                <button class="btn btn-info btn-create-existing-question" value="{{$course_id}}" style="float: right; margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#addExistingQuestionModal">Dodaj Staro Pitanje</button>

                <table class="table table-striped sortable">
                    <thead>
                    <tr>
                        <th scope="col">Pitanje</th>
                        <th scope="col">Prikaži odgovore</th>
                        <th scope="col">Tip</th>
                        <th scope="col">Vidljivost pitanja</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody id="question_table">
                    @foreach($questions as $question)
                        <tr data-id="{{ $question->id }}">
                            <td>{{$question->question}}</td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-chevron-down"></i></button>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($question->type == "multi")
                                    <i class="bi bi-ui-checks" style="font-size: 25px;"></i>
                                @else
                                    <i class="bi bi-check-circle-fill bigger-icon"></i>
                                @endif
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/active/questions/test/active',$question->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch" style="margin-left: 30px;">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($question->active)checked @endif>
                                    </div>

                                </form>
                            </td>
{{--                            <td>--}}
{{--                                <a class="btn btn-primary" href="{{url('/professor/courses/questions/test/answers/'. $question->id)}}">Idi na odgovore</a>--}}
{{--                            </td>--}}
                            <td>
                                <button type="button" class="btn btn-warning btn-edit-question" data-bs-toggle="modal" data-bs-target="#editQuestionModal" id="editQuestionButton" value="{{$question->id}}">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-question" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal" id="deleteQuestionButton" value="{{$question->id}}">Obriši</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection



