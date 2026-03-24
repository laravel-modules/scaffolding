<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

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
     * @param  null  $title
     * @param  array  $breadcrumbs
     */
    public function __construct($title = null, $breadcrumbs = [])
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('dashboard::master');
    }
}
