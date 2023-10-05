<?php

namespace App\Controllers;

class MainController
{
    protected string $view;
    protected $data;
    protected string $viewType = 'front';
    
    public function render(): void
    {
        $base_uri = explode('/public/', $_SERVER['REQUEST_URI']);
        $data=$this->data;
        require(__DIR__ . '/../views/' . $this->viewType . '/layouts/header.phtml'); 
        require(__DIR__ . '/../views/' . $this->viewType . '/partials/' . $this->view . '.phtml'); 
        require(__DIR__ . '/../views/' . $this->viewType . '/layouts/footer.phtml'); 
    }
    
    public function getView(): string
    {
        return $this->view;
    }

    public function setView($view): void
    {
        $this->view = $view;
    }
    
    public function getData(): string
    {
        return $this->data;
    }
    
    public function setData($newData): void
    {
        $this->data=$newData;
    }
}