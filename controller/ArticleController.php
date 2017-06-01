<?php


class ArticleController extends FrontController {

    // http://localhost?controller=article&action=index
    public function indexAction(){
        // list all articles
        $html = '';
        $managerArticle = new managerArticle;
        $articles =	$managerArticle->readAll();
        foreach ($articles as $key => $value) {

            $html .= '<h2>' . $value->getTitle() . '</h2>';
            $html .= '<p>' . $value->getContent() . '</p>';
            $html .= '<p><em> Crée le : ' . $value->getDateArticle() . '</em></p>';

        }
        return $html;

    }

    // http://localhost?controller=article&action=show&id=3
    public function showAction(){
        // display one article
    }

}