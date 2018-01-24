<?php

/**
 * Write your own functions and use it anywhere in your beautiful code.
*/

/**
 * Pretty variable output
*/
function dump($var)
{
    echo '<pre style="background-color: black; color: darkorange; padding: 5px;">';
    print_r($var);
    echo '</pre>';
}

/**
 * @return string
 *
 * Return formatting path with $optionArray parameters if it defined
*/
function path($routeName, $optionArray = [])
{
    try {
        $routes = include(ROOT . '/app/config/routes.php');

        if (array_key_exists($routeName, $routes))
            $path = $routes[$routeName]['path'];
        else
            throw new Exception(sprintf('Route %s not exist', $routeName));

        if (!empty($optionArray)){
            $replacement = '';
            foreach ($optionArray as $item) {
                $replacement .= '/' . $item;
            }

            $explode = explode('/([', $path);

            return $explode[0] . $replacement;
        }

        return $path;


    } catch (Exception $e){
        return print_r($e->getMessage());
    }
}