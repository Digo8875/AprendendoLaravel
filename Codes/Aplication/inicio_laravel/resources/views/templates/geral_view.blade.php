<html lang="pt-br">
    <head> 

        <meta charset="utf-8">
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/glyphicons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/site.css') }}" rel="stylesheet">
        <link href="{{ asset('css/default.css') }}" rel="stylesheet">

        <title>@yield('titulo')</title>

    </head>
    <body>
    <div class='container-fluid div-mestre col-lg-12'>
        <header class='cabecalho col-lg-12'>
            <div class='row'>
                <nav class='navbar rounded col-lg-12'>
                    <div class='col-lg-12'>
                        <a class='navbar-brand col-lg-3' href='{{url('/')}}'>
                            <nav class='navbar-light bg-light rounded col-lg-12'>
                                <div class='texto-logo col-lg-12'>
                                    </br>
                                    <h3>Iniciando Laravel - Controle de Estoque</h3>
                                </div>
                            </nav>
                        </a>
                    </div>
                </nav>
            </div>
            </br>
            <div class='row'>
                <nav class='navbar rounded col-lg-12'>
                    <div class='dropdown col-lg-2'>
                        <button class='btn btn-secondary dropdown-toggle col-lg-12' type='button' id='dropdownMenuFuncionalidades' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Funcionalidades
                        </button>
                        <div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuFuncionalidades'>
                            <a class='dropdown-item' href='{{ url('/produto') }}'>Produto</a>
                            <a class='dropdown-item' href='{{ url('/venda') }}'>Venda</a>
                            <a class='dropdown-item' href='{{ url('/recebimento') }}'>Recebimento</a>
                        </div>
                    </div>

                    <div class='dropdown col-lg-2'>
                        <button class='btn btn-secondary dropdown-toggle col-lg-12' type='button' id='dropdownMenuFuncionalidades' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Relatórios
                        </button>
                        <div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuFuncionalidades'>
                            <a class='dropdown-item' href='{{ url('/relatorio_estoque') }}'>Estoque</a>
                            <a class='dropdown-item' href='{{ url('/relatorio_venda') }}'>Venda</a>
                        </div>
                    </div>

                    <div class='dropdown col-lg-8'>
                    </div>

                </nav>
            </div>
        </header>


        @yield('conteudo')


        <div class='copylefts text-center'>
            <p> Copyleft - 2019 - BY Rodrigo Cândido </p>
        </div>
        <div>
            <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/Main.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/Init.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/Url.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/legend.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.pt-BR.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/chosen.jquery.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/chosen.proto.js') }}"></script>

        </div>
    </div>
    </body> 
</html>