@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/student/home">Početna</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/student/courses">Kursevi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Testovi</li>
                    </ol>

                </nav>

                @include('messages.errors')
                @include('messages.success')


                <hr class="border border-dark border-2 opacity-50">
                <h4 class="text-center fw-bold">{{$course->name}}</h4>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Naziv</th>
                        <th scope="col">Vreme za test</th>
                        <th scope="col" colspan="1">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tests as $test)
                        <tr>
                        <td>{{$test->name}}</td>
                        <td>{{$test->time}} minuta</td>
                        <td>
                            @if($test->password)
                                <form action="{{ url('/student/courses/test/create') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-2">
                                        <input type="password" id="input_password_course" class="form-control" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2" name="password">

                                        <button class="btn btn-success @if($test->open == 0)disabled @endif" type="submit">Započni</button>
                                    </div>
                                </form>
                            @else
                                <a class="btn btn-success @if($test->open == 0)disabled @endif" href="/student/test/create/{{$test->id}}">Započni</a>
                            @endif

                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

{{--                <hr class="border border-dark border-2 opacity-50">--}}
                <h4 class="text-center fw-bold"  style="margin-top: 80px;">Istorija Testova</h4>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Naziv</th>
                        <th scope="col">Broj Osvojenih Poena</th>
                        <th scope="col" colspan="1">Maksimum</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($history_tests as $history_test)
                        <td>{{$history_test->name}}</td>
                        <td></td>
                        <td></td>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection



