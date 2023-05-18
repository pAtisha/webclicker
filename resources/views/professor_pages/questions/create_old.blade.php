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
                        <label for="exampleFormControlInput1" class="form-label">Izaberi Pitanje</label>
                        <select class="form-select" aria-label="Default select example" name="question_old" id="question_old">
{{--                            <option value="single">Jedan izbor odgovora</option>--}}
{{--                            <option value="multi">Višeizborni odgovori</option>--}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="courseActive" class="form-label">Aktivan</label>
                        <input name="active" type="checkbox" aria-label="Checkbox for active course" checked>
                    </div>
                    <input type="hidden" name="test_id" id="test_existing_question_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </div>
    </div>
</form>

