<?php

#[\AllowDynamicProperties]
class Benchmark {
  /**
   * Starts a benchmark.
   * 
   * @param string $name
   * @return void
   */
  public static function start(string $name = 'default'): void
  {
    $GLOBALS['benchmark'][$name][] = microtime(true);
  }

  /**
   * Calculates the time difference since start of the benchmark
   *
   * @param string $name
   * @return void
   */
  public static function end(string $name = 'default'): void
  {
    $GLOBALS['benchmark'][$name][ count($GLOBALS['benchmark'][$name])-1 ] = ( microtime(true) - $GLOBALS['benchmark'][$name][ count($GLOBALS['benchmark'][$name])-1 ] );
  }

  /**
   * Get function returns the time in seconds
   * 
   * @param string $name
   * @return string
   */
  public static function get(string $name = 'default', $decimal = 4): string
  {
    return round($GLOBALS['benchmark'][$name][count($GLOBALS['benchmark'][$name])-1], $decimal);
  }

  public static function getAll($decimal = 5)
  {
    $benchmarks = [];
    foreach ($GLOBALS['benchmark'] as $name => $benchmark) {
      $benchmarks[$name] = [];

      foreach ($benchmark as $index => $value) {
        $benchmarks[$name][$index] = round($value, $decimal) . ' sec';
      }

      if (count($GLOBALS['benchmark'][$name]) == 1) {
        $benchmarks[$name] = current($GLOBALS['benchmark'][$name]);
      }
    }

    return $benchmarks;
  }

  private static function convert($size)
  {
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
  }
  
  public static function memory()
  {
    return self::convert(memory_get_usage(true));
  }
}