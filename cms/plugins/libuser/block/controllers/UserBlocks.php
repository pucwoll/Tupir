<?php namespace LibUser\Block\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

/**
 * User Blocks Back-end Controller
 */
class UserBlocks extends Controller
{
    protected $requiredPermissions = ['libuser.block.manage'];

    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('LibUser.Block', 'block', 'userblocks');
    }
}
