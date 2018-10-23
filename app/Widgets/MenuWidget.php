<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Module;
use Auth;
class MenuWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    public $menuList = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $menuAr = [];
        foreach( Module::allEnabled() as $key=>$module){

            $menuConf = config($module->getLowerName());
            if(isset($menuConf['menu'])){
                $newArr[] = $menuConf['menu'];
            }
        }

        usort($newArr, function($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        foreach ($newArr as $ke=>$va){
            if(isset($va['permissions']) && !empty($va['permissions'])){

                if(Auth::user()->can($va['permissions']))
                {
                    foreach($va['links'] as $menulink){
                        $menuAr[] = $menulink;
                    }
                }

            }else{
                foreach($va['links'] as $menulink){
                    $menuAr[] = $menulink;
                }
            }
        }

      //  dd($newArr);
        $this->menuList = $menuAr;
        //print_r($nodes);
        return view('widgets.menu_widget', [
            'config' => $this->config,
            'menuList' => $this->menuList
        ]);
    }

    public function makeArray($items, $level){

    }
}
