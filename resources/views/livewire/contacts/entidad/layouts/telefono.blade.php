<div class="col-6">
    <div class="row">

        <div class="col-4 form-group">
            <label for="observ" class="form-control-label">Label *</label>
            <input list="categories-phone" class="form-control" type="text" placeholder="Movil"
                name="observ" id="observ" wire:model="observ">
            <datalist id="categories-phone">
                <option>Movil</option>
                <option>Casa</option>
                <option>Oficina</option>
            </datalist>
        </div>
        <div class="col-6 form-group">
            <label for="telefono" class="form-control-label">Telefono *</label>           
            <br>
            <input class="form-control telefono" type="tel"
                name="telefono33" id="telefono" wire:model="telefono">
        </div>
        <div class="col-2 p-0">
            <button type="button" class="btn btn-secondary my-4">+</button>
            {{-- <button type="button" class="btn btn-secondary my-4">-</button> --}}
        </div>       
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="./assets/js/plugins/intl-tel-input/css/intlTelInput.css">

@endpush()

@push('entidad-scripts')
    <script src="../assets/js/plugins/intl-tel-input/js/intlTelInput.js"></script>
    <script>
        var input = document.querySelectorAll(".telefono");

    for (let i=0 ; i<input.length ; i++){
         window.intlTelInput(input[i], {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "on",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        // separateDialCode: true,
        utilsScript: "../assets/js/plugins/intl-tel-input/js/utils.js",
        });
    }
    </script>
@endpush()    
