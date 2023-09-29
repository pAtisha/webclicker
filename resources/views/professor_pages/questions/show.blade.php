@extends('layouts.app')
<section>
@section('content')

    @include('professor_pages.questions.create')
    @include('professor_pages.questions.edit')
    @include('professor_pages.questions.delete')
    @include('professor_pages.questions.create_old')
    @include('professor_pages.answers.delete')
    @include('professor_pages.answers.edit')
    @include('professor_pages.answers.create')

    <div class="container form-floating">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">


                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses" class="text-white">Kursevi</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/professor/courses/{{$course_id}}" class="text-white">Testovi</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">{{$test->name}} - Pitanja</li>
                    </ol>

                </nav>

                @include('messages.errors')
                @include('messages.success')


                <hr class="border border-white border-1 opacity-100">
                <h4 class="text-center fw-bold text-white">{{$test->name}}</h4>
                <button class="btn btn-outline-light btn-white-blue btn-create-question" value="{{$test->id}}" style="float: right;" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Dodaj Novo Pitanje</button>
                <button class="btn btn-outline-light btn-white-blue btn-create-existing-question" value="{{$course_id}}" style="float: right; margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#addExistingQuestionModal">Dodaj Staro Pitanje</button>

                <table class="table table-bg-blue text-white sortable">
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
                    @foreach($questions as $index => $question)
                        <tr data-id="{{ $question->id }}" class="tr-data-id tr-delete">
                            <td>{{$question->question}}</td>
                            <td>
                                <button class="btn btn-outline-light btn-white-blue btn-toggle-up-down{{$question->id}}" data-bs-toggle="collapse" href="#collapseAnswers{{$question->id}}" role="button" aria-expanded="false" aria-controls="collapseAnswers{{$question->id}}"><i class="bi bi-chevron-down"></i></button>
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
                                <button type="button" class="btn btn-outline-warning btn-edit-question" data-bs-toggle="modal" data-bs-target="#editQuestionModal" id="editQuestionButton" value="{{$question->id}}">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-delete-question" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal" id="deleteQuestionButton" value="{{$question->id}}">Obriši</button>
                            </td>
                        </tr>
                        <tr class="collapse tr-delete-this" id="collapseAnswers{{$question->id}}">
                            <td colspan="6">
                                <button class="btn btn-outline-light btn-white-blue btn-create-answer" value="{{$question->id}}" style="float: left;" data-bs-toggle="modal" data-bs-target="#addAnswerModal">Dodaj Odgovor</button>
                                <table class="table table-bg text-white sortable">
                                    <thead>
                                    <tr>
                                        <th scope="col">Odgovor</th>
                                        <th scope="col">Poeni</th>
                                        <th scope="col">Vidljivost odgovora</th>
                                        <th scope="col" colspan="2"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="answer_table_{{$index}}">
                                    @foreach($question['answer'] as $answer)
                                        <tr data-id="{{ $answer->id }}" class="tr-data-id-answer">
                                            <td>{{$answer->answer}}</td>
                                            <td>{{$answer->points}}</td>
                                            <td>
                                                <form action="{{ url('/professor/courses/active/questions/test/answers/active',$answer->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-check form-switch">
                                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($answer->active)checked @endif>
                                                    </div>

                                                </form>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-warning btn-edit-answer" data-bs-toggle="modal" data-bs-target="#editAnswerModal" id="editAnswerButton" value="{{$answer->id}}">Izmeni</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-danger btn-delete-answer" data-bs-toggle="modal" data-bs-target="#deleteAnswerModal" id="deleteAnswerButton" value="{{$answer->id}}">Obriši</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>


