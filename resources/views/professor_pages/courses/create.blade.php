<form action="{{ url('/professor/courses/create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Dodaj Kurs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Naziv</label>
                        <input type="text" class="form-control" id="name" placeholder="Unesite naziv kursa..." name="name">
                    </div>
                    <div class="mb-3">
                        <label for="coursePassword" class="form-label">Šifra</label>
                        <input type="password" class="form-control" id="password" placeholder="Kurs ne mora sadržati šifru." name="password">
                    </div>
                    <div class="mb-3">
                        <label for="courseActive" class="form-label">Vidljiv</label>
                        <input name="active" type="checkbox" aria-label="Checkbox for active course" checked>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </div>
    </div>
</form>
