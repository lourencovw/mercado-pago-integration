<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="https://sdk.mercadopago.com/js/v2"></script>


</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <h1 class="text-blue-50">Pagar: R$ 100,00</h1>
            </div>

            <div class="mt-16 bg-gray-200 p-2 rounded-md">
                <form id="form-checkout" action="/ticket" method="post">
                    @csrf
                    <div>
                        <div class="flex justify-between" >
                            <label for="firstName">Nome</label>
                            <input id="form-checkout__firstName" name="firstName" type="text">
                        </div>
                        <div class="flex justify-between" >
                            <label for="lastName">Sobrenome</label>
                            <input id="form-checkout__lastName" name="lastName" type="text">
                        </div>
                        <div class="flex justify-between" >
                            <label for="cpf">CPF</label>
                            <input id="form-checkout__cpf" name="cpf" type="text">
                        </div>
                        <div class="flex justify-between" >
                            <label for="address">Address</label>
                            <input id="form-checkout__address" name="address" type="text">
                        </div>
                        <div class="flex justify-between" >
                            <label for="cep">CEP</label>
                            <input id="form-checkout__cep" name="cep" type="text">
                        </div>
                        <div class="flex justify-between" >
                            <label for="city">City</label>
                            <input id="form-checkout__city" name="city" type="text">
                        </div>
                        <div class="flex justify-between" >
                            <label for="uf">UF</label>
                            <input id="form-checkout__uf" name="uf" type="text">
                        </div>
                    </div>

                    <div>
                        <div>
                            <input type="hidden" name="transactionAmount" id="transactionAmount" value="100">
                            <input type="hidden" name="description" id="description" value="Nome do Produto">
                            <br>
                            <button type="submit">Gerar Boleto</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</body>

</html>
