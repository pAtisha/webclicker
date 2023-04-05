<form action="{{ url('/professor/courses/edit') }}" method="POST" enctype="multipart/form-data" id="editFormAnswer">
    @csrf
    @method('patch')
    <!-- Modal -->
    <div class="modal fade" id="editAnswerModal" tabindex="-1" aria-labelledby="editAnswerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editAnswerModalLabel">Izmeni Odgovor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Odgovor</label>
                        <input type="text" class="form-control" id="answer_edit" name="answer">
                    </div>
                    <div class="mb-3">
                        <label for="testPassword" class="form-label">Poeni</label>
                        <input type="text" class="form-control" id="points_edit" name="points">
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
