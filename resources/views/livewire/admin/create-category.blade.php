<div>
  <x-jet-form-section submit="save" class="mb-6">
    <x-slot name="title">
        Crear categoría
    </x-slot>

    <x-slot name="description">
        Formulario de categorías
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="Nombre" />
            <x-jet-input type="text" class="w-full mt-1 form-control" wire:model="createForm.name"/>
            <x-jet-input-error for="createForm.name" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="Slug" />
            <x-jet-input type="text" class="w-full mt-1 form-control bg-gray-100"   disabled wire:model="createForm.slug"/>
            <x-jet-input-error for="createForm.slug" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="Ícono" />
            <x-jet-input type="text" class="w-full mt-1 form-control"  wire:model.defer="createForm.icon"  />
            <x-jet-input-error for="createForm.icon" />
        </div>
        <div class="col-span-6 sm:col-span-6">
            <x-jet-label value="Marcas" />
            <div class="grid grid-cols-4">
                @foreach ($brands as $brand)
                    <x-jet-label>
                        <x-jet-checkbox 
                        wire:model.defer="createForm.brands" 
                        name="brands[]" 
                        value="{{$brand->id}}"/>
                        {{$brand->name}}
                    </x-jet-label>
                @endforeach
            </div>
            <x-jet-input-error for="createForm.brands" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="Imagen" />
            <x-jet-input type="file" accept="image/*" class="w-full mt-1 form-control" wire:model="createForm.image" id="{{$rand}}" />
            <x-jet-input-error for="createForm.image" />
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-jet-action-message class="mr-3 bg-green-300 text-white py-2 px-2 rounded-lg" on="saved">
            La categoría se agregó correctamente
        </x-jet-action-message>
        <x-jet-button>
            Agregar
        </x-jet-button>
    </x-slot>
  </x-jet-form-section>
  <x-jet-action-section>
    <x-slot name="title">
        Lista de categorías
    </x-slot>
    <x-slot name="description">
        Todas las categorías
    </x-slot>
    <x-slot name="content">
        <table class="text-gray-700">
            <thead class="border-b border-gray-700">
                <tr class="text-left">
                    <th class="py-2 w-full">Nombre </th>
                    <th class="py-2">Acción</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($categories as $category)
                    <tr>
                        <td class="py-2">
                            <span class="inline-block w-8 text-center mr-2">{!!$category->icon!!}</span>
                            <a href="{{route('admin.categories.show', $category)}}" class="uppercase underline hover:text-blue-600 cursor-pointer">{{$category->name}}</a>
                        </td>
                        <td class="py-2">
                            <div class="flex divide-x divide-gray-300 font-semibold">
                                <a wire:click="edit('{{$category->slug}}')" class="pr-2 hover:text-blue-600 cursor-pointer">Editar</a>
                                <a wire:click="$emit('deleteCategory', '{{$category->slug}}')" class="pl-2 hover:text-red-600 cursor-pointer">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
  </x-jet-action-section>
  <x-jet-dialog-modal wire:model="editForm.open">
    <x-slot name="title">
        Editar Categoría
    </x-slot>
    <x-slot name="content">   
        <div class="space-y-3">
            <div>
                @if ($editImage)
                    <img class="w-full h-64 object-cover object-center" src="{{$editImage->temporaryUrl()}}" alt="">
                @else    
                    <img class="w-full h-64 object-cover object-center" src="{{Storage::url($editForm['image'])}}" alt="">
                @endif
            </div>
            <div class="">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="w-full mt-1 form-control" wire:model="editForm.name"/>
                <x-jet-input-error for="editForm.name" />
            </div>
            <div class="">
                <x-jet-label value="Slug" />
                <x-jet-input type="text" class="w-full mt-1 form-control bg-gray-100"   disabled wire:model="editForm.slug"/>
                <x-jet-input-error for="editForm.slug" />
            </div>
            <div class="">
                <x-jet-label value="Ícono" />
                <x-jet-input type="text" class="w-full mt-1 form-control"  wire:model.defer="editForm.icon"  />
                <x-jet-input-error for="editForm.icon" />
            </div>
            <div class="">
                <x-jet-label value="Marcas" />
                <div class="grid grid-cols-4">
                    @foreach ($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox 
                            wire:model.defer="editForm.brands" 
                            name="brands[]" 
                            value="{{$brand->id}}"/>
                            {{$brand->name}}
                        </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="editForm.brands" />
            </div>
            <div class="">
                <x-jet-label value="Imagen" />
                <x-jet-input type="file" accept="image/*" class="w-full mt-1 form-control" wire:model="editImage" id="{{$rand}}" />
                <x-jet-input-error for="editImage" />
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="editImage, update">
            Editar
        </x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>
</div>
