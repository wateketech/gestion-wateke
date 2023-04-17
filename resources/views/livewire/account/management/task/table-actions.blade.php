<div class="flex space-x-1 justify-around">
    @if ($name =="Vistas Comerciales" || $id == 1)
        <button class="p-2 text-green-600 hover:bg-blue-600 hover:text-white rounded"
            wire:click="$emit('viewPrograming-visit-metric', {{ $id }})"><i class="fas fa-calendar"></i>
        </button>
    @endif

    <button class="p-2 text-blue-600 hover:bg-blue-600 hover:text-white rounded"
        wire:click="$emit('viewUpdate-metric', {{ $id }})"><i class="fas fa-edit"></i>
    </button>

    @if (!$permanent)
        <button class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded"
            wire:click="$emit('deleteComfirmed-metric', {{ $id }})"><i class="fas fa-trash"></i>
        </button>
    @endif


</div>
