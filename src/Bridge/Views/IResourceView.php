<?php

namespace DesignPatterns\Bridge\Views;

use DesignPatterns\Bridge\Adaptors\IResourceAdaptor;

interface IResourceView
{
    public function __construct(IResourceAdaptor $resource);
    public function render(): string;
}