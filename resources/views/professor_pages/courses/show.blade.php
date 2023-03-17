@extends('layouts.app')

@section('content')

    @include('professor_pages.courses.create')
    @include('professor_pages.courses.delete')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                    <button class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addCourseModal">Dodaj Kurs</button>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home">Početna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kursevi</li>
                    </ol>
                </nav>

                @include('messages.errors')
                @include('messages.success')



                <hr class="border border-dark border-2 opacity-50">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Šifra</th>
                        <th scope="col">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->id}}</td>
                            <td>{{$course->name}}</td>
                            <td>{{$course->password}}</td>
                            <td>
                                <button class="btn btn-primary">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-course" data-bs-toggle="modal" data-bs-target="#deleteCourseModal" id="deleteCourseButton" value="{{$course->id}}">Obriši</button>
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/active',$course->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($course->active)checked @endif>
                                    </div>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

