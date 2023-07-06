    <div class="card-body px-0 pt-0">
        <div class="row mx-1">
            <div class="col-md-3 mb-md-0 mb-3 card card-body border card-plain border-radius-lg mx-3 px-3 py-3 min-height-120">
                {{-- <div class=""> --}}
                    @foreach ($ids as $id)
                        <p class="p-0 m-0">{!! html_entity_decode($id_types->find($id['type_id'])->icon) !!} {{ $id['value'] }}</p>
                    @endforeach
                    <p class="pt-3 p-0 m-0">{{ count($publish_us) == 0 ? 'NO nos publica' : '' }}</p>

                    <strong class='pr-3'>Notas: </strong>
                    <small>{{ (isset($about) && strlen($about) != 0) ? '' : 'No dispone' }}</small>{{-- agregar tambien condicion para el about laboral --}}
                    @if (isset($about) && strlen($about) != 0)
                        <div type="button" class="d-inline mx-0 px-2 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-file-alt px-0"></i>
                        </div>
                        <div class="dropdown-menu about">
                            {{ $about}}
                        </div>
                    @endif
                    {{-- @if ()
                        <div type="button" class="d-inline mx-0 px-2 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-file-alt px-0"></i>
                        </div>
                        <div class="dropdown-menu about">

                        </div>
                    @endif --}}

                {{-- </div> --}}
            </div>
            <div class="col-md-7 card card-body border card-plain border-radius-lg mx-3 px-3 py-3 pt-0 min-height-120">
                {{-- <div class=""> --}}
                    @forelse ($address as $index_add => $add)
                        <strong class="mt-3">Dirección {{ $add['name'] }}:</strong>
                        <p class="card-text fs-6 {{ ($add['geolocation'] || strlen($add['geolocation'])!=0) ? 'cursor-pointer' : '' }}">
                            <i class="fas fa-map-marker-alt pl-3 pr-1 {{ ($add['geolocation'] || strlen($add['geolocation'])!=0 ) ? 'text-primary' : '' }}"></i>
                                    @php $localidad = null; @endphp
                                @foreach ($address_line[$index_add] as $index_l => $line)
                                    @if ($line['label'] != 'Localidad')
                                        {{ ($line['label']=='Número' ) || ($line['label']=='Calle' ) ? '' : $line['label'] }}
                                        {{ $line['value'] }}
                                    @else
                                        @php $localidad = $line['value']; @endphp
                                    @endif
                                @endforeach
                                    {{ $localidad ? ', ' . $localidad : '' }},
                                    {{ $countries->find($add['country_id'])->states->find($add['state_id'])->name }},
                                    {{ $countries->find($add['country_id'])->cities->find($add['city_id'])->name }},
                                    {{-- , {{ $countries->find($add['country_id'])->name }} --}}
                                    {{ $countries->find($add['country_id'])->name }} <span class="emoji">{{ $countries->find($add['country_id'])->emoji }}</span>
                            </p>
                    @empty
                        No dispone
                    @endforelse
                {{-- </div> --}}
            </div>
        </div>


    </div>

