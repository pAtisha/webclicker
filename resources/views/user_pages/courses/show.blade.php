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

                <hr class="border border-dark border-2 opacity-50">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Ime predmeta</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Status prijave</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->name}}</td>
                            <td>{{$course->professor_name}}</td>
                            <td>@if($course->following == '')<i class="bi bi-x-lg bigger-icon"></i> @else<i class="bi bi-check-lg bigger-icon"></i> @endif</td>
                            @if($course->following == '')
                            <td>
                            @if($course->password)
                                    <form action="{{ url('/student/courses/follow/create',$course->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group mb-2">
                                            <input type="password" id="input_password_course" class="form-control" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2" name="password">

                                            <button type="submit" class="btn btn-primary">Prijavi se</button>
                                        </div>
                                    </form>
                            @else
                                    <form action="{{ url('/student/courses/follow/create',$course->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group mb-2">
                                            <button type="submit" class="btn btn-primary">Prijavi se</button>
                                        </div>
                                    </form>
                            @endif
                            </td>
                            @else
                            <td>
                                <form action="{{ url('/student/courses/unfollow',$course->id) }}" method="POST">
                                    @csrf
                                    <a href="{{url('/student/courses', $course->id)}}" class="btn btn-primary">Testovi</a>
                                    <button type="submit" class="btn btn-danger">Odjavi se</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
