<div class="mt-3 pt-2">
    @if ($hasRated)
        <p class="text-green-600">✅ Thanks for your rating!</p>
    @else
        <form wire:submit.prevent="submit" class="inline-flex items-center justify-center">
            <div class="flex items-center space-x-2 mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button" wire:click="$set('rating', {{ $i }})"
                        class="{{ $rating >= $i ? 'text-yellow-400' : 'text-gray-400' }} text-xl">
                        ★
                    </button>
                @endfor
            </div>

            <textarea wire:model="comment" placeholder="Leave a comment (optional)"
                class="w-full p-2 border rounded mb-2" rows="1"></textarea>

                

            <button type="submit"
                class="bg-blue-600 text-white px-1 py-2 w-full rounded hover:bg-blue-700">
                Submit Rating
            </button>
        </form>
    @endif
</div>

