<?php
require_once('../class.SecurePage.php');
class ThemePage extends SecurePage
{
    public $theme_root;

    function __construct($title)
    {
        parent::__construct($title, true);
        $root = $_SERVER['DOCUMENT_ROOT'];
        $script_dir = dirname(__FILE__);
        $this->theme_root = substr($script_dir, strlen($root));
        $this->add_links();
    }

    function add_links()
    {
        parent::add_links();
        if($this->user && $this->user->isInGroupNamed('ThemeAdmins'))
        {
            $this->addLink('Admin', $this->theme_root.'/_admin/');
        }
    }
}
?>
