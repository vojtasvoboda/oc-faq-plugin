<?php namespace VojtaSvoboda\Faq\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Vojtasvoboda\Faq\Models\Faq as Model;

/**
 * Faqs Back-end Controller
 */
class Faqs extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend\Behaviors\ReorderController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'vojtasvoboda.faq.faqs',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('VojtaSvoboda.Faq', 'faq', 'faqs');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $itemId) {

                if (!$slider = Model::find($itemId))
                    continue;

                $slider->delete();
            }

            Flash::success('Selected items successfully deleted.');
        }

        return $this->listRefresh();
    }
}
