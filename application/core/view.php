<?php

class View
{

    /**
     * The name of the directory where templates are located.
     *
     * @var string
     * @access public.
     */
    public $pathTpl = './application/views/';

    public $typeFile = '.tpl';

    /**
     * Executes and displays the template results.
     *
     * @param string $array the data.
     * @param string $content the template content.
     * @access public.
     */

    function ourInsideTpl($array, $content)
    {
        if (!isset($_COOKIE['char'])) { $array['char']['name'] = 'не выбран';} 
        $content = str_replace(array("{TITLE}", "{USERNAME}", "{PROJECT}", "{VERSION}", "{CHAR}"), array($array['title'], $array['username'], $array['system']['title_project'], $array['system']['version_cms'], $array['char']['name']), $content);
        foreach ($array['lang'] as $key => $value) {
            $content = str_replace(
                '{' . strtoupper($key) . '}',
                $value,
                $content
            );
        }
        echo $content;
    }

    /**
     * Executes and displays the template results.
     *
     * @param string $array the data.
     * @param string $content the template content.
     * @access public.
     */

    function ourExternalTpl($array, $content)
    {
        $content = str_replace(array("{TITLE}", "{PROJECT}", "{VERSION}"), array($array['title'], $array['system']['title_project'], $array['system']['version_cms']), $content);
        foreach ($array['lang'] as $key => $value) {
            $content = str_replace(
                '{' . strtoupper($key) . '}',
                $value,
                $content
            );
        }
        echo $content;
    }

    /**
     * Executes and displays the template results.
     *
     * @param string $hash the generate file style.
     * @access public.
     */
    function generate($content_view, $template_view, $data = null)
    {
        ob_start();
        include($this->pathTpl . $template_view . $this->typeFile);
        $content = ob_get_clean();
        $this->ourInsideTpl($data, $content);
    }

    /**
     * @param $content_view
     * @param $template_view
     * @param null $data
     */
    function generateExtrnalPage($content_view, $template_view, $data = null)
    {
        ob_start();
        include($this->pathTpl . $template_view . $this->typeFile);
        $content = ob_get_clean();
        $this->ourExternalTpl($data, $content);
    }

    /**
     * @param $content_view
     * @param $data
     */
    function generateContent($content_view, $data)
    {
        include($this->pathTpl . $content_view . $this->typeFile);
    }

    /**
     * @param $class
     * @return string
     */
    function getClass($class)
    {
        switch ($class) {
            case 1:
                return 'warrior';
                break;
            case 2:
                return 'paladin';
                break;
            case 3:
                return 'hunter';
                break;
            case 4:
                return 'rogue';
                break;
            case 5:
                return 'priest';
                break;
            case 6:
                return 'knight';
                break;
            case 7:
                return 'shaman';
                break;
            case 8:
                return 'mage';
                break;
            case 9:
                return 'warlock';
                break;
            case 11:
                return 'druid';
                break;
        }
    }
}
