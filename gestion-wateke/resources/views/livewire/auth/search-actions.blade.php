<div class="ms-md-auto pe-md-3 d-flex align-items-center">
    <div class="search-input">
        <div class="input-group">
            <span class="input-group-text z-index-1" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" id="search-action"
                style='padding-left: 40px !important;'
                placeholder="Buscar acciones..."
                wire:model="search"
                >
        </div>
        <ul class="select-options {{ count($matches) == 0 ? 'd-none' : '' }}" id="select-options">
            @foreach ($matches as $name => $property)
                @php
                    $icon = $property[0];
                    $action = $property[1];
                @endphp

                @if ($action === 'redirect')
                    @php
                        $route = $property[2];

                    @endphp
                    <li class="option">
                        <a href="{{ $route }}" target="_blank">{!! $icon !!} &nbsp; {{ ucwords($name) }}</a>
                    </li>

                @elseif ($action === 'emitEvent')
                    @php
                        $component = $property[2];
                        $event = $property[3];
                        $componentExist = class_exists($this->resolveClassName($component))
                    @endphp
                    <li class="option {{ $componentExist ? '' : 'd-none' }}">
                    {{-- <li class="option"> --}}
                        {{-- INICIAR EL COMPONENTE --}}
                        <span class="d-none">
                            @if ($component != null && $componentExist)
                                @livewire($component)
                            @endif
                        </span>
                        <a wire:click='emitEvent("{{ $component }}", "{{ $event }}")'
                            style="{{ $componentExist ? '' : 'text-decoration: line-through;' }}">
                                {!! $icon !!} &nbsp; {{ ucwords($name) }}
                        </a>
                    </li>

                @else
                    {{-- <li class="option"><a href="{{ $property }}" target="_blank">{{ $name }}</a></li> --}}
                @endif
            @endforeach
        </ul>


    </div>
</div>
