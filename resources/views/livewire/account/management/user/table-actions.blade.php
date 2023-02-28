@if (auth()->user()->id == $id)

<small> No es posible editar/eliminar su usuario</small>


@else
    <div class="flex space-x-1 justify-around">


        <button class="p-2 text-blue-600 hover:bg-blue-600 hover:text-white rounded"
            wire:click="$emit('viewUpdate-user', {{ $id }})"><i class="fas fa-user-edit"></i> editar
        </button>

        <button class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded"
            wire:click="$emit('deleteComfirmed-user', {{ $id }})"><i class="fas fa-trash"></i> eliminar
        </button>


    </div>
@endif