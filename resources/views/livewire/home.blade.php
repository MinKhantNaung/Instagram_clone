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

        </aside>

    </main>

</div>
