<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Blade;

/**
 * Defines a page for the dashboard.
 */
class Dashboard extends Page
{
    /**
     * Define the navigation icon.
     *
     * @var string|null
     */
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    /**
     * The view name.
     *
     * @var string
     */
    protected static string $view = 'filament.pages.dashboard';

    /**
     * Define the title of the page.
     *
     * @var string|null
     */
    protected static ?string $title = 'Inicio';

    public static function getNavigationLabel(): string
    {
        return 'Inicio';
    }
      
    /**
     * Returns the data for the view.
     *
     * @return array
     */
    public function getViewData(): array
    {
        // Define basic HTML content for cards
        $cards = [
            [
                'icon' => '<i class="fas fa-users"></i>',
                'title' => 'Users',
                'description' => 'List of users',
            ],
            [
                'icon' => '<i class="fas fa-cog"></i>',
                'title' => 'Settings',
                'description' => 'Configure dashboard settings',
            ],
        ];

        return $cards;
    }
}