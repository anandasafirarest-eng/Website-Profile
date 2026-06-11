<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioGallery;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function index()
    {
        $totalPortfolios = Portfolio::count();
        $totalGalleries = PortfolioGallery::count();
        $latestPortfolio = Portfolio::latest()->first();
        $recentPortfolios = Portfolio::withCount('galleries')->latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalPortfolios',
            'totalGalleries',
            'latestPortfolio',
            'recentPortfolios'
        ));
    }
}
