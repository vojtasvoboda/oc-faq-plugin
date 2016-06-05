<?php namespace VojtaSvoboda\Faq;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerNavigation()
    {
        return [
            'faq' => [
                'label' => 'FAQ',
                'url' => Backend::url('vojtasvoboda/faq/faqs'),
                'icon' => 'oc-icon-comments-o',
                'permissions' => ['vojtasvoboda.faq.*'],
                'order' => 550,
                'sideMenu' => [
                    'faqs' => [
                        'label' => 'FAQs',
                        'url' => Backend::url('vojtasvoboda/faq/faqs'),
                        'icon' => 'oc-icon-comments-o',
                        'permissions' => ['vojtasvoboda.faq.faqs'],
                        'order' => 100,
                    ],
                    'proposals' => [
                        'label' => 'Návrhy',
                        'url' => Backend::url('vojtasvoboda/faq/proposals'),
                        'icon' => 'icon-comment-o',
                        'permissions' => ['vojtasvoboda.faq.proposals'],
                        'order' => 200,
                    ],
                ],
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'VojtaSvoboda\Faq\Components\Faqs' => 'faqs',
        ];
    }
}
