@extends('layouts.app')
<section>
@section('content')

    <div class="container form-floating">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/student/courses" class="text-white">Kursevi</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">{{$course->name}} - Testovi</li>
                    </ol>

                </nav>

                @include('messages.errors')
                @include('messages.success')

                <hr class="border border-white border-1 opacity-100">
                <h4 class="text-center fw-bold text-white">{{$course->name}}</h4>

                @foreach($tests as $test)
                    @if($test->open == 1)
                    <div class="card text-center bg-yellow">
                        <div class="card-header">
                            Otvoren Test
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$test->name}}</h5>
                            <p class="card-text">Vreme za izradu ovog testa je <span class="fw-bolder">{{$test->time}}</span>  minuta.</p>
                            @if($test->password)
                                <form action="{{ url('/student/test/create/password/'. $test->id) }}" method="POST" onkeypress="return event.keyCode != 13;">
                                    @csrf

                                        <input type="password" id="input_password_course" class="form-control w-25" style="text-align: center; margin: auto;" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2" name="password">

                                        <button class="mt-2 btn btn-success @if($test->open == 0)disabled @endif" type="submit">Započni</button>
                                </form>
                            @else
                                <a class="btn btn-success @if($test->open == 0)disabled @endif" href="/student/test/create/{{$test->id}}">Započni</a>
                            @endif
                        </div>
                        <div class="card-footer">
                            Test je otvoren pre <?php
                                                    $now = now();
                                                    $diff = $now->diffInMinutes($test->updated_at);
                                                    echo $diff;
                                                    ?> minuta.
                        </div>
                    </div>
                    @endif
                @endforeach

                <h4 class="text-center fw-bold text-white"  style="margin-top: 20px;">Istorija Testova <i class="bi bi-clock-history"></i></h4>

                <table class="table table-bg-blue text-white">
                    <thead>
                    <tr>
                        <th scope="col">Naziv <i class="bi bi-pen"></i></th>
                        <th scope="col">Pokrenut <i class="bi bi-hourglass-split"></i></th>
                        <th scope="col">Završen <i class="bi bi-hourglass-bottom"></i></th>
                        <th scope="col">Osvojeni / Maksimum poeni <i class="bi bi-check2-square"></i></th>
                        <th scope="col">Pregled <i class="bi bi-eye"></i></th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach($history_tests as $history_test)
                        <tr>
                            <td>{{$history_test['name']}}</td>
                            <td>{{$history_test['starting_time']}}</td>
                            <td>{{$history_test['finishing_time']}}</td>
                            <td class="text-center">{{$history_test['points']}} / {{$history_test['max_points']}}</td>
                            <td>
                                <a href="{{route('test_preview', $history_test['id'])}}" class="btn btn-outline-light">Pogledaj</a>
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


