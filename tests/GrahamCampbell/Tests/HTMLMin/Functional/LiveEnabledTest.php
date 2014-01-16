<?php

/**
 * This file is part of Laravel HTMLMin by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Tests\Functional\HTMLMin;

use GrahamCampbell\Tests\HTMLMin\AbstractTestCase;

/**
 * This is the live enabled test class.
 *
 * @package    Laravel-HTMLMin
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-HTMLMin/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-HTMLMin
 */
class LiveEnabledTest extends AbstractTestCase
{
    /**
     * Specify if routing filters are enabled.
     *
     * @return bool
     */
    protected function enableFilters()
    {
        return true;
    }

    /**
     * Additional application environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function additionalSetup($app)
    {
        $app['config']->set('htmlmin::live', true);
    }

    public function testNewSetup()
    {
        $this->app->register($this->getServiceProviderClass());

        $this->app['view']->addNamespace('stubs', realpath(__DIR__.'/../../../../views'));

        $this->app['router']->get('htmlmin-test-route', function () {
            return $this->app['view']->make('stubs::test');
        });

        $return = $this->call('GET', 'htmlmin-test-route')->getContent();

        $this->assertEquals("<h1>Test</h1>", $return);
    }
}