@extends('layouts.app')
<section>

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5 form-floating">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3 text-white">Dobro došli na WebClicker.</h1>
                <p class="col-lg-10 fs-4 text-white">Na ovom sajtu možete rešavati testove iz raznih kurseva u dogovoru sa Vašim profesorom. Potrebno je da se registrujete ili prijavite kako biste nastavili.</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 rounded-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control shadow-none bg-transparent text-white white-border-down @error('email') is-invalid @enderror" id="floatingInput" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email">
                        <label for="floatingInput" class="text-white">Email adresa</label>

                        @error('email')
                        <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control shadow-none bg-transparent text-white @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password" required autocomplete="current-password">
                        <label for="floatingPassword" class="text-white">Šifra</label>

                        @error('password')
                        <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="checkbox mb-3">
                        <div class="form-check">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-white" style="float: right" href="{{ route('password.request') }}">
                                    Zaboravljena šifra?
                                </a>
                            @endif
                            <input class="form-check-input text-white" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label text-white" for="remember">
                                Zapamti me
                            </label>
                        </div>

                    </div>


                    <button class="w-100 btn btn-lg btn-primary bg-transparent" id="login-btn" type="submit">Prijava</button>
                        <a href="{{url('auth/google')}}" class="login-with-google-btn w-100 btn btn-lg">Prijavi se preko Gugla</a>
{{--                    <a class="w-100 btn btn-lg btn-danger" href="{{url('notify-admin')}}">Zahtev za promenu šifre</a>--}}
                    <hr class="my-4 text-white">
                    <p class="text-white">Ukoliko niste kreirali nalog, molimo Vas da se <a href="{{ route('register') }}" class="text-white">registrujete</a>. </p>
                </form>
            </div>
        </div>
    </div>
@endsection
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
