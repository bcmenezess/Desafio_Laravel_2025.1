<x-app-layout>
    <div class="flex flex-col justify-center items-center">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Histórico de compras') }}
            </h2>
        </x-slot>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-gray-900 mt-10 mb-10">
            <table class="table">
              <!-- head -->
              <thead class="bg-gray-950">
                <tr class="text-white">
                  <th>Imagem</th>
                  <th>Nome do produto</th>
                  <th>Quantidade</th>
                  <th>Preço total</th>
                  <th>Data</th>
                  <th>Vendedor</th>
                  <th>
                    <form action="{{route('purchases')}}" method="post">
                        @csrf
                        <button class="btn btn-info text-white" type="submit">Gerar relatório</button>
                      </form>
                  </th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @foreach ($transactions as $transaction)

                @php
                    $p = App\Models\Product::find($transaction->product_id);
                    $seller = App\Models\User::find($p->user_id)->name;
                @endphp

                    <tr>
                    <th>
                        <img class="w-40 h-auto" src="{{App\Models\Product::find($transaction->product_id)->photo}}" alt="">
                    </th>
                    <td>{{App\Models\Product::find($transaction->product_id)->name}}</td>
                    <td>{{$transaction->quantity}}</td>
                    <td>{{"R$ " . number_format($transaction->total_price,'2',',','.')}}</td>
                    <td>{{Carbon\Carbon::parse($transaction->date)->format('d/m/Y')}}</td>
                    <td>{{$seller}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="p-4">
                {{$transactions->links()}}
            </div>
          </div>
    </div>
</x-app-layout>