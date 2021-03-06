{{--

Requires the original numerator and denominator:
Numerator: $n (float)
Denominator: $d (int)
--}}

<?php
  // convert score to a 5 star rating system
  $ratio = $n / $d ;

  $score_over_five = $ratio * 5;

  // round it to the nearest 0.5 ;
  $score_over_five = (round($score_over_five * 2))/2;

  $N = $score_over_five;
  $D = 5;

  $fullStars = floor($N);
  $halfStars = ceil($N) == floor($N) ? 0:1;
  $emptyStars = $halfStars? $D - 1 - $fullStars : $D - $fullStars;
  $score = $fullStars;
  if ($halfStars) {
    $score = $score + 0.5;
  }
?>

<ul class="post__rating" title="Blogger rating: {{$score}} / {{$D}} (original: {{$n}} / {{$d}})">
  <li class="rating__label">Rating:</li>
  <li class="rating__stars">
    <?php
      for ($i=0; $i < $fullStars ; $i++) {
        
        echo '<span class="star"><img src="/img/transparent.png" class="lazy" data-original="/img/fullstar.png"></span>';
      }
      if ($halfStars) {
        echo '<span class="star halfstar"><img src="/img/transparent.png" class="lazy" data-original="/img/halfstar.png"></span>';
      }
      for ($i=0; $i < $emptyStars ; $i++) {
        echo '<span class="star emptystar"><img src="/img/transparent.png" class="lazy" data-original="/img/emptystar.png"></span>';
      }
    ?>
  </li>
</ul>
