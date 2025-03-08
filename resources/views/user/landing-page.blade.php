<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Landing page') }}
        </h2>
    </x-slot>

    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content text-center">
          <div class="max-w-md">
            <h1 class="text-5xl font-bold">Bem vindo ao Ecommerce, {{$user->name}}!</h1>
            <p class="py-6">
              Gaste seu dinheiro com sabedoria
            </p>
          </div>
        </div>
      </div>

      <label class="input flex mt-10 mb-2 justify-self-center">
        <form action="{{route('landing-page')}}" method="get">
            @csrf
            <input type="search" class="grow" name="busca" placeholder="Buscar por..." value="{{ request('busca') }}" />

            <select name="category" class="text-black">
                <option value="">Todas as Categorias</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            <button class="btn btn-sm btn-info" type="submit">Buscar</button>
        </form>
      </label>


      <div class="flex flex-wrap justify-center">

        @if(isset($message))
          <span class="text-gray-700 m-12">{{$message}}</span>
        @endif

        @foreach ($products as $product)
        <div class="card bg-base-100 w-48 shadow-sm m-4">
            <figure>
              <img
                src="https://neofeed.com.br/wp-content/uploads/2020/03/harley-1.jpg"/>
            </figure>
            <div class="card-body">
              <h2 class="card-title">{{$product->name}}</h2>
              <p>R${{$product->price}}</p>
              <p>{{$product->category}}</p>
                <div class="card-actions justify-end">
                    @if(isUser())
                    <button class="btn btn-outline btn-success">Comprar</button>
                    @endif
                </div>
            </div>
          </div>
        @endforeach
    </div>

    <div class="flex justify-self-center mt-8 mb-8">
        {{ $products->appends(request()->query())->links() }}
    </div>


</x-app-layout>