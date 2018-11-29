<?php
/**
 * Created by PhpStorm.
 * User: Станислав Мирошник
 * Date: 11/29/2018
 * Time: 12:05 PM
 */

namespace application\core\AbstractFactory;

use application\core\AbstractFactory\AbstractFactory;

class Person implements MyObject
{
    public function getTitle()
    {
        return 'I am person.'; //получаем фразу в виде заголовка при вызове метода
    }
}