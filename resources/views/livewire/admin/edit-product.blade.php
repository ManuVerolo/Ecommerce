<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Editar producto: {{$product->name}}</h1>
    <div class="bg-white shadow-xl rounded-lg p-6">
        <div class="grid grid-cols-2 gap-6 mb-6">
        {{-- Categoria --}}
            <div>
                <x-jet-label value="Categorías" />
                <select class="w-full form-control" wire:model="category_id">
                    <option value="" selected disabled>Seleccione una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="category_id"/>
            </div>
            {{-- SubCategoria --}}
            <div>
                <x-jet-label value="Subcategorías" />
                <select class="w-full form-control" wire:model="product.subcategory_id">
                    <option value="" selected disabled>Seleccione una subcategoria</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="product.subcategory_id"/>
            </div>
        </div>
        {{-- Nombre --}}
        <div class="mb-4">
            <x-jet-label value="Nombre" />
            <x-jet-input  class="w-full" type="text" placeholder="Ingrese el nombre del producto" wire:model="product.name" />
            <x-jet-input-error for="product.name"/>
        </div>
        {{-- Slug --}}
        <div class="mb-4">
            <x-jet-label value="Slug" />
            <x-jet-input  class="w-full bg-gray-200" type="text" placeholder="Ingrese el slug del producto" wire:model="slug" disabled />
            <x-jet-input-error for="product.slug"/>
        </div>
        
        {{-- Descripcion --}}
        <div class="mb-4" >
            <div wire:ignore>
                <x-jet-label value="Descripción" />
                <textarea 
                    wire:model="product.description"
                    x-data 
                    x-init="ClassicEditor
                    .create($refs.miEditor)
                    .then(function(editor) {
                        editor.model.document.on('change:data', () => {
                            @this.set('product.description', editor.getData())
                        })
                    })
                    .catch( error => {
                            console.error( error );
                    } );" class="w-full form-control" cols="30" rows="4" x-ref="miEditor">
                </textarea>
            </div>
            <x-jet-input-error for="product.description"/>
        </div>
        
        {{-- Marcas y precios--}}
        <div class="mb-4 grid grid-cols-2 gap-6">
            <div>
                <x-jet-label value="Marca" />
                <select class="form-control w-full" wire:model="product.brand_id">
                    <option value="" disabled selected>Seleccione una marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="product.brand_id"/>
            </div>
            <div>
                <x-jet-label value="Precio" />
                <x-jet-input wire:model="product.price" type="number" placeholder="Ingrese el precio del producto" class="w-full" step=".01"/> 
                <x-jet-input-error for="product.price"/>
            </div>
        </div>
        @if($this->subcategory)
            @if(!$this->subcategory->color && !$this->subcategory->size)
                <div>
                    <x-jet-label value="Cantidad" />
                    <x-jet-input wire:model="product.quantity" type="number" placeholder="Ingrese la cantidad del producto" class="w-full" /> 
                    <x-jet-input-error for="product.quantity"/>
                </div>
            @endif  
        @endif
        <div class="flex mt-4 justify-end items-center">
            <x-jet-action-message class="mr-3 bg-green-300 text-white py-2 px-2 rounded-lg" on="saved">
                El producto se actualizó correctamente
            </x-jet-action-message>
            <x-jet-button 
                wire:click="save" 
                wire:loading.attr="disabled" 
                wire:target="save">
                Editar producto
            </x-jet-button>
        </div>
    </div>

    <div class="mt-4" wire:ignore>
        <form action="{{route('admin.products.files', $product)}}"
            method="POST"
            class="dropzone"
            id="my-great-dropzone">
            @csrf
        </form>
    </div>
    @if($product->images->count())
        <section class="bg-white shadow-xl rounded-lg p-6  mt-4">
            <h1 class="text-center text-2xl font-semibold mb-2">Imagenes del producto</h1>
            <ul class="flex flex-wrap">
                @foreach ($product->images as $image)
                    <li class="relative" wire:key="image-{{$image->id}}">
                        <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="">
                        <x-jet-danger-button class="absolute right-2 top-2 w-2 h-5" 
                            wire:click="deleteImage({{$image->id}})"
                            wire:loading.attr="disabled"
                            wire:target="deleteImage({{$image->id}})"
                        >
                            x
                        </x-jet-danger-button>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    @if($this->subcategory)

        @if($this->subcategory->size)

            @livewire('admin.size-product', ['product' => $product], key('size-product' . $product->id))

        @elseif($this->subcategory->color)

            @livewire('admin.color-product', ['product' => $product], key('color-product' . $product->id))

        @endif
        
    @endif

    @push('script')
        <script>
            Dropzone.options.myGreatDropzone = { // camelized version of the `id`
                dictDefaultMessage: "Arrastre las imagenes aquí",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function(){
                    Livewire.emit('refreshProduct');
                }
            };

            Livewire.on('deleteSize', sizeId => {
                Swal.fire({
                    title: '¿Estás seguro de eliminar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                    Livewire.emitTo('admin.size-product','delete', sizeId);
                    Swal.fire(
                        'Eliminado!',
                        'Se ha eliminado correctamente.',
                        'success'
                    )
                    }
                })
            })

            Livewire.on('deletePivot', pivot => {
                Swal.fire({
                    title: '¿Estás seguro de eliminar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                    Livewire.emitTo('admin.color-product','delete', pivot);
                    Swal.fire(
                        'Eliminado!',
                        'Se ha eliminado correctamente.',
                        'success'
                    )
                    }
                })
            })

            Livewire.on('deleteColorSize', pivot => {
                Swal.fire({
                    title: '¿Estás seguro de eliminar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                    Livewire.emitTo('admin.color-size','delete', pivot);
                    Swal.fire(
                        'Eliminado!',
                        'Se ha eliminado correctamente.',
                        'success'
                    )
                    }
                })
            })
        </script>
    @endpush
</div>

