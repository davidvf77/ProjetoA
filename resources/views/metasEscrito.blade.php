@extends('layouts.app')

@section('body_class', 'container gradient-background p-5 text-white')

@section('content')

<body class="container gradient-background p-5 text-white">
    <form id="form2" method="POST" action="/metas/salvar">
        @csrf
        <h3 class="mb-5 fs-1">Digite suas metas:</h3>

        <div id="divCaixaMetasWrapper" class="mt-4 d-flex justify-content-center">         
                @if(count($metas) > 0)
                    @foreach ($metas as $i => $meta)
                        <div class="caixa-meta-stack d-flex flex-row align-items-center position-relative">
                            <textarea class="caixaMetas form-control gradient-background-light" 
                            id="meta{{ $i + 1 }}" data-salva="1"
                                placeholder="Meta {{ $i + 1 }}">{{ $meta }}</textarea>
                            @if ($loop->last)
                                <img class="ms-4 btn-img" onclick="addMeta()" src="{{ asset('assets/mais.png') }}"
                                    alt="Adicionar" />
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="caixa-meta-stack d-flex flex-row align-items-center position-relative">
                        <textarea class="caixaMetas form-control gradient-background-light" id="meta1"
                            placeholder="Meta 1"></textarea>
                        <img class="ms-4 btn-img" onclick="addMeta()" src="{{ asset('assets/mais.png') }}"
                            alt="Adicionar" />
                    </div>
                @endif
        </div>

        <input type="hidden" name="metas_json" id="metas_json">

        <button type="submit" class="btnSeguir m-5 position-absolute 
        bottom-0 end-0 btn gradient-background-light p-3"
            type="button">Seguir</button>
        
    </form>

@endsection

@stack('scripts')
    <script>
        const imgAddMetaUrl = "{{ asset('assets/mais.png') }}";
    </script>

