@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif
