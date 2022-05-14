<div class="container py-12">
    <x-jet-form-section submit="save" class="mb-6">

        <x-slot name="title">
            Crear subcategoría
        </x-slot>
    
        <x-slot name="description">
            Formulario de subcategorías
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
                <div class="flex items-center">
                    <p>¿Necesita color?</p>
                    <div class="ml-auto">
                        <label>
                            <input type="radio" name="color" value="1" wire:model.defer="createForm.color">
                            Sí
                        </label>
                        <label>
                            <input type="radio" name="color" value="0" wire:model.defer="createForm.color">
                            No
                        </label>
                    </div>
                </div>
                <x-jet-input-error for="createForm.color" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="flex items-center">
                    <p>¿Necesita talle?</p>
                    <div class="ml-auto">
                        <label>
                            <input type="radio" name="size" value="1" wire:model.defer="createForm.size">
                            Sí
                        </label>
                        <label>
                            <input type="radio" name="size" value="0" wire:model.defer="createForm.size">
                            No
                        </label>
                    </div>
                </div>
                <x-jet-input-error for="createForm.size" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3 bg-green-300 text-white py-2 px-2 rounded-lg" on="saved">
                La subcategoía se agregó correctamente
            </x-jet-action-message>
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    
    <x-jet-action-section>
        <x-slot name="title">
            Lista de subcategorìas
        </x-slot>
        <x-slot name="description">
            Todas las subcategorìas
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
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td class="py-2">
                                
                                <span class="uppercase">{{$subcategory->name}}</span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a wire:click="edit('{{$subcategory->id}}')" class="pr-2 hover:text-blue-600 cursor-pointer">Editar</a>
                                    <a wire:click="$emit('deleteSubcategory', '{{$subcategory->id}}')" class="pl-2 hover:text-red-600 cursor-pointer">Eliminar</a>
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
            Editar Subcategoría
        </x-slot>
        <x-slot name="content">   
            <div class="space-y-3">
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
                    <div class="flex items-center">
                        <p>¿Necesita color?</p>
                        <div class="ml-auto">
                            <label>
                                <input type="radio" name="color" value="1" wire:model.defer="editForm.color">
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="color" value="0" wire:model.defer="editForm.color">
                                No
                            </label>
                        </div>
                    </div>
                    <x-jet-input-error for="editForm.color" />
                </div>
                <div class="">
                    <div class="flex items-center">
                        <p>¿Necesita talle?</p>
                        <div class="ml-auto">
                            <label>
                                <input type="radio" name="size" value="1" wire:model.defer="editForm.size">
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="size" value="0" wire:model.defer="editForm.size">
                                No
                            </label>
                        </div>
                    </div>
                    <x-jet-input-error for="editForm.size" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Editar
            </x-jet-danger-button>
        </x-slot>
      </x-jet-dialog-modal>
      @push('script')
        <script>
            Livewire.on('deleteSubcategory', subcategoryId => {
                Swal.fire({
                    title: 'Estás seguro de eliminar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.show-category', 'delete', subcategoryId)
                        Swal.fire(
                        'Eliminado!',
                        'Se ha eliminado correctamente.',
                        'success'
                        )
                    }
                })
            });
        </script>    
        @endpush
</div>
