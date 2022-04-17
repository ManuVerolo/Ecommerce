<x-admin-layout>
    <div class="container py-12">
        @livewire('admin.create-category')
    </div>
    @push('script')
    <script>
        Livewire.on('deleteCategory', categorySlug => {
            Swal.fire({
                title: 'Estás seguro de eliminar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.create-category', 'delete', categorySlug)
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
</x-admin-layout>