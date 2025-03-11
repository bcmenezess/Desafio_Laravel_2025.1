<x-app-layout>


    <div class="hero bg-base-200 h-full p-20">
        <div class="hero-content text-center">
          <div class="max-w-md">
            <h1 class="text-5xl font-bold">Bem vindo ao Ecommerce, {{$user->name}}!</h1>
            <p class="py-6">
              Gaste seu dinheiro com sabedoria
            </p>
          </div>
        </div>
      </div>

      <div class="flex justify-center mt-10 mb-10">
        <form action="{{ route('landing-page') }}" method="get" class="flex flex-wrap gap-4 items-center w-full max-w-2xl">
            @csrf

            <input type="search" class="grow input input-md w-full md:w-auto" name="busca" placeholder="Buscar por..." value="{{ request('busca') }}" />

            <select name="category" class="select select-md w-full md:w-auto">
                <option value="">Todas as Categorias</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            <button class="btn btn-md btn-info w-full md:w-auto" type="submit">Buscar</button>
        </form>
    </div>


      <div class="flex flex-wrap justify-center">

        @if(isset($message))
          <span class="text-gray-700 m-12">{{$message}}</span>
        @endif

        @foreach ($products as $product)
        <div class="card image-full bg-base-100 w-48 h-60 shadow-sm m-4">
            <figure>
              <img
                src="https://neofeed.com.br/wp-content/uploads/2020/03/harley-1.jpg"/>
            </figure>
            <div class="card-body">
              <h2 class="card-title">{{$product->name}}</h2>
              <p>R${{$product->price}}</p>
                <div class="card-actions justify-end">
                    @if(isUser())
                    <a class="btn btn-outline btn-success" href="item/{{$product->id}}">Comprar</a>
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