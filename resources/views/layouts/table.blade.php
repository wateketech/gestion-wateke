<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                @yield('theader-content')
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            @yield('thead-content')
                        </thead>
                        <tbody>
                            @yield('tbody-content')
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer pt-4 pb-0">
                <div class="container">
                    <div class="d-flex justify-content-center mb-4">
                        @yield('tfooter-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

