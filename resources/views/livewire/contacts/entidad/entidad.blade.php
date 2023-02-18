<div>
    <main class="main-content">
        <div class="container-fluid py-4">
    
            {{-- CRUD --}}
            @include('livewire.contacts.entidad.create')
            {{-- @include('livewire.contacts.entidad.edit') --}}
            {{-- @include('livewire.contacts.entidad.show') --}}
            
            
            {{-- Tables --}}
            @include('livewire.contacts.entidad.table')
        </div>
    </main>
</div>
