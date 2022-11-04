<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\CSVHelper;
use Barryvdh\DomPDF\Facade\Pdf;


class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function csv()
    {
        return CSVHelper::output(
            Article::all()->toArray(),
            ['id', 'title' , 'body', 'created_at', 'updated_at'],
            'article.csv',
            true
        );
    }

    public function pdf()
    {
        $pdf = Pdf::loadView('pdf.invoice', Article::all()->toArray())->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->save('my_stored_file.pdf')->stream('download.pdf');
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
