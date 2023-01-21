<?php
// namespace Algenza\Cosinesimilarity;

class Cosine
{
    public static function similarity(array $vec1, array $vec2)
    {
        $vectorKey = array_keys(array_merge($vec1, $vec2));

        $dotProduct = 0;
        $magnitudeVec1 = 0;
        $magnitudeVec2 = 0;

        foreach ($vectorKey as $key) {
            $keyVec1Val = isset($vec1[$key]) ? $vec1[$key] : 0;
            $keyVec2Val = isset($vec2[$key]) ? $vec2[$key] : 0;
            $dotProduct += ($keyVec1Val * $keyVec2Val);
            $magnitudeVec1 += ($keyVec1Val * $keyVec1Val);
            $magnitudeVec2 += ($keyVec2Val * $keyVec2Val);
        }

        $magnitudeVec1 = sqrt($magnitudeVec1);
        $magnitudeVec2 = sqrt($magnitudeVec2);

        $similarity = $dotProduct / ($magnitudeVec1 * $magnitudeVec2);
        return $similarity;
    }
}
function getSimilarity($matrix, $item, $otherProduct)
{
    $vectorUser = array();
    $vectorOtherUser = array();
    $match = 0;
    if (isset($matrix[$item])) {
        foreach ($matrix[$item] as $key => $value) {
            if (array_key_exists($key, $matrix[$otherProduct])) {
                $vectorUser[] = $value;
                $vectorOtherUser[] = $matrix[$otherProduct][$key];
                $match++;
            } else {
                $vectorUser[] = $value;
                $vectorOtherUser[] = 0;
            }
        }

        foreach ($matrix[$otherProduct] as $key => $value) {
            if (array_key_exists($key, $matrix[$item])) {
            } else {
                $vectorOtherUser[] = $value;
                $vectorUser[] = 0;
            }
        }
        $data =  Cosine::similarity($vectorUser, $vectorOtherUser);

        if ($match == 0) {
            return -1;
        }
        return $data;
    }
}
function getRecommendation($matrix, $user)
{
    $total = array();
    $simsums = array();
    $ranks = array();
    foreach ($matrix as $otherUser => $value) {
        if ($otherUser != $user) {
            $sim = getSimilarity($matrix, $user, $otherUser);
            // "Độ gần giống : " . $otherUser . " với " . $user . " là : " . $sim . "<br/>";
            if ($sim == -1) continue;
            foreach ($matrix[$otherUser] as $key => $value) {
                if (isset($matrix[$user])) {
                    if (!array_key_exists($key, $matrix[$user])) {
                        if (!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        $total[$key] += $matrix[$otherUser][$key] * $sim;

                        if (!array_key_exists($key, $simsums)) {
                            $simsums[$key] = 0;
                        }
                        $simsums[$key] += $sim;
                    }
                } else {
                    return 0;
                }
            }
        }
    }

    foreach ($total as $key => $value) {
       
        $ranks[$key] = round($value / $simsums[$key], 2);;
  
    
    }

    function testodd($var)
    {
        return ($var >= 3);
    }
    $a1 = $ranks;
    //  echo "<pre>";
    //     print_r($a1);
    //     echo "</pre>";
    $hang = array_filter($a1, "testodd");
    array_multisort($hang, SORT_DESC);
    return $hang;
}
function getRecommendation1($matrix, $user)
{
    $total = array();
    $simsums = array();
    $ranks = array();
    foreach ($matrix as $otherUser => $value) {
        if ($otherUser != $user) {
            $sim = getSimilarity($matrix, $user, $otherUser);
            $sim1 = round($sim,2);
            // "Độ gần giống : " . $otherUser . " với " . $user . " là : " . $sim . "<br/>";
            $kh[$otherUser] = $sim1;
            $new_product = array('ten_kh' => $value, 'dogiong' => $sim1);
        }
    }
    // echo "<pre>";
    //     print_r($kh);
    //     echo "</pre>";
    return $kh;
}
