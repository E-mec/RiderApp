<div>

    <div class="text-center mb-10">
        <h1 class="text-xl">
            Book A Delivery
        </h1>
    </div>


    <form wire:submit="save" class="flex flex-col gap-6">
        


        <!-- Phone Number -->
        <flux:input
            wire:model="pickup_location"
            :label="__('Pickup Location')"
            type="text"
            required
            autocomplete="pickup_location"
            placeholder="Pickup Location"
        />

        {{-- Address --}}
        <flux:input
            wire:model="delivery_location"
            :label="__('Delivery Location')"
            type="text"
            required
            autocomplete="delivery_location"
            :placeholder="__('Delivery Location')"
        />

    

        

        

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Book A Delivery') }}
            </flux:button>
        </div>
    </form>


</div>
    

