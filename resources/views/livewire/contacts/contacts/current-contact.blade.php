<div class="card max-vh-100 min-vh-100
    {{ $blocking_page ? 'blocking-page' : ''}}
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

    {{-- @if($blocking_page)
        <p class="absolute w-100 text-center h1 text-danger top-50 blink-3">

            @if (!$contact->enable)
                eliminado recientemente
            @elseif ($contact->is_editing)
                en edicion por {{ $contact->edited_by_user->name }}
            @endif
        </p>
    @endif --}}
</div>
