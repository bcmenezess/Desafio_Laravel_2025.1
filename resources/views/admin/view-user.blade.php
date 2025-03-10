<x-app-layout>
        <div class="card bg-white shadow-sm text-black m-4 flex">
            @if(isset($user->photo) && Storage::disk('public')->exists($user->photo))
                <figure class="flex self-start m-2 ml-16 mt-8">
                    <img class="w-48 h-48 border-2 border-solid border-gray-500 rounded-full" src="{{asset('storage/'.$user->photo)}}" alt="Foto de perfil" class>
                </figure>
            @endif
            <div class="card-body flex flex-wrap ml-10">
                <h2 class="card-title">Informações do usuário</h2>
                <div>
                    <p class="font-bold">Nome:</p>
                    <p>{{$user->name}}</p>
                </div>
                <div>
                    <p class="font-bold">Email:</p>
                    <p>{{$user->email}}</p>
                </div>
                <div>
                    <p class="font-bold">CPF:</p>
                    <p>{{$user->cpf}}</p>
                </div>
                <div>
                    <p class="font-bold">Data de nascimento:</p>
                    <p>{{\Carbon\Carbon::parse($user->date_birth)->format('d/m/Y')}}</p>
                </div>
                <div>
                    <p class="font-bold">Saldo:</p>
                    <p class="text-md font-bold text-green-600">R${{$user->balance}}</p>
                </div>
                <div>
                    <p class="font-bold">Endereço:</p>
                    <p>{{$user->address}}</p>
                </div>
                <div>
                    <p class="font-bold">Telefone:</p>
                    <p>{{$user->telephone}}</p>
                </div>
            </div>
        </div>
</x-app-layout>