<form action="{{ url('/professor/courses/create/test') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="addTestModal" tabindex="-1" aria-labelledby="addTestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addTestModalLabel">Dodaj Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="testName" class="form-label">Naziv</label>
                        <input type="text" class="form-control" id="name" placeholder="Unesite naziv testa..." name="name">
                    </div>
                    <div class="mb-3">
                        <label for="testPassword" class="form-label">Šifra</label>
                        <input type="text" class="form-control" id="password" placeholder="Test ne mora sadržati šifru." name="password">
                    </div>
                    <div class="mb-3">
                        <label for="testTime" class="form-label">Vreme za rešavanje testa(u minutima)</label>
                        <input type="text" class="form-control" id="time" placeholder="Unesite vreme u minutima." name="time">
                    </div>
                    <div class="mb-3">
                        <label for="courseActive" class="form-label">Aktivan</label>
                        <input name="active" type="checkbox" aria-label="Checkbox for active course" checked>
                    </div>
                    <input type="hidden" name="course_id" id="test_course_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </div>
    </div>
</form>

