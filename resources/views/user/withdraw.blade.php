<x-app-layout>
    <div class="flex justify-center mt-20">
        <div class="card bg-neutral text-neutral-content w-96 bg-gray-900">
            <div class="card-body">
                <h2 class="font-bold text-xl text-center">Saque</h2>
                <form action="{{route('withdraw')}}" method="post" class="flex flex-col gap-2">
                    @method('put')
                    @csrf
                    <div class="flex flex-col self-start">
                        <h2>Saldo atual</h2>
                        <p class="text-lg font-bold text-green-400">R${{number_format($user->balance,'2',',','.')}}</p>
                    </div>
                    <div>
                        <label for="withdraw">Valor a ser sacado:</label>
                        <input name="withdraw" type="text" pattern="^\d+(\.\d{1,2})?$" class="input" required>
                        <span class="flex m-2 text-gray-400">OBS: Escreva o valor a ser sacado e separe apenas os decimais com ponto. Não use vírgulas.</span>
                    </div>
                    <div class="flex flex-row justify-center gap-4">
                        <button class="btn bg-gray-200 text-black mt-8" type="submit">Sacar</button>
                    </div>
                </form>
                @if($msg = session('message'))
                    <p class="text-blue-300 text-center">{{$msg}}</p>
                @else
                    <p class="text-red-200 text-center">{{session('error')}}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>