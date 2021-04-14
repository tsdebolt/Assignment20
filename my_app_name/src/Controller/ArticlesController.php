<?php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function index() {
        $this->loadComponent('Paginator');

        $articles = $this->Paginator->paginate($this->Articles->find());

        $this->set('articles', $articles);
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();

        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            $article->user_id = 1;

            if ($this->Articles->save($article)) {
                $this->Flash->success("Your article has been saved ;-)");
                return $this->redirect(['action' => 'index']);

            }

            // Couldn't Save
            $this->Flash->error('Unable to save article :-(');
        }

        $this->set('article', $article);
    }
}