<main class="main-content">
    <div class="container-fluid py-4">

        {{-- CRUD --}}
        @include('livewire.contacts.create')
        {{-- @include('livewire.contacts.edit') --}}
        {{-- @include('livewire.contacts.show') --}}
        
        
        {{-- Tables --}}
        @include('livewire.contacts.table')
    </div>
</main>
