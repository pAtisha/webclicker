<form action="{{ url('/professor/courses/question/delete/test') }}" method="POST" id="deleteFormQuestion">

    <!-- Modal -->
    <div class="modal fade" id="deleteQuestionModal" tabindex="-1" aria-labelledby="deleteQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteQuestionModalLabel">Brisanje pitanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')

                    <h5 class="text-center">Da li zaista želite da obrišete pitanje?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                    <button type="submit" class="btn btn-danger">Obriši</button>
                </div>
            </div>
        </div>
    </div>
</form>

