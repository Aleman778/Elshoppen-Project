<?php 
    if (!function_exists("createStars")) {       
        function createStars($stars, $rating, $size=28, $numReviews=0, $showStats=false) {
            echo "<div class='row' style='margin: 6px;'>";
            for ($i = 1; $i < $stars + 1; $i++) {
                if ($i < $rating) {
                    echo "<div><img src='/images/icons/star_gold.png' width='$size' height='$size'></div>";
                } else if ($i < $rating + 1) {
                    $w1 = $size * ($rating - $i + 1.0);
                    $w2 = $size * ($i - $rating);
                    echo "<div style='width: ".$w1."px; overflow:hidden;'><img src='/images/icons/star_gold.png' width='$size' height='$size'></div>";
                    echo "<div style='width: ".$w2."px; overflow:hidden; position: relative; left: 0px;'><img style='position: absolute; left: -".$w1."px;'  src='/images/icons/star.png' width='$size' height='$size'></div>";
                } else {
                    echo "<div><img src='/images/icons/star.png' width='$size' height='$size'></div>";
                }
            }
            if ($showStats) {
                echo "<div style='margin-left: 12px; margin-top: 2px;'>$rating/5.0 (från $numReviews recensioner)</div>";
            }
            echo "</div>";
        }
    }
?>