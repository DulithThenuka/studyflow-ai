<?php
class Home extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'StudyFlow AI',
            'description' => 'Plan smarter. Study better.'
        ];

        $this->view('home/index', $data);
    }

    public function about()
    {
        echo 'About Page';
    }

    public function features()
    {
        echo 'Features Page';
    }

    public function contact()
    {
        echo 'Contact Page';
    }
}