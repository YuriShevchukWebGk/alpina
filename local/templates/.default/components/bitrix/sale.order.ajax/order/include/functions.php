<? 
function metro_cmp($a, $b) {
    if ($a["NAME"] == $b["NAME"]) {
        return 0;
    }
    return ($a["NAME"] < $b["NAME"]) ? -1 : 1;
} ?>