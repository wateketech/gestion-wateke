<div class="flex space-x-1 justify-around">


    <button class="p-2 text-blue-600 hover:bg-blue-600 hover:text-white rounded"
        wire:click="$emit('viewUpdate-metric', {{ $id }})"><i class="fas fa-edit"></i> editar
    </button>

    <button class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded"
        wire:click="$emit('deleteComfirmed-metric', {{ $id }})"><i class="fas fa-trash"></i> eliminar
    </button>


</div>
