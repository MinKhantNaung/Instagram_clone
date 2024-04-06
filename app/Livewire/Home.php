<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $posts;

    public $canLoadMore;
    public $perPageIncrements = 5;
    public $perPage = 10;

    #[On('closeModal')]
    public function removeUrl()
    {
        $this->js("history.replaceState({}, '', '/')");
    }

    #[On('post-created')]
    public function postCreated($id)
    {
        $post = Post::find($id);

        $this->posts = $this->posts->prepend($post);
    }

    public function loadMore()
    {
        if (!$this->canLoadMore) {
            return null;
        }
        // dd('here');  // testing for loadMore work or not

        // increment page
        $this->perPage += $this->perPageIncrements;

        // load posts
        $this->loadPosts();
    }

    // function to load posts
    public function loadPosts()
    {
        $this->posts = Post::with('comments.replies')
            ->orderBy('id', 'desc')
            ->take($this->perPage)
            ->get();

        $this->canLoadMore = ($this->posts->count() >= $this->perPage);
    }

    public function toggleFollow(User $user)
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFollow($user);
    }

    public function mount()
    {
        $this->loadPosts();
    }

    public function render()
    {
        $suggestedUsers = User::limit(5)
            ->where('id', '!=', auth()->id())
            ->get();

        return view('livewire.home', compact('suggestedUsers'));
    }
}
