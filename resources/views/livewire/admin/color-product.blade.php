<div>
    <div class="my-12 bg-white rounded-lg shadow-lg p-6">
        {{-- Color --}}
        <div class="mb-6">
            <x-jet-label value="Color"/> 
            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" name="color_id" wire:model.defer="color_id" value="{{$color->id}}">
                        <span class="ml-2 text-gray-700 capitalize">{{__($color->name)}}</span>
                    </label>
                @endforeach
            </div>
            <x-jet-input-error for="color_id"/>
        </div>
        {{-- Cantidad --}}
        <div>
            <x-jet-label value="Cantidad" />
            <x-jet-input class="w-full" type="number" wire:model.defer="quantity" placeholder="Ingrese la cantidad" />
            <x-jet-input-error for="quantity"/>
        </div>
        {{-- Boton --}}
        <div class="flex mt-4 justify-end items-center">
            <x-jet-action-message class="mr-3 bg-green-300 text-white py-2 px-2 rounded-lg" on="saved">
                El color se agregó correctamente
            </x-jet-action-message>
            <x-jet-button 
                wire:click="save" 
                wire:loading.attr="disabled" 
                wire:target="save">
                Agregar
            </x-jet-button>
        </div>
    </div>
    @if($product_colors->count())
        <div class="bg-white rounded-lg shadow-lg p-6">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">Color</th>
                        <th class="px-4 py-2 w-1/3">Cantidad</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_colors as $product_color)
                        <tr wire:key="product_color-{{$product_color->pivot->id}}">
                            <td class="capitalize px-4 py-2">{{__($colors->find($product_color->pivot->color_id)->name)}}</td>
                            <td class="px-4 py-2">{{$product_color->pivot->quantity}} unidades</td>
                            <td class="px-4 py-2 flex">
                                <x-jet-secondary-button 
                                    class="ml-auto mr-2" 
                                    wire:click="edit({{$product_color->pivot->id}})"
                                    wire:loding.attr="disabled"
                                    wire:target="edit({{$product_color->pivot->id}})"
                                >
                                    Editar
                                </x-jet-secondary-button>
                                <x-jet-danger-button wire:click="$emit('deletePivot', {{$product_color->pivot->id}})">
                                    Eliminar
                                </x-jet-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    @endif
    

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar color
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Color" />
                <select class="w-full form-control" wire:model="pivot_color_id">
                    <option value="">Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{$color->id}}">{{ucfirst(__($color->name))}}</option>
                    @endforeach
                </select> 
            </div>
            <div>
                <x-jet-label value="Cantidad" />
                <x-jet-input wire:model="pivot_quantity" class="w-full" type="number" placeholder="Ingrese la cantidad"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button 
                wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button
                wire:click="update"
                wire:loading.att="disabled"
                wire:target="update"
                >
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
