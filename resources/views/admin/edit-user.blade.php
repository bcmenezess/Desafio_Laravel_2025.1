<x-app-layout>

    <div class="flex justify-center flex-row no-wrap">
        <div class="flex flex-col justify-center items-center mt-10">
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
                    <h2>Editar Usuário</h2>
                    <form action="{{route('edit-user',$user->id)}}" method="post" enctype="multipart/form-data" class="flex flex-col gap-2">
                        @method('PUT')
                        @csrf
                        <input value="{{$user->name}}" type="text" name="name" placeholder="Nome" class="input" required/>
                        <input value="{{$user->email}}" type="email" name="email" placeholder="Email" class="input" required/>
                        <input value="{{$user->cpf}}" type="text" name="cpf" placeholder="CPF" class="input" required/>
                        <input value="{{$user->address}}" type="text" name="address" placeholder="Endereço" class="input" required/>
                        <input value="{{$user->date_birth}}" type="date" name="date_birth" class="input" required/>
                        <input value="{{$user->telephone}}" type="text" name="telephone" placeholder="Telefone" class="input" required/>
                        <input type="password" name="password" placeholder="Nova senha (Opcional)" class="input"/>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Foto de perfil</legend>
                            <input type="file" class="file-input" name='photo'/>
                            <label class="fieldset-label">Max size 2MB</label>
                        </fieldset>

                        @if(Storage::disk('public')->exists($user->photo))
                            <figure class="flex justify-center items-center flex-col">
                                <span class="fieldset-legend">Foto de perfil atual</span>
                                <img class="w-60 h-auto border-4 border-double border-white" src="{{asset('storage/'.$user->photo)}}" alt="Foto de perfil" class>
                            </figure>
                        @else
                            <span class="fieldset-legend">Usuário sem foto de perfil ou imagem não encontrada</span>
                        @endif
                        <button class="btn btn-warning mt-8" type="submit">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>