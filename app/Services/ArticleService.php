<?php

namespace App\Services;

class ArticleService
{
    protected $articleInterface;

    public function __construct($articleInterface) 
    {
        $this->articleInterface = $articleInterface;
    }

    public function getAllArticles(){
        return $this->articleInterface->getAllArticle();
    }
}