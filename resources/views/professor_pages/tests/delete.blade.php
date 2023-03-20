<form action="{{ url('/professor/courses/delete/') }}" method="POST" id="deleteFormTest">

    <!-- Modal -->
    <div class="modal fade" id="deleteTestModal" tabindex="-1" aria-labelledby="deleteTestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTestModalLabel">Brisanje testa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')

                    <h5 class="text-center">Da li zaista želite da obrišete test?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-no-delete-test" data-bs-dismiss="modal">Ne</button>
                    <button type="submit" class="btn btn-danger btn-yes-delete-test">Obriši</button>
                </div>
            </div>
        </div>
    </div>
</form>

