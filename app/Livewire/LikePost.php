<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;
    //mount es exactamente como un constructor en php
    public function mount($post){
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }
    
    public function like(){
        if ($this->post->checkLike(auth()->user())){
            // otra forma tbm 
            // auth()->user()->likes()->where('post_id', $this->post->id)->delete();
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;

        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
