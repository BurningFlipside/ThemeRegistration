<?php
require_once('class.SecurePage.php');
class ThemePage extends SecurePage
{
    public $theme_root;

    function __construct($title)
    {
        parent::__construct($title, true);
        $root = $_SERVER['DOCUMENT_ROOT'];
        $script_dir = dirname(__FILE__);
        $this->theme_root = substr($script_dir, strlen($root));
        $this->secureUrl = $this->settings->getGlobalSetting('secure_url', 'https://secure.burningflipside.com');
        $this->secureMenu = $this->settings->getGlobalSetting('secure_menu', array(
            'Tickets'=>'https://secure.burningflipside.com/tickets/index.php',
            'View Registrations'=>'https://secure.burningflipside.com/register/view.php',
            // 'Theme Camp Registration'=>'https://secure.burningflipside.com/tc_reg.php',
            'Art Project Registration'=>'https://secure.burningflipside.com/register/art_reg.php',
            'Art Car Registration'=>'https://secure.burningflipside.com/register/artCar_reg.php',
            'Event Registration'=>'https://secure.burningflipside.com/register/event_reg.php'
        ));
        $this->add_links();
    }

    function add_links()
    {
        $dir = $this->theme_root;
        if(!FlipSession::isLoggedIn())
        {
            $this->addLink('Login', $this->loginUrl.'?return='.$this->currentURL());
        }
        else
        {
            if($this->user->isInGroupNamed('ThemeAdmins'))
            {
                $this->addLink('Admin', $dir.'/_admin/');
            }
            if($this->secureUrl !== false)
            {
                if(!empty($this->secureMenu))
                {
                    $this->addLink('About', $this->secureUrl, $this->secureMenu);
                }
                else
                {
                    $this->addLink('About', $this->secureUrl);
                }
            }
            $this->addLink('Logout', 'http://profiles.burningflipside.com/logout.php');
        }
    }
}
?>
