<form action="{{ url('/admin/users/delete/') }}" method="POST" id="deleteFormUser">

    <!-- Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Brisanje korisnika</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')

                    <h5 class="text-center">Da li zaista želite da obrišete korisnika?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-no-delete-user" data-bs-dismiss="modal">Ne</button>
                    <button type="submit" class="btn btn-danger btn-yes-delete-user">Obriši</button>
                </div>
            </div>
        </div>
    </div>
</form>

