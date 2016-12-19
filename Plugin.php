<?php namespace VojtaSvoboda\CodeLogin;

use System\Classes\PluginBase;

/**
 * CodeLogin Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.User'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'vojtasvoboda.codelogin::lang.plugin.name',
            'description' => 'vojtasvoboda.codelogin::lang.plugin.description',
            'author'      => 'Vojta Svoboda',
            'icon'        => 'icon-user',
            'homepage'    => 'https://github.com/vojtasvoboda/oc-codelogin-plugin',
        ];
    }

    public function registerComponents()
    {
        return [
            'VojtaSvoboda\CodeLogin\Components\CodeLogin' => 'codeLogin',
        ];
    }
}
