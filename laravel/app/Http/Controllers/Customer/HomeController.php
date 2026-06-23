<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\RestaurantData;
use App\Support\SiteContent;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('customer.home', [
            'bodyPage' => 'home',
            'popularItems' => RestaurantData::popularItems(7),
            'reviews' => RestaurantData::reviews(),
            'galleryPreview' => RestaurantData::galleryPreview(5),
            'heroImage' => SiteContent::image('Home hero image', 'hero'),
        ]);
    }
}
