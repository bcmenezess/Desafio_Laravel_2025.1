<x-app-layout>
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
                <h2 class="font-bold">Excluir Usuário</h2>
                <form action="{{route('delete-user',$user->id)}}" method="post" enctype="multipart/form-data" class="flex flex-col gap-2">
                    @method('delete')
                    @csrf
                    <h2>Tem certeza que deseja apagar os registros de {{$user->name}}?</h2>
                    <button class="btn btn-error mt-8" type="submit">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>