<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return [
            'url' => $url,
            'mime' => $mime,
            'mediable_id' => Post::factory(),
            'mediable_type' => function ($attributes) {
                return Post::find($attributes['mediable_id'])->getMorphClass();
            }
        ];
    }

    public function getUrl($type = 'post')
    {
        switch ($type) {
            case 'post':

                $urls = [
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
                    'https://images.unsplash.com/photo-1711760102255-a5551e189fd5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'https://images.unsplash.com/photo-1707343848723-bd87dea7b118?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
                ];

                return $this->faker->randomElement($urls);
                break;

            case 'reel':

                $urls = [
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4'
                ];

                return $this->faker->randomElement($urls);
                break;

            default:
                # code ...
                break;
        }
    }

    public function getMime($url)
    {
        # using current data onley
        if (str()->contains($url, 'gtv-videos-bucket')) {
            return 'video';
        } else if (str()->contains($url, 'images.unsplash.com')) {
            return 'image';
        }
    }

    // chainable methods
    public function reel() : Factory
    {
        $url = $this->getUrl('reel');
        $mime = $this->getMime($url);

        return $this->state(function ($attributes) use ($url, $mime) {
            return [
                'mime' => $mime,
                'url' => $url,
            ];
        });
    }

    // chainable methods
    public function post() : Factory
    {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return $this->state(function ($attributes) use ($url, $mime) {
            return [
                'mime' => $mime,
                'url' => $url,
            ];
        });
    }
}
