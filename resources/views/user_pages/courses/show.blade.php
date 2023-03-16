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
                    <tr>
                        <th scope="row">1</th>
                        <td>Semantički Web</td>
                        <td>Milorad Tošić</td>
                        <td>Niste prijavljeni</td>
                        <td>
                            <div class="input-group mb-2">
                                <input type="text" id="input_password_course" class="form-control" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Prijava</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Web dizajn</td>
                        <td>Antonio Janković</td>
                        <td>Prijavljeni ste</td>
                        <td>
                            <div class="input-group mb-2">
                                <button class="btn btn-outline-danger" type="button" id="button-addon2">Odjava</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Programiranje</td>
                        <td>Nenad Petrović</td>
                        <td>Niste prijavljeni</td>
                        <td>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" placeholder="Unesite lozinku" aria-label="Unesite lozinku" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Prijava</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
