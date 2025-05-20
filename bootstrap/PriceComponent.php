<?php

namespace bootstrap;

use Laraeast\LaravelBootstrapForms\Components\BaseComponent;

class PriceComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'price';

    /**
     * The currency that will append to price.
     */
    protected string $currency = '';

    /**
     * Initialized the input arguments.
     */
    public function init(...$arguments): self
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[1] ?? null ?: old($name));

        $this->setDefaultLabel();

        $this->setDefaultNote();

        $this->setDefaultPlaceholder();

        return $this;
    }

    /**
     * Set the price currency.
     */
    public function currency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * The registered variables in view component.
     */
    protected function viewComposer(): array
    {
        return [
            'currency' => $this->currency,
        ];
    }
}
