<?php

namespace App\Http\Controllers;


class LandingPageController extends Controller
{
    private $allowed_slugs = [] ;

    public function __construct()
    {
        $this->allowed_slugs = [
            'home',
            'reengage',
        ];
    }

    public function showLandingPage(string $slug = 'home'): \Illuminate\Contracts\View\View
    {
        if( !in_array($slug, $this->allowed_slugs) ) {
            abort(404);
        }
        return $this->getViewForSlug($slug);

    }



    private function getViewForSlug(string $slug): \Illuminate\Contracts\View\View
    {
        return view('landing-pages.' . $slug);
    }
}
