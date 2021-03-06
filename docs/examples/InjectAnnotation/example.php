<?php
/**
 * Example using ding. See also beans.xml.
 *
 * PHP Version 5
 *
 * @category   Ding
 * @package    Examples
 * @subpackage Basic
 * @author     Marcelo Gornstein <marcelog@gmail.com>
 * @license    http://marcelog.github.com/ Apache License 2.0
 * @link       http://marcelog.github.com/
 *
 * Copyright 2011 Marcelo Gornstein <marcelog@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */
ini_set(
    'include_path',
    implode(
        PATH_SEPARATOR,
        array(
            implode(DIRECTORY_SEPARATOR, array('..', '..', '..', 'src', 'mg')),
            ini_get('include_path'),
        )
    )
);

interface SomeInterface
{
}

/**
 * @Component
 */
class InjectByType implements SomeInterface
{
}

/**
 * @Component
 */
class InjectByType2 implements SomeInterface
{
}


/**
 * This is our bean.
 * @Component(name=myBean)
 */
class MyBean
{
    /**
     * @Resource
     */
    private $myDependency;

    public function init()
    {
        echo "init\n";
    }
    public function destroy()
    {
        echo "destroy\n";
    }
    public function __construct()
    {

    }
}

/**
 * @Component(name=myDependency)
 */
class MyDependency
{

    /**
     * @Bean(class="AClassForABeanFromAMethod")
     */
    public function beanDeclaredInMethod()
    {
        return new AClassForABeanFromAMethod();
    }
}

class AClassForABeanFromAMethod
{
    /**
     * @Inject(type="SomeInterface[]", required="true")
     * @var pepe
     */
    protected $property;
    protected $property2;

    /**
     * @Inject(type="SomeInterface[]")
     */
    public function aha(array $a)
    {
        $this->property2 = $a;
    }
}

/**
 * @Configuration
 */
class Config
{
    /**
     * @Bean(class="InjectedWithConstructor")
     * @Inject
     * @Value(name="asd", value="a")
     */
    public function newBean(InjectByType $blah, $asd, InjectByType2 $blah2, array $a = array())
    {
        return new InjectedWithConstructor($blah, $asd, $blah2, $a);
    }
}
/**
 * @Component(name="injectedWithConstructor")
 */
class InjectedWithConstructor
{
    private $_some;
    private $_some2;
    private $_some3;

    /**
     * @Inject
     * @Inject(name="asd", type="InjectByType2")
     * @Value(name="asd", value="a")
     */
    public function __construct(InjectByType $blah, $asd, InjectByType2 $blah2, array $a = array())
    {
        $this->_some = $blah;
        $this->_some2 = $blah2;
        $this->_some3 = $asd;
    }
}

require_once 'Ding/Autoloader/Autoloader.php'; // Include ding autoloader.
\Ding\Autoloader\Autoloader::register(); // Call autoloader register for ding autoloader.
use \Ding\Container\Impl\ContainerImpl;


// Here you configure the container, its subcomponents, drivers, etc.
$properties = array(
    'ding' => array(
        'log4php.properties' => __DIR__ . '/../log4php.properties',
        'factory' => array(
            'bdef' => array( // Both of these drivers are optional. They are both included just for the thrill of it.
                'annotation' => array('scanDir' => array(realpath(__DIR__)))
            ),
        ),
        // You can configure the cache for the bean definition, the beans, and the proxy definitions.
        // Other available implementations: zend, file, dummy, and memcached.
    	'cache' => array(
            'proxy' => array('impl' => 'apc'),
            'bdef' => array('impl' => 'apc'),
            'beans' => array('impl' => 'apc')
        )
    )
);
$container = ContainerImpl::getInstance($properties);
$bean = $container->getBean('myBean');
var_dump($bean);
$bean = $container->getBean('beanDeclaredInMethod');
var_dump($bean);

var_dump($container->getBean('newBean'));
var_dump($container->getBean('injectedWithConstructor'));
