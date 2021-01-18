<?php

namespace DesignPatterns\Bridge\Adaptors;

use DesignPatterns\Bridge\Resources\Book;

class BookAdaptor implements IResourceAdaptor
{
    protected Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function getTitle(): string
    {
        return $this->book->title;
    }

    public function getSnippet(): string
    {
        return $this->book->coverText;
    }
}
