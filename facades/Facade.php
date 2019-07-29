<?php

abstract class Facade
{
    protected static $app = null;
    protected static $resolvedInstances = [];
    
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }
    
    protected static function getFacadeAccessor()
    {
        throw new \RuntimeException ('Facade does not implement getFacadeAccessor method.');
    }

    protected static function resolveFacadeInstance($name)
    {
        if (isset(static::$resolvedInstances[$name]))
            return static::$resolvedInstances[$name];

        return static::$resolvedInstances[$name] = static::$app->get($name);
    }
    
    public static function setFacadeApplication($app)
    {
        static::$app = $app;
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();
        
        if (! $instance)
            throw new \RuntimeException('A facade root has not been set.');
        
        return $instance->$method(...$args);
    }
}