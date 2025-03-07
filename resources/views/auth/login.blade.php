<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .cover {
            background: linear-gradient(rgba(25, 135, 84, 0.8), rgba(25, 135, 84, 0.8)), url('https://blog.imedicina.com.br/wp-content/uploads/2020/06/shutterstock_1501365494-2.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            display: none;
        }

        .benefits-list {
            font-size: 1.25rem; /* Aumenta o tamanho do texto */
            line-height: 1.8; /* Aumenta o espaçamento entre os itens */
            list-style: none; /* Remove os marcadores padrão */
            padding-left: 0; /* Remove o padding padrão */
        }

        .benefits-list li::before {
            content: '✓'; /* Símbolo personalizado, pode ser qualquer outro símbolo ou texto */
            color: white; /* Cor do símbolo */
            font-size: 1.5rem; /* Tamanho do símbolo */
            font-weight: bold; /* negrito */
            margin-right: 10px; /* Espaço entre o símbolo e o texto */
        }

        .title{
            display: none;
        }

        @media (min-width: 992px) {
            .cover {
                display: block;
            }
            .title {
                display: none; /* Esconde o título em telas grandes */
            }
        }

        @media (max-width: 991px) {
            .cover {
                display: none; /* Esconde o cover em telas pequenas */
            }

            .title {
                display: block; /* Mostra o título em telas pequenas */
            }
        }


    </style>
</head>
  <body>
    <div class="container-fluid" style="height: 100vh">
        <div class="row h-100">
            <div class="col-lg-7 bg-success d-lg-flex align-items-center justify-content-center cover">
                <div>
                    <h1 class="fw-bold text-center display-3">👨‍⚕️TELEMED</h1>
                    <h2 class="text-center h3 fw-medium fst-italic">"Seus exames na palma da mão"</h2>
                    <ul class="benefits-list p-3">
                        <li class="h4 fw-medium pt-4">Gerenciamento eficaz de exames</li>
                        <li class="h4 fw-medium pt-4">Acesso rápido aos resultados</li>
                        <li class="h4 fw-medium pt-4">Interface amigável e intuitiva</li>
                        <li class="h4 fw-medium pt-4">Histórico de exames sempre disponível</li>
                        <li class="h4 fw-medium pt-4">Segurança e privacidade dos seus dados</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5 p-lg-5 d-flex align-items-center">
                <div class="p-xs-5 p-md-5 p-lg-3 w-100">
                <h1 class="fw-bold text-center text-success display-1 pb-3 title">👨‍⚕️TELEMED</h1>
                    <h1 class="fw-bold text-success text-center">Login</h1>
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erro:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form class="py-4" action="/login" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com">
                            <label for="email">E-mail</label>
                        </div>

                            
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Senha" aria-describedby="passwordHelp">
                            <label for="password">Senha</label>
                        </div>
                       
                        <div class="pt-3">
                            <button type="submit" class="btn btn-lg btn-success w-100">Entrar</button>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>