<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var array
     */
    public $breadcrumbs = [];

    /**
     * Create a new component instance.
     *
     * @param null $title
     * @param array $breadcrumbs
     */
    public function __construct($title = null, $breadcrumbs = [])
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('dashboard::master');
    }
}
