<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvShowCard extends Component
{
    public $show;
    
    public function __construct($show){
        $this->show = $show;
    }

    public function render(){
        return view('components.tv-show-card');
    }
}
