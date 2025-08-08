@extends('layouts.app')

@section('body_class', 'container p-5 text-white')

@section('content')

    <h1 class="text-center mb-5" style="margin-top: 6rem">
        Seu progresso no momento em suas metas é {{ intval($percentual) }}%!
    </h1>
    
<div class="position-relative">
    <div class="progress mt-5 position-absolute top-50 start-50 translate-middle" role="progressbar"
        aria-label="Success example" 
        aria-valuenow="{{ $metasConcluidas->count() }}" 
        aria-valuemin="0" 
        aria-valuemax="{{ $metas->count() }}">

        <div class="gradient-background-light progress-bar bg-success" 
        style="width: {{ $percentual }}%">
        </div>
    </div>
</div>

    @if(intval($percentual) == 100)

        <h3 class="text-center position-absolute bottom-0 start-50 translate-middle-x"
        style="margin-bottom: 150px"> Parabéns! Você concluiu suas metas! <br>
        Cada meta alcançada é a prova de que a disciplina supera a dúvida e que você é capaz
        de ir ainda mais longe.
        </h3>

        <a href="/metas/resetar">
        <button class="btnVerMetas m-5 position-absolute top-0 end-0 btn gradient-background-light p-3" 
                type="button">Criar novas metas</button>
        </a>
   
    @else
        <h3 class="text-center position-absolute bottom-0 start-50 translate-middle-x"
        style="margin-bottom: 150px">

        @if($diff == 1)
            Você tem 1 dia até o fim da sua meta!
        @else
            Você tem {{ $diff }} dias até o fim da sua meta!
        @endif

        </h3>

        <h3 class="text-center position-absolute bottom-0 start-50 translate-middle-x" 
        style="margin-bottom: 200px">
        Continue se empenhando e vá em busca de seus objetivos!
        </h3>
    @endif

    <a href="/logout">
        <button class="btnLogout m-4 fs-6 position-absolute top-0 start-0 btn gradient-background-light p-1" 
                type="button">Sair</button>
    </a>

    <a href="/metas/criar">
        <button class="btnVerMetas m-5 position-absolute bottom-0 start-0 btn gradient-background-light p-3" 
                type="button">Editar metas</button>
    </a>

    <a href="/metas/lista">
        <button class="btnVerMetas m-5 position-absolute bottom-0 end-0 btn gradient-background-light p-3" 
                type="button">Ver metas</button>
    </a>

@endsection
