<div wire:init="loadPosts">
    @if (count($products))
        <div class="glider-contain">
            <ul class="glider-{{$category->id}}">
                @foreach ($products as $product)
                    <li class="bg-white rounded-lg shadow {{ $loop->last ? '' : 'sm:mr-4' }}">
                        <article>
                                <figure>
                                    @if($product->images->count())
                                        <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}">
                                    @else
                                        <img class="h-48 w-full object-cover object-center" src="https://i0.wp.com/mundowin.com/wp-content/uploads/2019/06/Error-code.jpg?w=832&ssl=1">
                                    @endif
                                </figure>
                                <div class="py-4 px-6">
                                    <h2 class="text-lg font-semibold">
                                        <a href="{{route('products.show', $product)}}">{{ Str::limit($product->name, 20) }}</a>
                                    </h2>
                                    <p class="text-trueGray-600">${{$product->price}}</p>
                                </div>
                        </article> 
                    </li>
                @endforeach
            </ul>
                <button aria-label="Previous" class="glider-prev">«</button>
                <button aria-label="Next" class="glider-next">»</button>
                <div role="tablist" class="dots"></div>
        </div>
    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>		
    @endif
</div>
