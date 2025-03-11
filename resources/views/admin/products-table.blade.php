<x-app-layout>
    <div class="flex flex-col justify-center items-center">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tabela de produtos') }}
            </h2>
        </x-slot>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-gray-900 mt-10 mb-10">
            <table class="table">
              <!-- head -->
              <thead class="bg-gray-950">
                <tr class="text-white">
                  <th></th>
                  <th>Nome</th>
                  <th>Categoria</th>
                  <th>Preço</th>
                  <th>Em estoque</th>
                  <th>Criador do anúncio</th>
                  <th>Ações</th>
                  {{-- @if (isUser()) --}}
                  <th>
                    <a href="products-table/add" class="btn btn-success text-lg font-black">+</a>
                  </th>
                  {{-- @endif --}}
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                @foreach ($products as $product)
                    <tr>
                    <th>{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{"R$ " . number_format($product->price,'2',',','.')}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{App\Models\User::find($product->user_id)->name}}</td>
                    <td class="flex gap-2">
                        <a href="{{route('item-view',$product->id)}}" class="btn btn-soft bg-gray-200 text-black">Ver</a>
                        <a href="products-table/edit/{{$product->id}}" class="btn btn-warning">Editar</a>
                        <a href="products-table/delete/{{$product->id}}" class="btn btn-error">Deletar</a>
                    </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="p-4">
                {{$products->links()}}
            </div>
          </div>
    </div>
</x-app-layout>