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
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <h1 class="text-blue-50">Pagar: R$ 100,00</h1>
            </div>

            <div class="mt-16">
                <div id="cardPaymentBrick_container"></div>
                <script>
                    const mp = new MercadoPago('{{ env('MP_PUBLIC_KEY') }}');
                    const bricksBuilder = mp.bricks();
                    const renderCardPaymentBrick = async (bricksBuilder) => {
                        const settings = {
                            initialization: {
                                amount: 100, // valor total a ser pago
                                payer: {
                                    email: 'test@mail.com',
                                },
                            },
                            customization: {
                                visual: {
                                    style: {
                                        theme: 'dark' // | 'dark' | 'bootstrap' | 'flat'
                                    }
                                }
                            },
                            callbacks: {
                                onReady: () => {
                                    console.log('It is ready');
                                },
                                onSubmit: (cardFormData) => {
                                    // callback chamado o usuário clicar no botão de submissão dos dados
                                    // exemplo de envio dos dados coletados pelo Brick para seu servidor
                                    return new Promise((resolve, reject) => {
                                        fetch("/api/process-payment-credit-card", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/json",
                                                },
                                                body: JSON.stringify(cardFormData)
                                            })
                                            .then((response) => {
                                                window.location.replace("/thanks");
                                                resolve();
                                            })
                                            .catch((error) => {
                                                reject();
                                            })
                                    });
                                },
                                onError: (error) => {
                                    // callback chamado para todos os casos de erro do Brick
                                    console.error(error);
                                },
                            },
                        };
                        window.cardPaymentBrickController = await bricksBuilder.create('cardPayment',
                            'cardPaymentBrick_container', settings);
                    };
                    renderCardPaymentBrick(bricksBuilder);
                </script>
            </div>

        </div>
    </div>
</body>

</html>
