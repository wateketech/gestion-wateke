<div>

    <main class="main-content">
        <div class="container-fluid py-4">

            {{-- CRUD --}}
            {{-- @include("livewire.account.management.task.$view") --}}
            @include("livewire.account.management.task.create")

            {{-- Tables --}}
            {{-- @include("livewire.account.management.task.table") --}}

        </div>
    </main>

    @stack('task-scripts')

</div>