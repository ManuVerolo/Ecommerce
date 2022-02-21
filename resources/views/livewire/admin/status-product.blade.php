<div class="bg-white shadow-xl rounded-lg p-6 mt-4">
    <p class="text-center text-2xl font-semibold mb-2">Estado del producto</p>
    <div class="flex">
        <label class="mr-6">
            <input type="radio" name="status" value="1" wire:model.defer="status">
            Marcar producto como borrador
        </label>
        <label>
            <input type="radio" name="status" value="2" wire:model.defer="status">
            Marcar producto como publicado
        </label>
    </div>
    <div class="flex justify-end">
        <x-jet-action-message class="mr-3 bg-green-300 text-white py-2 px-2 rounded-lg" on="saved">
            El estado se actualizó correctamente
        </x-jet-action-message>
        <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
            Editar estado
        </x-jet-button>
    </div>
</div>
