<form method="post" action="{{url('/professor/course/test/export')}}">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="chooseTestsForResults" tabindex="-1" aria-labelledby="chooseTestsForResultsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addTestModalLabel">Izaberi Testove</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        @foreach($tests as $test)
                            <div class="mb-3">
                                <label for="testId" class="form-label">{{$test->name}}</label>
                                <input name="test_id[]" type="checkbox" aria-label="Checkbox for test" value="{{$test->id}}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <input hidden="hidden" name="course_id" value="{{$course->id}}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Preuzmi</button>
                </div>
            </div>
        </div>
    </div>
</form>
