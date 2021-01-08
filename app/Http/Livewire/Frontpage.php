<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Frontpage extends Component
{

    public $urlslug;
    public $title;
    public $content;

    /**
     * the livewire mount func
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function mount($urlslug = null)
    {
        $this->retrieveContent($urlslug);
        // $this->urlslug = $test;
    }

    /**
     * retrieve the content of the page.
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function retrieveContent($urlslug)
    {
        // get homepage if slug is empty
        if (empty($urlslug)) {
            $data = Page::where('is_default_home', true)->first();
        } else {
            // get the page according to the slug
            $data = Page::where('slug', $urlslug)->first();

            // if we cant retrieve anything, will show the 404 page
            if (!$data) {
                $data = Page::where('is_default_not_found', true)->first();
            }
        }

        // $data = Page::where('slug', $urlslug)->first();
        $this->title = $data->title;
        $this->content = $data->content;
    }

    /**
     * get all the sidebar Links
     *
     * @return void
     */
    public function sidebarLinks()
    {
        return DB::table('navigation_menus')
            ->where('type', '=', 'SidebarNav')
            ->orderBy('sequence', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * get the topNav Links
     *
     * @return void
     */
    public function topNavLinks()
    {
        return DB::table('navigation_menus')
            ->where('type', '=', 'TopNav')
            ->orderBy('sequence', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * the livewire render func
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.frontpage', [
            'sidebarLinks' => $this->sidebarLinks(),
            'topNavLinks' => $this->topNavLinks(),
        ])->layout('layouts.frontpage');
    }
}
