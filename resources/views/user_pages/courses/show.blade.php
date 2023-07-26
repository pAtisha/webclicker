@extends('layouts.app')
<section>
@section('content')


    <div class="container form-floating">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Kursevi</li>
                    </ol>
                </nav>

                @include('messages.errors')
                @include('messages.success')

                <hr class="border border-white border-1 opacity-100">

                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-sm-4" style="margin-bottom: 10px;">
                            <div class="card bg-transparent border-white">
                                <div class="card-body">
                                    <h4 class="card-title text-white"><i class="bi bi-book-fill"></i> {{$course->name}}</h4>
                                    <h4 class="card-title text-white"><i class="bi bi-person-fill"></i> {{$course->professor_name}}</h4>
                                    @if($course->following == '')
                                        @if($course->password)
                                            <form action="{{ url('/student/courses/follow/create',$course->id) }}" method="POST">
                                                @csrf
                                                    <div class="input-group mb-2">
                                                        <h4 class="card-title text-white" style="padding-right: 5px;"><i class="bi bi-patch-check-fill"></i></h4>
                                                    <input type="password" id="input_password_course" class="form-control" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2" name="password">

                                                    <button type="submit" class="btn btn-outline-light btn-white-blue">Prijavi se</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{ url('/student/courses/follow/create',$course->id) }}" method="POST">
                                                @csrf
                                                <div class="input-group mb-2">
                                                    <h4 class="card-title text-white"><i class="bi bi-patch-check-fill"></i> <button type="submit" class="btn btn-outline-light btn-white-blue">Prijavi se</button></h4>
                                                </div>
                                            </form>
                                        @endif
                                    @else
                                        <td>
                                            <form action="{{ url('/student/courses/unfollow',$course->id) }}" method="POST">
                                                @csrf
                                                <h4 class="card-title text-white"><i class="bi bi-patch-check-fill"></i>
                                                <a href="{{url('/student/courses', $course->id)}}" class="btn btn-outline-light btn-white-blue">Testovi</a>
                                                    <button type="submit" class="btn btn-danger ms-1">Odjavi se</button></h4>
                                            </form>
                                        </td>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

{{--                <table class="table table-striped">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">Ime predmeta</th>--}}
{{--                        <th scope="col">Profesor</th>--}}
{{--                        <th scope="col">Status prijave</th>--}}
{{--                        <th scope="col" colspan="2"></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($courses as $course)--}}
{{--                        <tr>--}}
{{--                            <td>{{$course->name}}</td>--}}
{{--                            <td>{{$course->professor_name}}</td>--}}
{{--                            <td>@if($course->following == '')<i class="bi bi-x-lg bigger-icon"></i> @else<i class="bi bi-check-lg bigger-icon"></i> @endif</td>--}}
{{--                            @if($course->following == '')--}}
{{--                            <td>--}}
{{--                            @if($course->password)--}}
{{--                                    <form action="{{ url('/student/courses/follow/create',$course->id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <div class="input-group mb-2">--}}
{{--                                            <input type="password" id="input_password_course" class="form-control" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2" name="password">--}}

{{--                                            <button type="submit" class="btn btn-primary">Prijavi se</button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                            @else--}}
{{--                                    <form action="{{ url('/student/courses/follow/create',$course->id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <div class="input-group mb-2">--}}
{{--                                            <button type="submit" class="btn btn-primary">Prijavi se</button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                            @endif--}}
{{--                            </td>--}}
{{--                            @else--}}
{{--                            <td>--}}
{{--                                <form action="{{ url('/student/courses/unfollow',$course->id) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <a href="{{url('/student/courses', $course->id)}}" class="btn btn-primary">Testovi</a>--}}
{{--                                    <button type="submit" class="btn btn-danger">Odjavi se</button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                            @endif--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}

            </div>
        </div>
    </div>
@endsection
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
