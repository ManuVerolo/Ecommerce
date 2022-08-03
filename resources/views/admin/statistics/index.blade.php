<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            Estadísticas
        </h2>
    </x-slot>
    <div class="container py-12">
        <section class="grid md:grid-cols-4 gap-6 text-white">
            <a class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Cant. Ventas
                </p>
                <p class="uppercase text-center">{{$orders_count}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-credit-card"></i></p>
            </a>
            <a  class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Total Ventas
                </p>
                <p class="uppercase text-center">${{$orders_total}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-money-bill"></i></p>
            </a>
            <a  class="bg-pink-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Cant. Ventas mes
                </p>
                <p class="uppercase text-center">{{$orders_count_month}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-calendar-check"></i></p>
            </a>
            <a  class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Total Ventas Mes
                </p>
                <p class="uppercase text-center">${{$orders_total_month}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-calendar-check"></i></p>
            </a>
            <a  class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Cant. usuarios
                </p>
                <p class="uppercase text-center">{{$users_count}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-users"></i></p>
            </a>
            <a  class="bg-pink-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Cant. Usuarios Mes
                </p>
                <p class="uppercase text-center">{{$users_count_month}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-calendar-check"></i></p>
            </a>
            <a  class="bg-blue-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Ventas con envío
                </p>
                <p class="uppercase text-center">{{$orders_with_shipping}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-truck"></i></p>
            </a>
            <a  class="bg-orange-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    Ventas sin envío
                </p>
                <p class="uppercase text-center">{{$orders_without_shipping}}</p>
                <p class="text-center text-2xl mt-2"><i class="fas fa-truck"></i></p>
            </a>
        </section>
    </div>
</x-admin-layout>