<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metas</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
          rel="stylesheet"
          integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
          crossorigin="anonymous">
    
    {{-- CSS personalizado --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body data-success="{{ session('success') }}"
    data-error="{{ session('error') }}"
    class="@yield('body_class', 'default-body-class')">
    
    @yield('content')

    {{-- Scripts globais --}}
    <script src="{{ asset('js/metas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>


    {{-- Scripts específicos por página --}}
    @stack('scripts')

</body>
</html>