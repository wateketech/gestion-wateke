<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            
            <div class="card-header pb-0">
                @yield('header-table')
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-flush" id="datatable-basic">

                        <thead class="thead-light">
                            @yield('thead')
                        </thead>

                        <tbody>
                            @yield('tbody')
                        </tbody>

                    </table>
                </div>
            </div>
            
            <div class="card-footer pt-4 pb-0">
                <div class="container">
                    <div class="d-flex justify-content-center mb-4">
                        @yield('footer-table')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="../../assets/js/plugins/datatables.js"></script>
    
    <script type="text/javascript">
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
          searchable: true,
          fixedHeight: true
        });
    </script>
@endpush