<nav class="topNav">
    <ul class="">

        <?php
            $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


        if( strpos( $url,'index' ) !== false ) {
            echo "<li><a  href=". ROOT."cart.php><h3>View Cart</h3></a></li>";
        }  else {
            echo "<li><a  href=". ROOT."index.php><h3>View Products</h3></a></li>";
        }?>


    </ul>
</nav>