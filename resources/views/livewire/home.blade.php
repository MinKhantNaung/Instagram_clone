<div class="w-full">

    {{-- Header --}}
    <header></header>

    {{-- main --}}
    <main class="grid lg:grid-cols-12 gap-8 md:mt-10">

        <aside class="lg:col-span-8 border overflow-hidden h-[1000px]">

            {{-- Stories --}}
            <section>
                <ul class="flex overflow-x-auto scrollbar-hide items-center gap-2">
                    @for ($i = 0; $i < 15; $i++)
                        <li class="flex flex-col justify-center w-20 gap-1 p-2">
                            <x-avatar story src="https://source.unsplash.com/500x500?face-{{ $i }}" class="w-14 h-14" />
                            <p class="text-xs font-medium truncate">{{ fake()->name }}</p>
                        </li>
                    @endfor
                </ul>
            </section>

        </aside>

        {{-- suggestions --}}
        <aside class="lg:col-span-4 border hidden lg:block p-4">

            <div class="flex items-center gap-2">
                <x-avatar src="https://source.unsplash.com/500x500?face" class="w-12 h-12" />
                <h4 class="font-medium">{{ fake()->name }}</h4>
            </div>

            {{-- suggestions --}}
            <section class="mt-4">
                <h4 class="font-bold text-gray-700/95">Suggestions for you</h4>

                <ul class="my-2 space-y-3">
                    <li class="flex items-center gap-3">
                        <x-avatar src="https://source.unsplash.com/500x500?face" class="w-12 h-12" />

                        <div class="grid grid-cols-7 w-full gap-2">
                            <div class="col-span-5">
                                <h5 class="font-semibold truncate text-sm">{{ fake()->name }}</h5>
                                <p class="text-xs truncate">Followed by {{ fake()->name }}</p>
                            </div>
                            <div class="col-span-2 flex text-right justify-end">
                                <button class="font-bold text-blue-500 ml-auto text-sm">Follow</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>

            {{-- App Links --}}
            <section class="mt-5">
                <ol class="flex gap-2 flex-wrap">
                    <li class="text-xs text-gray-800/90 font-medium">
                        <a href="#" class="hover:underline">About</a>
                    </li>
                    <li class="text-xs text-gray-800/90 font-medium">
                        <a href="#" class="hover:underline">Help</a>
                    </li>
                </ol>
            </section>

        </aside>

    </main>

</div>
