<?php
function colorToRgb($color, &$r, &$g, &$b)
{
    $r = ($color >> 16) & 0xFF;
    $g = ($color >> 8) & 0xFF;
    $b = $color & 0xFF;
}

$img = imagecreatefrompng( '/upload/resize_cache/iblock/eca/264_394_1/ecac079fcc7b8e23eefaf7a15ba4db38.jpg' );

$hFactor = 2;
$vFactor = 12;

echo "<" . "?php\nclass colorMap {\n\tpublic \$map;\n\n";
echo "\tfunction __construct() {\n\t\t\$this->map = array(\n";

for ( $h = 0; $h < 360; $h += 15 )
{
    for ( $s = 0; $s < 5; $s += 1 )
    {
        for ( $v = 0; $v < 10; $v += 1 )
        {
            $c = imagecolorat( $img, $h * $hFactor, $s * 120 + $v * $vFactor );
            colorToRgb($c, $r, $g, $b);

            printf( "\t\t\t'x%03x%01x%01x' => '#%02x%02x%02x',\n",
                $h, $s, $v, $r, $g, $b
            );
        }
    }
}

echo "\t\t);\t}\n}\n";
$key = sprintf('x%03x%01x%01x',
    max(0, min(345, floor( $h / 15 ) * 15)),
    min(4, floor($s * 5)),
    min(9, floor($v * 10))
);
echo $key;
?>