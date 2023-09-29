@extends('layouts.app')
<section>
    @section('content')

        <div class="container form-floating">

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h3 class="text-center text-white">{{$test->name}}</h3>
                        <hr class="border border-white border-1 opacity-100">

                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 test-container">
                                    @foreach($questions as $question)
                                        <div class="container question-container rounded" id="question_container{{$loop->iteration}}">
                                            <h3>{{$loop->iteration . '. ' .$question->question}}</h3>
                                            <hr>
                                            @php $answers = $answersArray[$loop->index]; $i = $loop->index @endphp
                                            @if($question->type == "single")
                                                @foreach($answers as $answer)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="answer_single{{$i}}" id="{{$answer['answer']}}" value="{{$answer['answer']}}" disabled @if($answer['correct']) checked @endif>
                                                        <label class="form-check-label opacity-100 @if($answer['points'] > 0) bg-success bg-opacity-50 @elseif($answer['points'] == 0) bg-warning bg-opacity-50 @else bg-danger bg-opacity-50 @endif" for="{{$answer['answer']}}">
                                                            {{$loop->iteration . '. ' .$answer['answer']}} {Broj poena: {{$answer['points']}}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach($answers as $answer)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="answer_multi{{$i}}[]" id="{{$answer['answer']}}" value="{{$answer['answer']}}" disabled @if($answer['correct']) checked @endif>
                                                        <label class="form-check-label opacity-100 @if($answer['points'] > 0) bg-success bg-opacity-50 @elseif($answer['points'] == 0) bg-warning bg-opacity-50 @else bg-danger bg-opacity-50 @endif" for="{{$answer['answer']}}">
                                                            {{$loop->iteration . '. ' .$answer['answer']}} {Broj poena: {{$answer['points']}}}
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
                        </div>
                    </div>
                </div>

        </div>
@endsection
<div class="wave wave1"></div>
<div class="wave wave2"></div>
<div class="wave wave3"></div>
<div class="wave wave4"></div>
</section>
