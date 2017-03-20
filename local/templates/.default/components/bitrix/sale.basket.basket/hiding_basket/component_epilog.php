<script>
BX.ready(function(){
    // обрезка длинных названий
    $(".bookNameBask").each(function() {
        if($(this).length > 0) {
            $(this).html(truncate($(this).html(), 20));    
        }    
    });
});
</script>