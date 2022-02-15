<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MovieCard extends Component
{
    public $movie;
    public $genreList;
    
    public function __construct($movie, $genreList)
    {
        $this->movie        = $movie;
        $this->genreList    = $genreList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.movie-card');
    }
}
