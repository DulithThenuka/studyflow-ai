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
        $data = [
            'title' => 'About StudyFlow AI'
        ];

        $this->view('home/about', $data);
    }

    public function features()
    {
        $data = [
            'title' => 'Features'
        ];

        $this->view('home/features', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact'
        ];

        $this->view('home/contact', $data);
    }
}