<?php

namespace DesignPatterns\Bridge\Views;

use DesignPatterns\Bridge\Adaptors\IResourceAdaptor;

class DenseView implements IResourceView
{
    protected IResourceAdaptor $resource;

    public function __construct(IResourceAdaptor $resource)
    {
        $this->resource = $resource;
    }

    public function render(): string
    {
        $title = $this->resource->getTitle();
        return "<h1>$title</h1>";
    }
}
