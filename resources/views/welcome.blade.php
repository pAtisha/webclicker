@extends('layouts.app')

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Dobro došli na WebClicker.</h1>
                <p class="col-lg-10 fs-4">Na ovom sajtu možete rešavati testove iz raznih kurseva u dogovoru sa Vašim profesorom. Potrebno je da se registrujete ili prijavite kako biste nastavili.</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email">
                        <label for="floatingInput">Email adresa</label>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password" required autocomplete="current-password">
                        <label for="floatingPassword">Šifra</label>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="checkbox mb-3">
                        <div class="form-check">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" style="float: right" href="{{ route('password.request') }}">
                                    Zaboravljena šifra?
                                </a>
                            @endif
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Zapamti me
                            </label>
                        </div>

                    </div>


                    <button class="w-100 btn btn-lg btn-primary" type="submit">Prijava</button>
                    <hr class="my-4">
                    <small class="text-muted">Ukoliko niste kreirali nalog, molimo Vas da se <a href="{{ route('register') }}">registrujete</a>. </small>
                </form>
            </div>
        </div>
    </div>
@endsection
