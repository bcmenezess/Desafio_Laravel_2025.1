<x-app-layout>
    <div class="flex flex-col justify-center items-center">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tabela de administradores') }}
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
                    <a href="admins-table/add" class="btn btn-success text-lg font-black">+</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                @foreach ($admins as $admin)
                    <tr>
                    <th>{{$admin->id}}</th>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->cpf}}</td>
                    <td>{{$admin->telephone}}</td>
                    @if($admin->admin_id == usuarioLogado()->id || $admin == usuarioLogado())
                    <td class="flex gap-2">
                        <a href="admins-table/view/{{$admin->id}}" class="btn btn-soft bg-gray-200 text-black">Ver</a>
                        <a href="admins-table/edit/{{$admin->id}}" class="btn btn-warning">Editar</a>
                        <a href="admins-table/delete/{{$admin->id}}" class="btn btn-error">Deletar</a>
                    </td>
                    @else
                      <td class="flex gap-2">
                        <button disabled class="btn btn-soft bg-gray-200">Ver</button>
                        <button disabled class="btn btn-warning">Editar</button>
                        <button disabled class="btn btn-error">Deletar</button>
                      </td>
                    @endif
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="p-4">
                {{$admins->links()}}
            </div>
          </div>
    </div>
</x-app-layout>