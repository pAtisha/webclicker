@extends('layouts.app')
<section>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-transparent text-white border-white">
                <div class="card-header border-white">Registracija</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-white">Ime i Prezime</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control shadow-none bg-transparent text-white white-border-down @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-white">Email adresa</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control shadow-none bg-transparent text-white white-border-down shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="index_number" class="col-md-4 col-form-label text-md-end text-white">Broj indeksa</label>

                            <div class="col-md-6">
                                <input id="index_number" type="text" class="form-control shadow-none bg-transparent text-white white-border-down shadow-none @error('index_number') is-invalid @enderror" name="index_number" value="{{ old('index_number') }}" required autocomplete="index_number">

                                @error('index_number')
                                <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-white">Šifra</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control shadow-none bg-transparent text-white white-border-down shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end text-white">Potvrda šifre</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control bg-transparent text-white white-border-down shadow-none" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-light btn-white-blue">
                                    Registruj se
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
