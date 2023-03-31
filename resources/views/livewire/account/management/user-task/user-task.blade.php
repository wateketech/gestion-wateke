<div>
    <div>
        <main class="main-content">
            <div class="container-fluid py-4">

                {{-- CRUD --}}
                @include("livewire.account.management.user-task.$view")



                <div class="row">
                    <div class="row">

                        {{-- Ultimos inserciones --}}
                        <div class="col-lg-3 col-md-6 my-3">
                            @livewire("account.management.user-task.layouts.lasts", key(4))
                        </div>
                        {{-- Visual Table --}}
                        <div class="col-lg-9 col-md-6 my-3">
                            @livewire("account.management.user-task.layouts.visual-table", key(5))
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


