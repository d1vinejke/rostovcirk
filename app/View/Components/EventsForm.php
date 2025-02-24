<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventsForm extends Component
{
    public $event;
    /**
     * Create a new component instance.
     */
    public function __construct($event = null)
    {
        $this->event = $event;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events-form');
    }
}
