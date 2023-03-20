<form action="{{ url('/professor/courses/test/edit') }}" method="POST" enctype="multipart/form-data" id="editFormTest">
    @csrf
    @method('patch')
    <!-- Modal -->
    <div class="modal fade" id="editTestModal" tabindex="-1" aria-labelledby="editTestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editTestModalLabel">Izmeni Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="testName" class="form-label">Naziv</label>
                        <input type="text" class="form-control" id="name_test" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="testPassword" class="form-label">Šifra</label>
                        <input type="text" class="form-control" id="password_test" placeholder="Kurs ne mora sadržati šifru." name="password">
                    </div>
                    <div class="mb-3">
                        <label for="testTime" class="form-label">Vreme za test</label>
                        <input type="text" class="form-control" id="time_test" name="time">
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

