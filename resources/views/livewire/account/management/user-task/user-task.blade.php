<div>
    <div>
        <main class="main-content">
            <div class="container-fluid py-4">

                {{-- CRUD --}}
                @include("livewire.account.management.user-task.$view")



                <div class="row">
                    <div class="row my-4">

                        {{-- Visual Table --}}
                        <div class="col-lg-8 col-md-6">
                            @livewire("account.management.user-task.layouts.visual-table")
                        </div>
                        <div class="col-lg-4 col-md-6">
                            @include("livewire.account.management.user-task.layouts.nose")
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


