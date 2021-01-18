<?php

namespace DesignPatterns\Bridge\Adaptors;

use DesignPatterns\Bridge\Resources\Artist;

class ArtistAdaptor implements IResourceAdaptor
{
    protected Artist $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function getTitle(): string
    {
        return $this->artist->name;
    }

    public function getSnippet(): string
    {
        return $this->artist->bio;
    }
}
