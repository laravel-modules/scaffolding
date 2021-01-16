<?php

namespace App\View\Forms\Components;

use Laraeast\LaravelBootstrapForms\Components\BaseComponent;

class PriceComponent extends BaseComponent
{
    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'price';

    /**
     * The currency that will append to price.
     *
     * @var string
     */
    protected $currency;

    /**
     * Initialized the input arguments.
     *
     * @param mixed ...$arguments
     * @return $this
     */
    public function init(...$arguments)
    {
        $this->name = $name = $arguments[0] ?? null;

        $this->value($arguments[1] ?? null ?: old($name));

        $this->setDefaultLabel();

        $this->setDefaultNote();

        $this->setDefaultPlaceholder();

        return $this;
    }

    /**
     * Set the price currency.
     *
     * @param $currency
     * @return $this
     */
    public function currency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * The variables with registered in view component.
     *
     * @return array
     */
    protected function viewComposer()
    {
        return [
            'currency' => $this->currency,
        ];
    }
}
