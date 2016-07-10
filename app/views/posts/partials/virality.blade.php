<?php

$viralityColors = [
	50	=>	"#BE0000" , // deep red for score < 50 
	39	=>	"#FF4136" , // red for score < 39 
	29	=>	"#FF851B" ,	// orange for score < 29 
	19	=>	"#FFDC00" , // yello for score < 19
	9	=>	"#39CCCC" , // turquoise for score < 9
];

$virality = $score * 2; // convert to a percentile score

foreach($viralityColors as $key => $color){
	if ($score <= $key) {
		$viralityColor = $color;
	}
}
?>
<div class="viralityWrapper">
Virality &nbsp;
 <div class="viralityBox" title="Virality Score: {{$score}}/50">
  <div class="viralityScore" style ="background: {{$viralityColor}}; width: {{$virality}}%"> <!-- This will be styled from the code -->
  </div>
</div>
</div>
