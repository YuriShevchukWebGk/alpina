<script type="text/javascript">
    var initial_scale, screen_width = screen.width;
    if (screen_width <= 360) {
        initial_scale = 0.3;
    } else if (screen_width <= 415) {
        initial_scale = 0.5;
    } else if (screen_width <= 960) {
        initial_scale = 0.8;
    } else if (screen_width < 1024) {
        initial_scale = 0.5;
    }
    $('head').append('<meta name="viewport" content="user-scalable=yes, initial-scale=' + initial_scale + ', maximum-scale=0.8, width=device-width">');
</script>