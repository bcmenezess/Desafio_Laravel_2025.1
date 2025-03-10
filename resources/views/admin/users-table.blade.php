<x-app-layout>
    <div class="flex flex-col justify-center items-center">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tabela de usuários') }}
            </h2>
        </x-slot>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-gray-900 mt-10 mb-10">
            <table class="table">
              <!-- head -->
              <thead class="bg-gray-950">
                <tr class="text-white">
                  <th></th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>CPF</th>
                  <th>Telefone</th>
                  <th>Ações</th>
                  <th>
                    <a href="users-table/add" class="btn btn-success text-lg font-black">+</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                @foreach ($users as $user)
                    <tr>
                    <th>{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->cpf}}</td>
                    <td>{{$user->telephone}}</td>
                    <td class="flex gap-2">
                        <a href="users-table/view/{{$user->id}}" class="btn btn-soft bg-gray-200 text-black">Ver</a>
                        <a href="users-table/edit/{{$user->id}}" class="btn btn-warning">Editar</a>
                        <a href="users-table/delete/{{$user->id}}" class="btn btn-error">Deletar</a>
                    </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="p-4">
                {{$users->links()}}
            </div>
          </div>
    </div>
</x-app-layout>