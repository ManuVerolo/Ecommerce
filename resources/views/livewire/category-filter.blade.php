<div>
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-2 flex justify-between items-center mb-6">
            <h2 class="font-semibold text-gray-700 uppercase">{{$category->name}}</h2>
            <div class="grid grid-cols-2 border-gray-200 divide-x divide-x-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer"></i>
                <i class="fas fa-th-list p-3 cursor-pointer"></i> 
            </div>
        </div>
    </div>
    <div class="grid grid-cols-5 gap-6">
        <aside>
            <h2 class="font-semibold text-center underline">Subcategorías</h2>
            <ul class=" mb-4 divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 ">
                        <a class="cursor-pointer hover:text-blue-600 capitalize {{ $subcategoria == $subcategory->name ? 'text-blue-500 font-semibold' : '' }}" 
                           wire:click="$set('subcategoria', '{{$subcategory->name}}')"
                           >{{$subcategory->name}}</a>
                    </li>
                @endforeach
            </ul>
            <h2 class="font-semibold text-center mt-4 underline">Marcas</h2>
            <ul class=" mb-4 divide-y divide-gray-200">
                @foreach ($category->brands as $brand)
                    <li class="py-2">
                        <a class="cursor-pointer hover:text-blue-600 capitalize {{$marca == $brand->name ? 'text-blue-500 font-semibold' : ''}}" 
                           wire:click="$set('marca','{{$brand->name}}')"
                           >{{$brand->name}}</a>
                    </li>
                @endforeach
            </ul>
            <x-jet-button class="mt-3"
            wire:click="limpiar">
                Eliminar filtros
            </x-jet-button>
        </aside>
        <div class="col-span-4">
            <ul class="grid grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <li class="bg-white rounded-lg shadow">
                        <article>
                                <figure>
                                    <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}">
                                </figure>
                                <div class="py-4 px-6">
                                    <h2 class="text-lg font-semibold">
                                        <a href="">{{ Str::limit($product->name, 20) }}</a>
                                    </h2>
                                    <p class="text-trueGray-600">${{$product->price}}</p>
                                </div>
                        </article> 
                    </li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>