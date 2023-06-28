<?php
if (!defined('ABSPATH')) {
    exit;
}
// Get main admin option setting
file_exists($main = ASTROKIT_PLUGIN_DIR . "/admin/main.php") ? require_once $main : false;
// Admin panel sidebar add options 
add_action('admin_menu', function () {
    new AstrokitMenu(__('Astrokit', ASTROKIT), __('Astrokit', ASTROKIT), 'manage_options', 'astrokit', '_return', ASTROKIT_PLUGIN_URI . "/assets/icons/astrokit.svg", 2);
});
// Admin panel Menu Option
class AstrokitMenu
{
    protected  $page_title, $menu_title, $capability, $callback, $icon_url;
    public  $menu_slug;
    protected int $position;
    public function __construct($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $position = null)
    {
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->capability = $capability;
        $this->menu_slug = $menu_slug;
        $this->callback = $callback;
        $this->icon_url = $icon_url;
        $this->position = $position;
        return add_menu_page($this->page_title, $this->menu_title, $this->capability, $this->menu_slug, $this->callback, $this->icon_url, $this->position);
    }
}
