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
                <h2>Criar Produto</h2>
                <form action="{{route('add-product')}}" method="post" enctype="multipart/form-data" class="flex flex-col gap-2">
                    @csrf
                    <input type="text" name="name" placeholder="Nome" class="input" required/>
                    <input name="price" placeholder="Preço" type="text" pattern="^\d+(\.\d{1,2})?$" class="input" required>
                    <span class="flex m-2 text-gray-400">OBS: Escreva o preço do produto e separe somente os decimais usando ponto. Não use vírgulas.</span>
                    <input type="number" name="quantity" placeholder="Quantidade" class="input" required/>
                    <input type="text" name="description" placeholder="Descrição" class="input" required/>
                    <input type="text" name="category" placeholder="Categoria" class="input" required/>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Imagem do produto</legend>
                        <input type="file" class="file-input" name='photo'/>
                        <label class="fieldset-label">Max size 2MB</label>
                    </fieldset>
                    <button class="btn btn-success" type="submit">Criar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>