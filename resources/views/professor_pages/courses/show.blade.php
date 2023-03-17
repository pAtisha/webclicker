@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/professor/home">Početna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kursevi</li>
                    </ol>
                </nav>

                <hr class="border border-dark border-2 opacity-50">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ime i Prezime</th>
                        <th scope="col">Tip</th>
                        <th scope="col">Broj indeksa</th>
                        <th scope="col">Email</th>
                        <th scope="col">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
