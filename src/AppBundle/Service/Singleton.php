<?php

namespace AppBundle\Service;


class Singleton
{
    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    protected static $instance;

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance(): Singleton
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getFactorial(int $number): int
    {
        if ($number > 1)
            return $number * $this->getFactorial($number - 1);

        return $number;
    }

    public function sortArray(array $arr): array
    {
        $count = count($arr);

        for ($i = 0; $i < $count; $i++) {
            $first = false;
            for ($j = $i; $j < $count + $i; $j++) {
                if (!$first && isset($arr[$j])) {
                    $first = true;
                    $max = $arr[$j];
                    $maxIndex = $j;
                }
                if (isset($arr[$j]) && $max < $arr[$j]) {
                    $max = $arr[$j];
                    $maxIndex = $j;
                }
            }

            unset($arr[$maxIndex]);
            array_unshift($arr, $max);
        }

        return $arr;
    }

    public function testClosure(): \Closure
    {
        return function () {
        };
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}
