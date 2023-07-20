<div class="ms-md-auto pe-md-3 d-flex align-items-center">
    <div class="search-input">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" id="search-action"
                style='padding-left: 40px !important;'
                placeholder="Buscar acciones..."
                wire:model="search"
                >
        </div>
        <ul class="select-options {{ count($matches) == 0 ? 'd-none' : '' }}" id="select-options">
            @foreach ($matches as $name => $action)
                @if ($action[0] === 'redirect')
                    <li class="option">
                        <a href="{{ $action[1] }}" target="_blank">{{ $name }}</a>
                    </li>

                    @elseif ($action[0] === 'emitEvent')
                    {{-- <li class="option {{ class_exists($action[1]) ? '' : 'd-none' }}"> --}}
                    <li class="option">
                        {{-- INICIAR EL COMPONENTE --}}
                        <span class="d-none">
                            @if ($action[1] != null && class_exists($action[1]))
                                @livewire($action[1])
                            @endif
                        </span>
                        <a wire:click='emitEvent("{{ $action[1] }}", "{{ $action[2] }}")'>
                        {{-- style="{{ class_exists($action[1]) ? '' : 'text-decoration: line-through;' }}" --}}
                            {{ $name }}
                        </a>
                    </li>

                @else
                    {{-- <li class="option"><a href="{{ $action }}" target="_blank">{{ $name }}</a></li> --}}
                @endif
            @endforeach
        </ul>


    </div>
</div>
