<?php

namespace App\Presenters;

use Pingpong\Menus\Presenters\Presenter;
use Auth, Role, Permission;

class SmvPresenter extends Presenter
{
    public $role, $user;

    public function __construct()
    {
        if( Auth::check() )
        {
            $this->user = Auth::user();
        }
    }

    public function checkAuth($item)
    {
        //dd($this->role);
        return ( !isset($item->attributes['auth']) || @$item->attributes['auth'] === Auth::check() )? true:false;
    }

    public function checkPerm($item)
    {
        if( !isset($item->attributes['role']) || $this->user->is(@$item->attributes['role']) )
        {
            return ( !isset($item->attributes['perm']) || $this->user->can(@$item->attributes['perm']) )? true:false;
        }else{
            return false;
        }
    }

    /**
     * {@inheritdoc }.
     */
    public function getOpenTagWrapper()
    {
        return PHP_EOL.'<ul class="nav navbar-nav">'.PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getCloseTagWrapper()
    {
        return PHP_EOL.'</ul>'.PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        if( $this->checkAuth($item) && $this->checkPerm($item)  )
        {
            unset($item->attributes['auth'], $item->attributes['role'], $item->attributes['perm']);
            return '<li'.$this->getActiveState($item).'><a href="'.$item->getUrl().'" '.$item->getAttributes().'>'.$item->getIcon().' '.$item->title.'</a></li>'.PHP_EOL;
        }
        else
        {
            return '';
        }
            
    }

    /**
     * {@inheritdoc }.
     */
    public function getActiveState($item, $state = ' class="active"')
    {
        return $item->isActive() ? $state : null;
    }

    /**
     * Get active state on child items.
     *
     * @param $item
     * @param string $state
     *
     * @return null|string
     */
    public function getActiveStateOnChild($item, $state = 'active')
    {
        return $item->hasActiveOnChild() ? $state : null;
    }

    /**
     * {@inheritdoc }.
     */
    public function getDividerWrapper()
    {
        return '<li class="divider"></li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getHeaderWrapper($item)
    {
        return '<li class="dropdown-header">'.$item->title.'</li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithDropDownWrapper($item)
    {
        if( $this->checkAuth($item) && $this->checkPerm($item) )
        {
            unset($item->attributes['auth']);
            return '<li class="dropdown'.$this->getActiveStateOnChild($item, ' active').'">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        '.$item->getIcon().' '.$item->title.'
                        <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        '.$this->getChildMenuItems($item).'
                      </ul>
                    </li>'
            .PHP_EOL;
        }
        else
        {
            return '';
        }
       
    }

    /**
     * Get multilevel menu wrapper.
     *
     * @param \Pingpong\Menus\MenuItem $item
     *
     * @return string`
     */
    public function getMultiLevelDropdownWrapper($item)
    {
         if( $this->checkAuth($item) )
        {
            unset($item->attributes['auth']);
            return '<li class="dropdown'.$this->getActiveStateOnChild($item, ' active').'">
    		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    					'.$item->getIcon().' '.$item->title.'
    			      	<b class="caret pull-right caret-right"></b>
    			      </a>
    			      <ul class="dropdown-menu">
    			      	'.$this->getChildMenuItems($item).'
    			      </ul>
    		      	</li>'
            .PHP_EOL;
        }
        else
        {
            return '';
        }
    }
}
