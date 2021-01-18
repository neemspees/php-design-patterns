<?php

namespace DesignPatterns\Bridge\Views;

use DesignPatterns\Bridge\Adaptors\IResourceAdaptor;

class FullView implements IResourceView
{
    protected IResourceAdaptor $resource;

    public function __construct(IResourceAdaptor $resource)
    {
        $this->resource = $resource;
    }

    public function render(): string
    {
        $title = $this->resource->getTitle();
        $snippet = $this->resource->getSnippet();
        return "<h1>$title</h1><p>$snippet</p>";
    }
}
