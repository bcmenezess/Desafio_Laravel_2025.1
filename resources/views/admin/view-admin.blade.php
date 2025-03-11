<x-app-layout>
        <div class="card bg-white shadow-sm text-black m-4 flex">
            @if(isset($admin->photo) && Storage::disk('public')->exists($admin->photo))
                <figure class="flex self-start m-2 ml-16 mt-8">
                    <img class="w-48 h-48 border-2 border-solid border-gray-500 rounded-full" src="{{asset('storage/'.$admin->photo)}}">
                </figure>
            @endif
            <div class="card-body flex flex-wrap ml-10">
                <h2 class="card-title">Informações do administrador</h2>
                <div>
                    <p class="font-bold">Nome:</p>
                    <p>{{$admin->name}}</p>
                </div>
                <div>
                    <p class="font-bold">Email:</p>
                    <p>{{$admin->email}}</p>
                </div>
                <div>
                    <p class="font-bold">CPF:</p>
                    <p>{{$admin->cpf}}</p>
                </div>
                <div>
                    <p class="font-bold">Data de nascimento:</p>
                    <p>{{\Carbon\Carbon::parse($admin->date_birth)->format('d/m/Y')}}</p>
                </div>
                <div>
                    <p class="font-bold">Endereço:</p>
                    <p>{{$admin->address}}</p>
                </div>
                <div>
                    <p class="font-bold">Telefone:</p>
                    <p>{{$admin->telephone}}</p>
                </div>
            </div>
        </div>
</x-app-layout>