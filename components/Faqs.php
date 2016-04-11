<?php namespace VojtaSvoboda\Faq\Components;

use Cms\Classes\ComponentBase;
use VojtaSvoboda\Faq\Models\Faq as Model;

class Faqs extends ComponentBase
{
    public $items;

    public function componentDetails()
    {
        return [
            'name' => 'Frequently asked questions',
            'description' => 'List all questions and answers',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->items = $this->page['items'] = $this->listItems();
    }

    protected function listItems()
    {
        return Model::isEnabled()->orderBy('sort_order', 'ASC')->get();
    }

}
