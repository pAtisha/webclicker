<form action="{{ url('/professor/courses/edit') }}" method="POST" enctype="multipart/form-data" id="editFormCourse">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Izmeni Kurs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Naziv</label>
                        <input type="text" class="form-control" id="name_course" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="coursePassword" class="form-label">Šifra</label>
                        <input type="text" class="form-control" id="password_course" placeholder="Kurs ne mora sadržati šifru." name="password">
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
