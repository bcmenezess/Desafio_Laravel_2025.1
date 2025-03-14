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
                <h2>Criar Admin</h2>
                <form action="{{route('add-admin')}}" method="post" enctype="multipart/form-data" class="flex flex-col gap-2">
                    @csrf
                    <input type="text" name="name" placeholder="Nome" class="input" required/>
                    <input type="email" name="email" placeholder="Email" class="input" required/>
                    <input type="text" name="cpf" placeholder="CPF" class="input" required/>
                    <input type="text" name="address" placeholder="Endereço" class="input" required/>
                    <input type="date" name="date_birth" class="input" required/>
                    <input type="text" name="telephone" placeholder="Telefone" class="input" required/>
                    <input type="password" name="password" placeholder="Senha" class="input" required/>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Foto de perfil</legend>
                        <input type="file" class="file-input" name='photo'/>
                        <label class="fieldset-label">Max size 2MB</label>
                    </fieldset>
                    <button class="btn btn-success" type="submit">Criar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>