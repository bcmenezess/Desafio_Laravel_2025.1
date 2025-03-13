<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de vendas</title>
    <style>
        body {font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif}
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 2px solid black; padding: 12px; }
        th { background-color: #6b6b6b; color: white; }
        h1 {border: black solid 2px; padding: 12px; text-align: center;}
        .price {color: rgb(32, 124, 32)}
        .id{background-color: white; color: black}
    </style>
</head>
    <body>

        <h1>RELATÓRIO DE VENDAS</h1>
        <table class="table">
              <!-- head -->
            <thead class="bg-gray-950">
                <tr class="text-white">
                  <th>ID</th>
                  <th>Nome do produto</th>
                  <th>Categoria</th>
                  <th>Quantidade</th>
                  <th>Preço total</th>
                  <th>Data</th>
                  <th>Comprador</th>
                  <th>Vendedor</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @foreach ($transactions as $transaction)

                @php
                    $p = App\Models\Product::find($transaction->product_id);
                    $seller = App\Models\User::find($p->user_id)->name;
                    $buyer = App\Models\User::find($transaction->buyer_id)->name;
                @endphp

                    <tr class="flex gap-4">
                    <th class="id">{{$transaction->id}}</th>
                    <td>{{App\Models\Product::find($transaction->product_id)->name}}</td>
                    <td>{{$p->category}}</td>
                    <td>{{$transaction->quantity}}</td>
                    <td class="price">{{"R$ " . number_format($transaction->total_price,'2',',','.')}}</td>
                    <td>{{Carbon\Carbon::parse($transaction->date)->format('d/m/Y')}}</td>
                    <td>{{$buyer}}</td>
                    <td>{{$seller}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
