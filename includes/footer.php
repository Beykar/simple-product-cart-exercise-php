<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script>

    $( "select" )
        .change(function () {
            $id = $(this).attr('id');
            //console.log($id);
            var $a = $(this).parent().find('a').attr('href'),
                $q= $( this ).val();
            $a+=$q;
            $("a").prop("href", $a);
        });
</script>


</body>
</html>