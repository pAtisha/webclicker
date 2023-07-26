<form action="{{ url('password/reset/notify') }}" method="POST" id="notifyPasswordResetAnchor">

    <!-- Modal -->
    <div class="modal fade" id="notifyPasswordReset" tabindex="-1" aria-labelledby="notifyPasswordResetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notifyPasswordResetLabel">Zatraži promenu lozinke?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="testName" class="form-label">Email adresa naloga</label>
                            <input type="email" class="form-control" id="email_reset" name="email_reset" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="testName" class="form-label">Broj indeksa</label>
                            <input type="text" class="form-control" id="index_reset" name="index_reset" placeholder="Broj indeksa">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                    <button type="submit" class="btn btn-success">Zatraži</button>
                </div>
            </div>
        </div>
    </div>
</form>
