<?php

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Event\EventInterface;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug){
            $sluggedTitle = Text::slug($entity->title);

            //Trim slug
            $entity->slug = substr($sluggedTitle, 0, 19);
        }
    }
}