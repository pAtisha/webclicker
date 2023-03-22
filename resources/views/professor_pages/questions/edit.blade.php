<form action="{{ url('/professor/courses/questions/test/update') }}" method="POST" enctype="multipart/form-data" id="editFormQuestion">
    @csrf
    @method('patch')
    <!-- Modal -->
    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestionModalLabel">Izmeni Pitanje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="questionQuestion" class="form-label">Pitanje</label>
                        <textarea class="form-control" id="question_edit" name="question"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="questionPoints" class="form-label">Poeni</label>
                        <input type="text" class="form-control" id="points_edit" placeholder="Unesite poene za tačan odgovor.." name="points">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Ažuriraj</button>
                </div>
            </div>
        </div>
    </div>
</form>
