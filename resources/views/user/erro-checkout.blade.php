<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erro no checkout</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="errorBody bg-white flex items-center justify-center">
    <main class="w-full h-full flex items-center justify-center">
        <div class="card bg-gray-100 p-6 shadow-lg text-black">
            <div class="card-body flex flex-col items-center">
                <img class="w-32 h-32 mb-4" src="https://png.pngtree.com/png-vector/20190704/ourmid/pngtree-payment-failure-icon-in-trendy-style-isolated-background-png-image_1538637.jpg" alt="Erro no checkout">
                <h2 class="text-xl font-bold text-center">Ops! Erro no checkout!</h2>
                <p class="font-bold text-center">Tente novamente</p>
            </div>
        </div>
    </main>
</body>
</html>
