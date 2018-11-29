<?php
/**
 * Created by PhpStorm.
 * User: Станислав Мирошник
 * Date: 11/29/2018
 * Time: 12:08 PM
 */

namespace application\core\AbstractFactory;


class Home implements MyObject
{
    public function getTitle()
    {
        return 'This is home.'; //получаем фразу в виде заголовка при вызове метода
    }
}