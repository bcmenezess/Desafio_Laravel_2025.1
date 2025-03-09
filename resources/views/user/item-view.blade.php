<x-app-layout>
        <div class="card lg:card-side bg-base-900 shadow-sm text-black m-4">
            <figure>
              <img src="https://neofeed.com.br/wp-content/uploads/2020/03/harley-1.jpg"/>
            </figure>
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
                <p class="text-lg font-bold text-green-600">R${{$product->price}}</p>
                <div>
                    <p class="font-bold">Quantidade:</p>
                    <p>{{$product->quantity}}</p>
                </div>
                <span class="badge">{{$product->category}}</span>
                <div>
                    <p class="font-bold">Sobre:</p>
                    <p>{{$product->description}}</p>
                </div>
                <div class="card-actions justify-end">
                    <button class="btn btn-success">Comprar</button>
                </div>
            </div>
        </div>
</x-app-layout>