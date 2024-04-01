<div class="grid lg:grid-cols-12 gap-3 h-full w-full overflow-hidden  ">

    <aside class="lg:col-span-7 m-auto items-center w-full overflow-scroll">

        {{-- CSS Snap scroll --}}
        <div
            class="relative flex overflow-x-scroll overscroll-x-contain w-[500px] h-96 snap-x snap-mandatory gap-2 px-2 ">

            @foreach ($post->media as $file)
                <div class="w-full h-full shrink-0 snap-always snap-center">
                    @switch($file->mime)
                        @case('video')
                            <x-video source="{{ $file->url }}" />
                        @break

                        @case('image')
                            <img class="h-full w-full block object-scale-down" src="{{ $file->url }}" alt="image">
                        @break

                        @default
                    @endswitch
                </div>
            @endforeach

        </div>

    </aside>


    <aside
        class="lg:col-span-5 h-full   scrollbar-hide  relative flex gap-4 flex-col overflow-hidden overflow-y-scroll  ">
    </aside>

</div>
