<div class="col-6">
   <div class="row">
       <div class="col-4 form-group">
           <label for="observ" class="form-control-label">Label *</label>
           <input class="form-control" type="text" placeholder="ventas"
               name="observ" id="observ" wire:model="observ">
       </div>
       <div class="col-6 form-group">
           <label for="web" class="form-control-label">Web *</label>
           <input class="form-control" type="email" placeholder='https://wateke.travel'
               name="web" id="web" wire:model="web">
       </div>
       <div class="col-2 p-0">
           <button type="button" class="btn btn-secondary my-4">+</button>
           {{-- <button type="button" class="btn btn-secondary my-4">-</button> --}}
       </div>       
   </div>
</div>
