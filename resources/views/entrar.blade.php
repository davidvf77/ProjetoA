@extends('layouts.app')

@section('body_class', 'p-5 text-white')

@section('content')

    <div id="divBtns" class="d-flex gap-5 w-75 p-3">
        <button onclick="register()" class="btnEntrar fs-4 btn 
        gradient-background-light p-3">Registrar-se</button>
        <button onclick="login()" class="btnEntrar fs-4 btn 
        gradient-background-light p-3">Logar</button>
    </div>

    <div id="divEntrar" class="mt-5 invisible">
        <form method="POST" id="formLogin">
            @csrf           
            <div class="d-flex flex-column align-items-center">
                <input type="hidden" id="acao" name="acao"> 
                <!--Campo Hidden Para passar ação do form-->
               
                <div class="mb-4">
                    <label for="exampleFormControlInput1" 
                    class="form-label">Nome de Usuário</label>
                    <input required class="form-control gradient-background-light text-white"
                     name="username" type="text">
                </div>

                <div class="mb-4">
                    <label for="exampleFormControlInput1" 
                    class="form-label">Senha</label>
                    <input required class="form-control 
                gradient-background-light text-white" 
                name="password" type="password">
                </div>

                <div id="confSenha" class="mb-4 invisible">
                    <label for="exampleFormControlInput1" 
                    class="form-label">Confirmar Senha</label>
                    <input id="confSenhaInput" required class="form-control
                gradient-background-light text-white" 
                name="password_confirmation" type="password"">
                </div>

                <button type="submit"
                    class="btnSeguir m-5 position-absolute bottom-0 
                    end-0 btn gradient-background-light p-3"
                    >Confirmar</button>

                <a href="/entrar"><button
                        class="btnVoltar m-5 position-absolute bottom-0 
                        start-0 btn gradient-background-light p-3"
                        type="button">Voltar</button></a>
            </div>
        </form>
    </div>

@endsection

@if(session('error'))
<script>
    window.sessionError = "{{ session('error') }}";
    window.sessionForm = "{{ session('form', 'login') }}";
</script>
@endif

@push('scripts')
    <script src="{{ asset('js/alerts.js') }}"></script>
@endpush
    