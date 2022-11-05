<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface 
{
    public function getAllArticle() 
    {
        return Article::all();
    }
}