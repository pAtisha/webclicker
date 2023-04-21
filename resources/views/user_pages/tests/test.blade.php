@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{$test->name}}</h3>
                <hr class="border border-dark border-2 opacity-50">


                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="card">
                                <div class="card-header">
                                    Pitanja
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach($questions as $question)
                                        <a href="#{{$loop->iteration}}" id="question_id_{{$loop->iteration}}" class="list-group-item list-group-item-action">Pitanje broj {{$loop->iteration}}</a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-10 test-container">
                            @foreach($questions as $question)
                                <div class="container question-container rounded" id="question_container{{$loop->iteration}}">
                                    <h3>{{$question->question}}</h3>
                                    <hr>
                                    @php $answers = $answersArray[$loop->index]; $i = $loop->index @endphp
                                    @foreach($answers as $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer{{$i}}" id="{{$answer['answer']}}">
                                        <label class="form-check-label" for="{{$answer['answer']}}">
                                            {{$answer['answer']}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection



