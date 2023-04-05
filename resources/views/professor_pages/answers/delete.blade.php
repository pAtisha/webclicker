<form action="{{ url('/professor/courses/delete/') }}" method="POST" id="deleteFormAnswer">

    <!-- Modal -->
    <div class="modal fade" id="deleteAnswerModal" tabindex="-1" aria-labelledby="deleteAnswerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAnswerModalLabel">Brisanje odgovora</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')

                    <h5 class="text-center">Da li zaista želite da obrišete odgovor?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-no-delete-answer" data-bs-dismiss="modal">Ne</button>
                    <button type="submit" class="btn btn-danger btn-yes-delete-answer">Obriši</button>
                </div>
            </div>
        </div>
    </div>
</form>
