<div class="card h-100">
    <div class="card-header p-3">
        <div class="w-100 text-center">
            <p>Entidades</p>
        </div>
    </div>
    <div class="card-body px-2 pt-0">



        <div class="p-0">
            <ul class="align-items-center mb-0">

                @foreach ($entity_types as $entity)
                    <li>
                        <div class="d-flex px-2 py-2">
                            <div class="icon icon-shape icon-sm shadow text-center border-radius-sm me-2"
                                style="background-color: {{ $entity->color }}">
                                {!! html_entity_decode($entity->icon) !!}
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $entity->visual_name_p }}</h6>
                                {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> --}}
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>


    </div>
</div>
