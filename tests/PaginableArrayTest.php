<?php

namespace Vvval\Spiral\Tests;

use Spiral\Pagination\Paginator;
use Vvval\Spiral\PaginableArray;

class PaginableArrayTest extends BaseTest
{
    public function testSlicing()
    {
        $limit = 3;
        $paginable = $this->firstPagePaginable($limit);

        $this->assertEquals($limit, count($paginable->iterate()));
    }

    public function testKeys()
    {
        $paginable = $this->firstPagePaginable(3);

        $data = $paginable->iterate();

        $this->assertArrayHasKey('one', $data);
        $this->assertArrayNotHasKey('four', $data);
    }

    public function testNextPage()
    {
        $paginable = $this->anotherPagePaginable(3, 2);
        $data = $paginable->iterate();

        $this->assertArrayHasKey('four', $data);
        $this->assertArrayNotHasKey('one', $data);
    }

    public function testIteratedData()
    {
        $paginable = $this->firstPagePaginable(3);

        $data = $paginable->iterate();
        $this->assertContains(10, $data);
        $this->assertNotContains(40, $data);

        $i = 1;
        foreach ($data as $key => $value) {
            //Values are 10, 20, 30...
            $this->assertEquals($i * 10, $value);

            $i++;
        }
    }

    public function testNexPageIteratedData()
    {
        $paginable = $this->anotherPagePaginable(3, 2);
        $data = $paginable->iterate();

        $this->assertContains(40, $data);
        $this->assertNotContains(10, $data);
    }

    /**
     * @param int $limit
     * @return PaginableArray
     */
    protected function firstPagePaginable(int $limit): PaginableArray
    {
        $paginable = new PaginableArray($this->arr());
        $paginable->paginate($limit);

        return $paginable;
    }

    /**
     * @param int $limit
     * @param int $page
     * @return PaginableArray
     */
    protected function anotherPagePaginable(int $limit, int $page): PaginableArray
    {
        $paginable = new PaginableArray($this->arr());
        $paginable->setPaginator($this->paginator($limit, $page));

        return $paginable;
    }

    /**
     * @param int    $limit
     * @param int    $page
     * @param string $parameter
     * @return Paginator
     */
    protected function paginator(int $limit, int $page, string $parameter = 'page'): Paginator
    {
        return $this->container->make(
            Paginator::class,
            compact('limit', 'parameter')
        )->withPage($page);
    }

    /**
     * @return array
     */
    private function arr(): array
    {
        return [
            'one'   => 10,
            'two'   => 20,
            'three' => 30,
            'four'  => 40,
            'five'  => 50,
            'six'   => 60,
            'seven' => 70,
            'eight' => 80,
            'nine'  => 90,
            'ten'   => 100,
        ];
    }
}