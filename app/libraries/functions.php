<?php 

  /**
  * utility functions for lebanese blogs
  */

  class lbFunctions 
  {
    public static function isArabic($string){
      if (preg_match("/([ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]).+/", $string)){
        return false;
      } else {
        return true;
      }
    }
    
    public static function hours_to_days($hours){
    $seconds = $hours * 3600;
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                  30 * 24 * 60 * 60       =>  'month',
                  24 * 60 * 60            =>  'day',
                  60 * 60                 =>  'hour',
                  60                      =>  'minute',
                  1                       =>  'second'
                  );

      foreach ($a as $secs => $str)
      {
          $d = $seconds / $secs;
          if ($d >= 1)
          {
              $r = round($d);
              return $r . ' ' . $str . ($r > 1 ? 's' : '') ;
          }
      }

  }

    static function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'min',
                    1                       =>  'sec'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }
  }
?>