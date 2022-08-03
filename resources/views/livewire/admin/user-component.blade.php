<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            Listado de Usuarios
        </h2>
    </x-slot>
    <div class="container py-12">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div class="flex text-center justify-between px-6 py-4 w-f">
                <div class="">
                    <x-jet-input class="w-500" type="text" placeholder="Buscar usuario..." wire:model="search" />
                </div>
                <form action="{{ route('factoryMethod', 'dompdf') }}" method="POST">
                    @csrf
                    <x-jet-button>Descargar con DomPDF</x-jet-button>
                </form>
            </div>
            <x-table-responsive>
                @if($users->count())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rol</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Editar</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr wire:key="{{$user->email}}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{$user->id}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$user->name}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$user->email}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if (count($user->roles))
                                            Admin
                                        @else
                                            Sin rol
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <label>
                                            <input {{count($user->roles) ? 'checked' : ''}} value="1" type="radio" name="{{$user->email}}" wire:change="assingRole({{$user->id}}, $event.target.value)">
                                            Sí
                                        </label>
                                        <label class="ml-2">
                                            <input {{count($user->roles) ? '' : 'checked'}} value="0" type="radio" name="{{$user->email}}" wire:change="assingRole({{$user->id}}, $event.target.value)">
                                            No
                                        </label>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-4">
                        No hay resultados para su búsqueda
                    </div>
                @endif
                @if ($users->hasPages())                    
                    <div class="px-6 py-4">
                        {{$users->links()}}
                    </div>
                @endif
                
            </x-table-responsive>
        </div>
    </div>
</div>
