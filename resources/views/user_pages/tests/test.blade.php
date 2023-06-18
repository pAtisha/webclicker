@extends('layouts.app')
<section>
@section('content')

    <div class="container form-floating">
        <form action="/student/test/send" method="POST" id="submit_test">
            @csrf
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center text-white">{{$test->name}}</h3>
                <hr class="border border-white border-1 opacity-100">

                <input hidden="hidden" name="test_id" value="{{$test->id}}">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="sticky-top">
                            <div class="card">
                                <div class="card-header bg-yellow">
                                    Pitanja
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach($questions as $question)
                                        <a href="#{{$loop->iteration}}" id="question_id_{{$loop->iteration}}" class="list-group-item list-group-item-action bg-yellow">Pitanje broj {{$loop->iteration}}</a>
                                    @endforeach
                                </ul>
                            </div>
                            <br>
                            <div class="sticky-top border border-danger border-2">
                                <h4 class="text-white text-center pt-2"><i class="bi bi-stopwatch-fill"></i>  <span id="count">{{$time}}</span></h4>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-10 test-container">
                            @foreach($questions as $question)
                                <div class="container question-container rounded" id="question_container{{$loop->iteration}}">
                                    <h3>{{$loop->iteration . '. ' .$question->question}}</h3>
                                    <hr>
                                    @php $answers = $answersArray[$loop->index]; $i = $loop->index @endphp
                                    @if($question->type == "single")
                                        @foreach($answers as $answer)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer_single{{$i}}" id="{{$answer['answer']}}" value="{{$answer['answer']}}">
                                            <label class="form-check-label" for="{{$answer['answer']}}">
                                                {{$loop->iteration . '. ' .$answer['answer']}}
                                            </label>
                                        </div>
                                        @endforeach
                                    @else
                                        @foreach($answers as $answer)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="answer_multi{{$i}}[]" id="{{$answer['answer']}}" value="{{$answer['answer']}}">
                                                <label class="form-check-label" for="{{$answer['answer']}}">
                                                    {{$loop->iteration . '. ' .$answer['answer']}}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-lg" style="margin-left: 80px;">Završi Test</button>
                </div>
            </div>
        </div>
        </form>

    </div>

@endsection
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>



