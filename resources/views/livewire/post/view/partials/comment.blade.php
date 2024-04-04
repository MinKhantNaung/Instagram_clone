<div class="flex items-start gap-3 py-2">
    <x-avatar src="https://source.unsplash.com/500x500?face-{{ rand(1, 10) }}" class="w-9 h-9 mb-auto" />

    <div class="grid grid-cols-7 w-full gap-2">

        {{-- comment --}}

        <div class="col-span-6 flex flex-wrap text-sm">
            <p>
                <span class="font-bold text-sm"> {{ $comment->user->name }}</span>
                {{ $comment->body }}
            </p>
        </div>

        {{-- like --}}
        <div class="col-span-1 flex text-right justify-end mb-auto">
            <button class="font-bold text-sm ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>

            </button>
        </div>

        {{-- footer --}}
        <div class="col-span-7 flex gap-2 text-xs text-gray-700">
            <span> {{ $comment->created_at->diffForHumans() }}</span>
            <span class="font-bold"> 345 Likes</span>
            <span class="font-semibold"> Reply</span>
        </div>

    </div>
</div>
