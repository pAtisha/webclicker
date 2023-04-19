<form action="{{ url('/admin/users/edit') }}" method="POST" enctype="multipart/form-data" id="editFormUser">
    @csrf
    @method('patch')
    <!-- Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Izmeni detalje korisnika</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Ime i Prezime</label>
                        <input type="text" class="form-control" id="name_user" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="indexNumber" class="form-label">Broj indeksa</label>
                        <input type="text" class="form-control" id="index_number" name="index_number">
                    </div>
                    <div class="mb-3">
                        <label for="coursePassword" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nova šifra</label>
                        <input id="new_password" type="password" class="form-control" name="new_password">
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Potvrda nove šifre</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
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
