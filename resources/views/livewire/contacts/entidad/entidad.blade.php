<div>
    <main class="main-content">
        <div class="container-fluid py-4">
    
            {{-- CRUD --}}
            @include("livewire.contacts.entidad.$view")
                      
            {{-- Tables --}}
            {{-- @include('livewire.contacts.entidad.table') --}}
        </div>
    </main>

    @stack('entidad-scripts')
</div>
