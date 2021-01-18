<?php

namespace DesignPatterns\Bridge\Adaptors;

interface IResourceAdaptor
{
    public function getTitle(): string;
    public function getSnippet(): string;
}