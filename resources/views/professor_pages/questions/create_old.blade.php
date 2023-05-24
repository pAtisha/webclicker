<form action="{{ url('/professor/courses/questions-existing/test/create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="addExistingQuestionModal" tabindex="-1" aria-labelledby="addExistingQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addExistingQuestionModalLabel">Dodaj Pitanje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Izaberite Kurs</label>
                        <select class="form-select" aria-label="Default select example" name="course_old" id="course_old">
                        </select>
                    </div>
                    <div class="mb-3">
                        <form class="row" action="{{ url('/professor/courses/questions-existing/test/create') }}" style="float: right;" method="POST">
                            @csrf
                            <table class="table table-striped" id="show_questions_table">
                                <thead>
                                <tr>
                                    <th scope="col">Pitanje</th>
                                    <th scope="col">Prikaži odgovore</th>
                                    <th scope="col">Izaberi pitanja</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @foreach($questions as $index => $question)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$question->question}}</td>--}}
{{--                                        <td>--}}
{{--                                            <button class="btn btn-primary btn-toggle-up-down{{$question->id}}" data-bs-toggle="collapse" href="#collapseAnswersCopy{{$question->id}}" role="button" aria-expanded="false" aria-controls="collapseAnswersCopy{{$question->id}}"><i class="bi bi-chevron-down"></i></button>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <label for="testId" class="form-label">{{$test->name}}</label>--}}
{{--                                            <input name="test_id[]" type="checkbox" aria-label="Checkbox for test" value="{{$test->id}}">--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr class="collapse" id="collapseAnswersCopy{{$question->id}}">--}}
{{--                                        <td colspan="2">--}}
{{--                                            <table class="table">--}}
{{--                                                <thead>--}}
{{--                                                <tr>--}}
{{--                                                    <th scope="col">Odgovor</th>--}}
{{--                                                    <th scope="col">Poeni</th>--}}
{{--                                                </tr>--}}
{{--                                                </thead>--}}
{{--                                                <tbody>--}}
{{--                                                @foreach($question['answer'] as $answer)--}}
{{--                                                    <tr>--}}
{{--                                                        <td>{{$answer->answer}}</td>--}}
{{--                                                        <td>{{$answer->points}}</td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
{{--                                                </tbody>--}}
{{--                                            </table>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <input type="hidden" name="id_test" value="{{$test->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </div>
    </div>
</form>

