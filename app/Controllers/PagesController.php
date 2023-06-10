<?php

namespace App\Controllers;

class PagesController
{
    /**
     * Show the home page.
     */
    public function home()
    {
        return view('index');
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        $company = 'Victor Yoalli';

        return view('about', ['company' => $company]);
    }

    public function whoops()
    {
        $name = "Whats up";
        return view('partials.whoops', ['name' => $name]);
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('contact');
    }
}
