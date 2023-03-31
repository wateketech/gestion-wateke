<div>
    <div>
        <main class="main-content">
            <div class="container-fluid py-4">

                {{-- CRUD --}}
                @include("livewire.account.management.user-task.$view")



                <div class="row">
                    <div class="row">

                        {{-- Visual Table --}}
                        <div class="col-lg-3 col-md-6 my-3">
                            @livewire("account.management.user-task.layouts.lasts")
                        </div>
                        {{-- Ultimos inserciones --}}
                        <div class="col-lg-9 col-md-6 my-3">
                            @include("livewire.account.management.user-task.layouts.visual-table")
                        </div>



                    </div>
                </div>

                        @livewire("account.management.user-task.layouts.data-table")


                        {{-- Tables --}} {{-- if user is root --}}
                        @if (auth()->user()->hasRole('SuperAdmin'))
                            @include("livewire.account.management.user-task.table")
                        @endif

            </div>
        </main>

        @stack('usuario-metrica-scripts')
    </div>
</div>


