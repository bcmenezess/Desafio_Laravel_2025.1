<x-app-layout>
    <div class="flex w-[90%] flex-col gap-4 justify-self-center items-center mt-10">
        <div class="w-[100%] card bg-neutral  bg-gray-900">
            <div class="w-[100%] card-body gap-8 items-center text-center">
                <h2 class="text-[1rem] fieldset-legend">Enviar email para {{$user->name}}</h2>
                <form action="{{route('contact',$user->id)}}" method="post" class="flex w-[60%] flex-col gap-2">
                    @csrf
                    <input type="text" name="name" placeholder="Nome do destinatário" class="w-[100%] input" value="{{$user->name}}" disabled required/>
                    <input type="email" name="email" placeholder="Email do destinatário" class="w-[100%] input" value="{{$user->email}}" disabled required/>
                    <input type="text" name="subject" placeholder="Assunto" class="w-[100%] input" required/>
                    <textarea class="w-[100%] h-40 textarea" name="message" placeholder="Mensagem" required></textarea>
                    <div class="flex flex-row gap-4 self-center">
                        <a class="flex btn bg-gray-300 text-black mt-4 mb-4 w-24" href="{{route('users-table')}}">Voltar</a>
                        <button class="flex btn btn-info text-white mt-4 mb-4 w-24" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>