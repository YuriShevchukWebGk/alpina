<?
//Генерация уникальных идентификаторов
function generateGUID() {
    $allchars = 'abcdef0123456789';
    $charsLen = strlen($allchars) - 1;   
    $string1 = '';
    $string2 = '';
    $string3 = '';
    $string4 = '';
    $string5 = '';
    for ($i = 0; $i < 8; $i++) {
        $string1 .= substr($allchars, rand(0, $charsLen), 1);  
    }                                                              
    for ($i = 0; $i < 4; $i++) {
        $string2 .= substr($allchars, rand(0, $charsLen), 1);   
    }                                                             
    for ($i = 0; $i < 4; $i++) {
        $string3 .= substr($allchars, rand(0, $charsLen), 1);   
    }                                                                 
    for ($i = 0; $i < 4; $i++) {
        $string4 .= substr($allchars, rand(0, $charsLen), 1);   
    }                                                                 
    for ($i = 0; $i < 12; $i++) {
        $string5 .= substr($allchars, rand(0, $charsLen), 1);   
    }    
    return $string1.'-'.$string2.'-'.$string3.'-'.$string4.'-'.$string5; 
} 

//Генерация уникальных идентификаторов
function tick_time() { 
    $time_from_begining_to_unix = 62135600400 + 2*60*60;                         
    $ticks = time() + $time_from_begining_to_unix;   
    $ticks = $ticks.'0000000';   
    return $ticks;   
} 
?>