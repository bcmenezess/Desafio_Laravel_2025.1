<x-app-layout>

    <div class="flex flex-col gap-4 justify-center items-center mt-10">
        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card bg-neutral text-neutral-content w-96 bg-gray-900">
            <div class="card-body items-center text-center">
                <h2>Editar Produto</h2>
                <form action="{{route('edit-product',$product->id)}}" method="post" enctype="multipart/form-data" class="flex flex-col gap-2">
                    @method('put')
                    @csrf
                    <input value="{{$product->name}}" type="text" name="name" placeholder="Nome" class="input" required/>
                    <input name="price" value="{{$product->price}}" placeholder="Preço" type="text" pattern="^\d+(\.\d{1,2})?$" class="input" required>
                    <span class="flex m-2 text-gray-400">OBS: Escreva o preço do produto e separe somente os decimais usando ponto. Não use vírgulas. (Ex: 1099.90)</span>
                    <input type="number" value="{{$product->quantity}}" name="quantity" placeholder="Quantidade" class="input" required/>
                    <textarea type="text" name="description" placeholder="Descrição" class="textarea" required>{{$product->description}}</textarea>
                    <input type="text" value="{{$product->category}}" name="category" placeholder="Categoria" class="input" required/>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Imagem do produto</legend>
                        <input type="file" class="file-input" name='photo'/>
                        <label class="fieldset-label">Max size 2MB</label>
                    </fieldset>

                    @if(isset($product->photo) && Storage::disk('public')->exists($product->photo))
                        <figure class="flex justify-center items-center flex-col">
                            <span class="fieldset-legend">Imagem atual do produto</span>
                            <img class="w-60 h-auto border-4 border-double border-white" src="{{asset('storage/'.$product->photo)}}">
                        </figure>
                    @else
                        <span class="fieldset-legend">Produto sem foto de perfil ou imagem não encontrada</span>
                    @endif
                    <button class="btn btn-warning mt-8" type="submit">Editar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>