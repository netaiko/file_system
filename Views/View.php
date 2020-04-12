<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 11/04/2020
 * Time: 17:11
 */

namespace views;


class View
{
    private $parameters;

    /**
     * View constructor.
     */
    public function __construct($view, $parameters = [])
    {
        extract($parameters);
        ob_start();
        include $this->getView($view);
        $content = ob_get_clean();

        include "Layout/standard.php";
    }

    /**
     * Get the name of php file of a view
     * @param $view
     * @return string
     */
    private function getView($view)
    {
        return VIEWS['welcome'];
    }
}