<div class="card h-100">
    <div class="card-header p-3">
        <div class="w-100 text-center">
            <p>Grupos</p>
        </div>
    </div>
    <div class="card-body px-2 pt-0">



        <div class="align-items-center mb-0 p-0">

                @foreach ($contact_groups as $group)
                        <div class="d-flex px-2 py-2">
                            <div class="icon icon-shape icon-sm shadow text-center border-radius-sm me-2"
                                style="background-color: {{ $group->color }}">
                                {!! html_entity_decode($group->icon) !!}
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $group->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ count($group->contacts) }} Contactos</p>
                            </div>
                        </div>
                @endforeach
        </div>


    </div>
</div>
