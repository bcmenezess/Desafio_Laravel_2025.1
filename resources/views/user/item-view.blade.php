<x-app-layout>
        <div class="card lg:card-side bg-base-900 shadow-sm text-black m-4">
            @if(Storage::disk('public')->exists($product->photo))
            <figure class="w-fit h-96 flex-shrink-0">
              <img class="w-full h-full object-cover" src="{{asset('storage/' . $product->photo)}}"/>
            </figure>
            @endif
            <div class="card-body">
                <h2 class="card-title">{{$product->name}}</h2>
                <div>
                    <p class="font-bold">Vendedor:</p>
                    <p>{{$seller->name}}</p>
                </div>
                <div>
                    <p class="font-bold">Contato:</p>
                    <p>{{$seller->telephone}}</p>
                </div>
                <p class="text-lg font-bold text-green-600">{{'R$ ' . number_format($product->price,'2',',','.')}}</p>
                <div>
                    <p class="font-bold">Em estoque:</p>
                    <p>{{$product->quantity}}</p>
                </div>
                <span class="badge">{{$product->category}}</span>
                <div>
                    <p class="font-bold">Sobre:</p>
                    <p>{{$product->description}}</p>
                </div>
                <div class="card-actions justify-end">
                    @if (isAdmin())
                        <p class="font-bold text-red-800">Sua conta não tem permissão para fazer compras</p>
                    @elseif($product->user_id == usuarioLogado()->id)
                        <p class="font-bold text-red-800">Você não pode comprar um produto anunciado pela sua conta</p>
                    @elseif (isUser() && ($product->quantity > 0))
                        <form action="{{route('checkout')}}" method="post" class="flex flex-col gap-2">
                            @csrf
                            <div class="flex flex-col">
                                <label for="quantity_input">Insira a quantidade:</label>
                                <input type="number" name="quantity_input" class="input text-white" value="1" min="1" max="{{$product->quantity}}" required>
                            </div>
                            <input type="hidden" name="product" value="{{json_encode($product)}}">
                            <button class="btn btn-success" type="submit">Comprar</button>

                            @if ($errors->has('message'))
                                <p class="text-red-500">{{ $errors->first('message') }}</p>
                            @endif
                        </form>
                    @else
                        <p class="font-bold text-red-800">Estoque vazio!</p>
                    @endif
                </div>
            </div>
        </div>
</x-app-layout>