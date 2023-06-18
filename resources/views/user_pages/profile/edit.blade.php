@extends('layouts.app')
<section>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-transparent border-white">
                    <div class="card-header text-white border-white">Izmeni profil</div>

                    @include('messages.errors')
                    @include('messages.success')

                    <div class="card-body">
                        <form method="POST" action="{{ url(Request::route()->getPrefix().'/user/update', $user->id) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-white">Ime i Prezime</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="row mb-3">--}}
{{--                                <label for="email" class="col-md-4 col-form-label text-md-end">Email adresa</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">--}}

{{--                                    @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            @if($user->role == 0)
                            <div class="row mb-3">
                                <label for="index_number" class="col-md-4 col-form-label text-md-end text-white">Broj indeksa</label>

                                <div class="col-md-6">
                                    <input id="index_number" type="text" class="form-control @error('index_number') is-invalid @enderror" name="index_number" value="{{$user->index_number}}" required autocomplete="index_number">

                                    @error('index_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            @if(!$user->gauth_id)

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end text-white">Stara šifra</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control @error('password') is-invalid @enderror" name="old_password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end text-white">Nova šifra</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end text-white">Potvrda nove šifre</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            @endif

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-light btn-white-blue">
                                        Sačuvaj
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
