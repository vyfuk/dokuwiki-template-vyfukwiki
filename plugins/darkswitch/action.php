<?php
use dokuwiki\Menu\Item\AbstractItem;
class action_plugin_darkswitch extends \dokuwiki\Extension\ActionPlugin
{

    /** @inheritDoc */
    public function register(Doku_Event_Handler $controller)
    {
        $controller->register_hook('MENU_ITEMS_ASSEMBLY', 'BEFORE', $this, 'darkmodebutton');
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'darkcss');
    }

    public function darkmodebutton(Doku_Event $event, $param)
    {
        if($event->data['view'] == 'user'){
            array_splice($event->data['items'], -1, 0,[new DarkButton()]);
        }
    }

    public function darkcss(Doku_Event $event, $param)
    {
        if(get_doku_pref("darkmode", $default)==1){
            $event->data["link"][] = array (
                "type" => "text/css",
                "rel" => "stylesheet", 
                "href" => "lib/tpl/darktpl/css/dark.css",
            );
        }
        else{
            $event->data["link"][] = array (
                "type" => "text/css",
                "rel" => "stylesheet", 
                "href" => "lib/tpl/darktpl/css/dark_not.css",
            );
        }
    }

}

class DarkButton extends dokuwiki\Menu\Item\AbstractItem
{
    protected $type = 'darkbutton';
    private  $btn_name;

    public function __construct() {
        dokuwiki\Menu\Item\AbstractItem::__construct();        
        $this->params['do']=""; 
           //$this->svg=null;
    }
    public function getLabel(){
        if(get_doku_pref("darkmode", $default)==1){
            return("světlý motiv");
        }
        else{
            set_doku_pref("darkmode", 0);
            return("tmavý motiv");
        }

    }
    public function getLink() {
        if(get_doku_pref("darkmode", $default)==1){
            return("javascript:DokuCookie.setValue('darkmode', 0);javascript:location.reload();");
        }
        else{
            set_doku_pref("darkmode", 0);
            return("javascript:DokuCookie.setValue('darkmode', 1);javascript:location.reload();");
        }
    }
}
