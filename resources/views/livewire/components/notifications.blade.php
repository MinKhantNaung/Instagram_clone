<div class="w-full p-3">

    <h3 class="font-bold text-4xl">Notifications</h3>

    <main class="my-7 w-full">

        <div class="space-y-5">

            @foreach ($notifications as $notification)
                @php
                    $user = App\Models\User::find($notification->data['user_id']);
                @endphp

                @switch($notification->type)
                    @case('App\Notifications\NewFollowerNotification')
                        {{-- NewFollower --}}
                        <div class="grid grid-cols-12 gap-2 w-full">

                            <a href="{{ route('profile.home', $user->username) }}" class="col-span-2">
                                <x-avatar wire:ignore src="https://source.unsplash.com/500x500?face-{{ rand(0, 10) }}"
                                    class="w-10 h-10" />
                            </a>

                            <div class="col-span-7 font-medium">
                                <a href="{{ route('profile.home', $user->username) }}"> <strong>{{ $user->username }}</strong>
                                </a>
                                started following you
                                <span class="text-gray-400">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                            </div>

                            <div class="col-span-3">

                                {{-- if auth->user is following notify user --}}
                                @if (auth()->user()->isFollowing($user))
                                    <button wire:click="toggleFollow({{ $user->id }})"
                                        class="font-bold text-sm bg-gray-100 text-black/90 px-3 py-1.5 rounded-lg">Following</button>
                                @else
                                    <button wire:click="toggleFollow({{ $user->id }})"
                                        class="font-bold text-sm bg-blue-500 text-white px-3 py-1.5 rounded-lg">Follow</button>
                                @endif

                            </div>

                        </div>
                    @break

                    @case('App\Notifications\PostLikedNotification')
                        {{-- PostLiked --}}

                        @php
                            $post = App\Models\Post::find($notification->data['post_id']);
                        @endphp

                        <div class="grid grid-cols-12 gap-2 w-full">
                            <a href="{{ route('profile.home', $user->username) }}" class="col-span-2">
                                <x-avatar wire:ignore src="https://source.unsplash.com/500x500?face-{{ rand(0, 10) }}"
                                    class="w-10 h-10" />
                            </a>

                            <div class="col-span-7 font-medium">
                                <a href="{{ route('profile.home', $user->username) }}"> <strong>{{ $user->username }}</strong> </a>

                                <a href="{{ route('post', $post->id) }}">
                                    Liked your post
                                    <span class="text-gray-400">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                                </a>

                            </div>

                            <a href="{{ route('post', $post->id) }}" class="col-span-3 ml-auto">
                                <img src="https://source.unsplash.com/500x500?nature-{{ rand(0, 10) }}" alt="image"
                                    class="w-10 h-11 object-cover">
                            </a>

                        </div>
                    @break

                    @case('App\Notifications\NewCommentNotification')
                        {{-- New Comment --}}
                        <div class="grid grid-cols-12 gap-2 w-full">
                            <a href="#" class="col-span-2">
                                <x-avatar wire:ignore src="https://source.unsplash.com/500x500?face-{{ rand(0, 10) }}"
                                    class="w-10 h-10" />
                            </a>

                            <div class="col-span-7 font-medium">
                                <a href="#"> <strong>{{ fake()->name }}</strong> </a>

                                <a href="#">
                                    commented:
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur iure ab, ut nulla et
                                    ducimus iste dolor quidem
                                    <span class="text-gray-400">2d</span>
                                </a>
                            </div>

                            <a class="col-span-3 ml-auto">
                                <img src="https://source.unsplash.com/500x500?nature-{{ rand(0, 10) }}" alt="image"
                                    class="w-10 h-11 object-cover">
                            </a>

                        </div>
                    @break

                    @default
                @endswitch
            @endforeach

        </div>

    </main>

</div>
