<?php namespace LibChat\Comments\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Comments Back-end Controller
 */
class Comments extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var string Configuration file for the `RelationController` behavior.
     */
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('LibChat.Comments', 'comments', 'comments');
    }
}
