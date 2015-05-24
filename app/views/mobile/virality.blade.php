<?php

$viralityMap = [
  9   =>  '#FFDC00',
  19  =>  '#FF851B',
  29  =>  '#FF4136',
  39  =>  '#BE0000'
];
$viralityColor = "#39CCCC"; // default green

foreach ($viralityMap as $key => $color) {
  if ($score > $key) {
    $viralityColor = $color;
  }
}

$virality = $score;

?>

<div class="viralityBox" title="Virality Score: {{$score}}/50">
  <div class="viralityScore" style ="background: {{$viralityColor}}; width: {{$virality}}px"> </div>
</div>
