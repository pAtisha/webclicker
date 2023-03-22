<form action="{{ url('/professor/courses/questions/test/create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Dodaj Pitanje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="questionQuestion" class="form-label">Pitanje</label>
                        <textarea class="form-control" id="question" placeholder="Unesite pitanje..." name="question"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="testPassword" class="form-label">Poeni</label>
                        <input type="text" class="form-control" id="points" placeholder="Unesite poene za tačan odgovor.." name="points">
                    </div>
                    <div class="mb-3">
                        <label for="courseActive" class="form-label">Aktivan</label>
                        <input name="active" type="checkbox" aria-label="Checkbox for active course" checked>
                    </div>
                    <input type="hidden" name="test_id" id="test_question_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </div>
    </div>
</form>

