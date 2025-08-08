@extends('layouts.app')

@section('body_class', 'p-5')

@section('content')

    <div>
        <h1 class="text-white text-center fw-bold" style="margin-top: 5rem">Minhas metas</h1>
        <h3 class="text-white text-center text-break" style="margin-top: 3rem">Transforme seus objetivos em conquistas! Escreva suas metas, acompanhe seu
            progresso e alcance seus sonhos
            com
            disciplina e motivação</h3>
        <div>
            <a href="/entrar"><button class="btn gradient-background-light p-3" type="button">Quero criar minhas
                    metas!</button></a>
        </div>
    </div>

@endsection