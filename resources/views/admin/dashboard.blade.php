<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center mt-[100px]">
        <div class="join join-vertical gap-4">
            <a class="btn p-8 text-lg join-item" href="users-table">Gerenciamento de usuários</a>
            <a class="btn p-8 text-lg join-item" href="admins-table">Gerenciamento de administradores</a>
            <a class="btn p-8 text-lg join-item" href="products-table">Gerenciamento de produtos</a>
        </div>
    </div>
</x-app-layout>
