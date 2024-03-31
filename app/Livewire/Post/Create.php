<?php

namespace App\Livewire\Post;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use WithFileUploads;

    public $media = [];
    public $description;
    public $location;
    public $hide_like_view = false;
    public $allow_commenting = false;

    // can copy from wire:elements github
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function submit()
    {
        // validate
        $this->validate([
            'media.*' => 'required|file|mimes:png,jpg,jpg,jpeg,mov,mp4|max:100000',
            'hide_like_view' => 'boolean',
            'allow_commenting' => 'boolean'
        ]);

        // determine if reel or post
        $type = $this->getPostType($this->media);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'description' => $this->description,
            'location' => $this->location,
            'hide_like_view' => $this->hide_like_view,
            'allow_commenting' => $this->allow_commenting,
            'type' => $type
        ]);

        // add media
        foreach ($this->media as $media) {
            // get mime type
            $mime = $this->getMime($media);

            // save to storage
            $path = $media->store('media', 'public');

            $url = url(Storage::url($path));

            // create media
            Media::create([
                'mediable_id' => $post->id,
                'mediable_type' => Post::class,
                'url' => $url,
                'mime' => $mime
            ]);
        }

        $this->reset();
        $this->dispatch('close');

        // dispath event for post created
        $this->dispatch('post-created', $post->id);
    }

    public function getPostType($media) :string
    {
        if (count($media) === 1 && str()->contains($media[0]->getMimeType(), 'video')) {
            return 'reel';
        } else {
            return 'post';
        }
    }

    public function getMime($media) :string
    {
        if (str()->contains($media->getMimeType(), 'video')) {
            return 'video';
        } else {
            return 'image';
        }
    }

    public function render()
    {
        return view('livewire.post.create');
    }
}
