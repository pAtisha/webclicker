@extends('layouts.app')
<section>
@section('content')

    @include('professor_pages.courses.create')
    @include('professor_pages.courses.delete')
    @include('professor_pages.courses.edit')

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

                <button class="btn btn-outline-light btn-white-blue" style="float: right;" data-bs-toggle="modal" data-bs-target="#addCourseModal">Dodaj Kurs</button>


                <table class="table text-white">
                    <thead>
                    <tr>
                        <th scope="col">Naziv</th>
                        <th scope="col">Šifra</th>
                        <th scope="col">Vidljivost Kursa</th>
                        <th scope="col" colspan="3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->name}}</td>
                            <td>
                                @if($course->password)
                                    <i class="bi bi-lock-fill bigger-icon"></i>
                                @else
                                    <i class="bi bi-unlock-fill bigger-icon"></i>
                                @endif
                            </td>
                            <td>
                                <form action="{{ url('/professor/courses/active',$course->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-check form-switch">
                                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" @if($course->active)checked @endif>
                                    </div>

                                </form>
                            </td>
                            <td><a href="{{url('/professor/courses', $course->id)}}" class="btn btn-outline-light btn-white-blue">Idi na testove</a></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-edit-course" data-bs-toggle="modal" data-bs-target="#editCourseModal" id="editCourseButton" value="{{$course->id}}">Izmeni</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete-course" data-bs-toggle="modal" data-bs-target="#deleteCourseModal" id="deleteCourseButton" value="{{$course->id}}">Obriši</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
