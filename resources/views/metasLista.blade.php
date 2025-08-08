@extends('layouts.app')

@section('body_class', 'mt-1 container gradient-background text-white')

@section('content')

    @foreach ($metas as $meta)

    @if ($meta['concluida'] == 1)
     <div id="metaListadaConcluida" class=" metaConcluida d-flex justify-content-between border-bottom py-2 custom-border">

            <div class="fs-2 mt-2">Meta {{ $meta->numero }}</div>

            <div class="fs-5 mt-5 mb-5 text-break" style="max-width: 600px;">{{ $meta->conteudo }}</div>

            <div class="divBtnLista mt-2 align-self-center">
                <div>
                    <form action="/metas/complete/{{$meta->id}}" method="POST" onsubmit="return confirmarConclusao();">
                        @csrf
                        <button type="submit" id="btnListaComplete"
                            class="fs-6 btn gradient-background-light m-0 mb-3">Desfazer
                        </button>
                    </form>
                </div>
                @if($quantidadeMetas > 1)
                <div>
                    <form action="/metas/delete/{{$meta->id}}" method="POST" onsubmit="return confirmarExclusao();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="btnListaDelete"
                            class="fs-6 btn gradient-background-light m-0 mb-3">Excluir
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    @else
        <div id="metaListada" class="d-flex justify-content-between border-bottom py-2 custom-border">

            <div class="fs-2 mt-2">Meta {{ $meta->numero }}</div>

            <div class="fs-5 mt-5 mb-5 text-break" style="max-width: 600px;">{{ $meta->conteudo }}</div>

            <div class="divBtnLista mt-2 align-self-center">
                <div>
                    <form action="/metas/complete/{{$meta->id}}" method="POST" onsubmit="return confirmarConclusao();">
                        @csrf
                        <button type="submit" id="btnListaComplete"
                            class="fs-6 btn gradient-background-light m-0 mb-3">Concluída
                        </button>
                    </form>
                </div>
                @if($quantidadeMetas > 1)
                <div>
                    <form action="/metas/delete/{{$meta->id}}" method="POST" onsubmit="return confirmarExclusao();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="btnListaDelete"
                            class="fs-6 btn gradient-background-light m-0 mb-3">Excluir
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
          @endif
    @endforeach

    <a href="/metas/dashboard"><button class="btnVerDashboard position-absolute 
        bottom-0 start-0 btn gradient-background-light p-3" type="button">Voltar</button></a>

    {{ $metas->links('pagination::bootstrap-5') }}
 
@endsection

@push('scripts')
    <script src="{{ asset('js/alerts.js') }}"></script>
@endpush
    