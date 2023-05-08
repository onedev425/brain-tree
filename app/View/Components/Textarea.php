<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public string $id;

    public string $name;

    public ?string $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $label = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea');
    }
}
