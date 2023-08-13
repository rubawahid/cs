<?php

namespace App\View\Components;

use App\Models\category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Trendingcategories extends Component
{
    public $categories;

    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title = 'Trending category', $count = 8)
    {
        $this->title = $title;
       $this->categories = category::withoutGlobalScope('owner')
       ->with('category') // Eager load
        ->active()
        ->latest('updated_at')
        ->take($count); // =limit(8)
        //->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trending-categories');
    }
}
