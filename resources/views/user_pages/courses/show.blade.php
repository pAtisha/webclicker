@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Početna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kursevi</li>
                    </ol>
                </nav>

                @include('messages.errors')
                @include('messages.success')

                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Napomena!</strong> Za kurseve koje ne koriste šifru samo se prijavite.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <hr class="border border-dark border-2 opacity-50">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ime predmeta</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Status prijave</th>
                        <th scope="col">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->id}}</td>
                            <td>{{$course->name}}</td>
                            <td>{{$course->professor_name}}</td>
                            <td>@if($course->following == '')<p class="fw-bold">Niste prijavljeni</p> @else <p class="fw-bold">{{$course->following}}</p>@endif</td>
                            <td>
                                @if($course->following == '')
                                <form action="{{ url('/student/courses/follow/create',$course->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-2">
                                        <input type="text" id="input_password_course" class="form-control" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2" name="password">

                                        <button type="submit" class="btn btn-primary">Prijavi se</button>
                                    </div>
                                </form>
                                @else
                                    <form action="{{ url('/student/courses/unfollow',$course->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-danger">Odjavi se</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
