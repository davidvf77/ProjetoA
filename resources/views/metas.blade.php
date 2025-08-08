@extends('layouts.app')

@section('body_class', 'p-5 text-white')

@section('content')

    <form id="form1" method="POST" action="/metas/data/salvar">
        @csrf
        <h3>Em quanto tempo deseja bater suas metas?</h3>
        <div>
            <select class="form-select gradient-background-light text-white mt-4" id="q1" 
            onchange="tempoEspecifico()">
                <option class="text-black" value="dia">Um dia</option>
                <option class="text-black" value="semana">Uma semana</option>
                <option class="text-black" value="mes">Um mês</option>
                <option class="text-black" value="ano">Um ano</option>
                <option class="text-black" value="outro">Quero escolher um período 
                    específico</option>
            </select>
        </div>

        <div class="mt-4 invisible" id="tempo-especifico">
            
        <label for="data-inicio">Data de Início:</label>
        <input type="date" id="data-inicio" name="data_inicio">

        <label for="data-fim">Data de Fim:</label>
        <input type="date" id="data-fim" name="data_conclusao">

        </div>
        
        <button class="btnSeguir m-5 position-absolute bottom-0 end-0 
        btn gradient-background-light p-3" type="submit">Seguir</button>

    </form>
    
@endsection