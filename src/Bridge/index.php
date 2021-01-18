<?php

use DesignPatterns\Bridge\Adaptors\ArtistAdaptor;
use DesignPatterns\Bridge\Adaptors\BookAdaptor;
use DesignPatterns\Bridge\Adaptors\IResourceAdaptor;
use DesignPatterns\Bridge\Resources\Artist;
use DesignPatterns\Bridge\Resources\Book;
use DesignPatterns\Bridge\Views\DenseView;
use DesignPatterns\Bridge\Views\FullView;
use DesignPatterns\Bridge\Views\IResourceView;

require_once __DIR__ . '/../../vendor/autoload.php';

// We have 2 resources that don't share a common ancestor because they have nothing in common
$book = new Book();
$book->title = 'Head first design patterns';
$book->coverText = 'A book about design patterns.';

$artist = new Artist();
$artist->name = 'Urbanus';
$artist->bio = 'Geboren in Sint-Gertrudis-Pede (7 juni 1949) in het Pajottenland waar hij zijn jeugd doorbracht.';

// We want to display these resources in a uniform way on a web page in 2 different places:
// - A full view (title, snippet)
// - A dense view (title)

// So we create a resource adaptor interface that requires some way of exposing a title and a snippet.
// We create a concrete implementation for both of our resources.
$bookAdaptor = new BookAdaptor($book);
$artistAdaptor = new ArtistAdaptor($artist);

// Now that we have these adaptors, we can use them interchangeably in our views
$bookDenseView = new DenseView($bookAdaptor);
$bookFullView = new FullView($bookAdaptor);

$artistDenseView = new DenseView($artistAdaptor);
$artistFullView = new FullView($artistAdaptor);

// Now if we have some kind of renderer we can render those views uniformly
function render(IResourceView $view)
{
    echo $view->render();
}

render($bookDenseView);
render($bookFullView);

render($artistDenseView);
render($artistFullView);

// To add a new resource that can be displayed in both views we just have to add 1 new adaptor
class Reward
{
    public string $name;
    public array $years;
}

class RewardAdaptor implements IResourceAdaptor
{
    protected Reward $reward;

    public function __construct(Reward $reward)
    {
        $this->reward = $reward;
    }

    public function getTitle(): string
    {
        return $this->reward->name;
    }

    public function getSnippet(): string
    {
        return 'This reward has been awarded in the following years: ' . join(', ', $this->reward->years);
    }
}

$reward = new Reward();
$reward->name = 'The very cool award award';
$reward->years = range(2015, date('Y'));

$rewardAdaptor = new RewardAdaptor($reward);
$rewardFullView = new FullView($rewardAdaptor);
$rewardDenseView = new DenseView($rewardAdaptor);

render($rewardFullView);
render($rewardDenseView);

// Likewise it's super simple to add a new view type
class ReverseDenseView implements IResourceView
{
    /**
     * @var IResourceAdaptor
     */
    private IResourceAdaptor $resource;

    public function __construct(IResourceAdaptor $resource)
    {
        $this->resource = $resource;
    }

    public function render(): string
    {
        $title = strrev($this->resource->getTitle());
        return "<h1>$title</h1>";
    }
}

$bookReverseDenseView = new ReverseDenseView($bookAdaptor);
render($bookReverseDenseView);

// Instead of heaving to create a view + adaptor for every new Resource that we want to display,
// we can create them independently from each other
