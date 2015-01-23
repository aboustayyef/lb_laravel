{{--

Requires:
Numerator: $n (float)
Denominator: $d (int)
--}}

<?php
  $fullStars = floor($n);
  $halfStars = ceil($n) == floor($n) ? 0:1;
  $emptyStars = $halfStars? $d - 1 - $fullStars : $d - $fullStars;
  $score = $fullStars;
  if ($halfStars) {
    $score = $score + 0.5;
  }
?>

<div class="stars" title="Blogger rating: {{$score}} / {{$d}}">

  <?php
    for ($i=0; $i < $fullStars ; $i++) {
      echo '<span class="fullstar"></span>';
    }
    if ($halfStars) {
      echo '<span class="halfstar"></span>';
    }
    for ($i=0; $i < $emptyStars ; $i++) {
      echo '<span class="emptystar"></span>';
    }
  ?>

</div>
