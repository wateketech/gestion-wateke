<div class="card max-vh-100 min-vh-100
    {{ !isset($contact) && count($contacts) <= 1 ? 'd-flex align-items-center justify-content-center' : '' }}">




    {{-- SINGLE CONTACT VIEW --}}
    @if (isset($contact) && !$multiple_selection)

        @include('livewire.contacts.contacts.layouts.current-one-contact')

    {{-- MULTIPLE CONTACT VIEW --}}
    @elseif (count($contacts) > 1 && $multiple_selection)

        @include('livewire.contacts.contacts.layouts.current-many-contact')

    {{-- INITIAL CONTACT VIEW --}}
    @else
        <div class="">
            <img class="" src="../assets/img/logo-travel.png">
        </div>

    @endif


</div>
