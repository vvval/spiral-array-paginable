<?php

namespace Vvval\Spiral\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Traits\SharedTrait;
use Spiral\Pagination\PaginationFactory;
use Spiral\Pagination\PaginatorsInterface;
use Zend\Diactoros\ServerRequest;

abstract class BaseTest extends TestCase
{
    use SharedTrait;

    /**
     * @var TestApplication
     */
    protected $app;

    public function setUp()
    {
        $root = __DIR__ . '/-app-/';
        $this->app = TestApplication::init(
            [
                'root'        => $root,
                'libraries'   => dirname(__DIR__) . '/vendor/',
                'application' => $root,
                'framework'   => dirname(__DIR__) . '/source/',
                'runtime'     => $root . 'runtime/',
                'cache'       => $root . 'runtime/cache/',
            ],
            null,
            null,
            false
        );

        $this->app->container->bind('factory', $this->app->container);
        $this->app->container->bind(PaginatorsInterface::class, PaginationFactory::class);
        $this->app->container->bind(ServerRequestInterface::class, ServerRequest::class);

        clearstatcache();

        //Open application scope
        TestApplication::shareContainer($this->app->container);
    }

    /**
     * This method performs full destroy of spiral environment.
     */
    public function tearDown()
    {
        TestApplication::shareContainer(null);

        //Forcing destruction
        $this->app = null;

        gc_collect_cycles();
        clearstatcache();
    }

    /**
     * @return \Spiral\Core\ContainerInterface
     */
    protected function iocContainer()
    {
        return $this->app->container;
    }
}