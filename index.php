<?php
/**
 * Beykarwebs.
 * User: Hamid Khaldi
 * Date: 26/04/2018
 * Time: 13:00
 */

    include 'includes/utilities.php';
    include 'includes/header.php';
    include 'includes/nav.php';

//=========== building a query to get the products from the database


    $pq= "
        SELECT *
        
        FROM `". DBN ."`.`product`

        ORDER BY
                `product`.`pID`
    
        ASC
        
        LIMIT 12
    ";

    //echo $pq;


    $pRes = $mysqli->query($pq);


    // fetching the data in the form of an associative array and pushing into a new array
    if ($pRes->num_rows > 0){
        $prods = [];
        while ($row = $pRes->fetch_assoc()){
            array_push($prods, $row);
        }



        //trace($prods);
    }// if num-rows > 0


#### INSERTING THE ORDER INTO `order` TABLE


if (isset($_GET['p_id']) && isset($_GET['p_qty']) && $_GET['p_id']!='' && $_GET['p_qty'] > 0) {

    $p_id      = $_GET['p_id'];
    $p_qty     = $_GET['p_qty'];



    $iq = "
        
            INSERT INTO
            
            `" . DBN . "`.`order`
            
            (`p_id`, `p_qty`)
            
            VALUES
            
            ('$p_id', '$p_qty')
        
        
        ";
   //echo $iq;

    $iRes = $mysqli->query($iq);

    if ($mysqli->affected_rows === 1) {
        echo"<h3 class='added'>order added successfully!</h3>";
    } else {
        echo "<h3 class='added'>there are no products to add</h3>";
    }

} else {
    echo "<h3 class='deleted'>please enter a valid quantity.</h3>";
}//insert product into cart

?>

<!--suppress ALL -->
<section class="mainBody">
     <div class="container">


             <div><h1>Third Bridge Test - Hamid Khaldi</h1></div>
             <div><h2 class="sectionTitle">View Our products</h2></div>




                <?php if( isset($prods) ){ ?>


                <table>
                    <tr>
                        <th>Product ID</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>add to basket</th>
                    </tr>

                <?php foreach($prods as $prod){ ?>
                        <td><?php echo $prod["pID"]; ?></td>
                        <td><?php if(isset($prod["pName"])){ echo $prod["pName"]; } else { echo "--"; }?></td>
                        <td>&pound;<?php if(isset($prod["pPrice"])){ echo $prod["pPrice"]; } else { echo "--"; }?></td>
                        <td><select id="<?php echo $prod["pID"]; ?>">
                                <?php for ($i=0;$i<=10;$i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }//for ?>
                            </select>
                            <a id="<?php echo $prod['pID'];?>" href="?p_id=<?php echo $prod['pID'];?>&p_qty=">add to basket</a></td>
                    </tr>
                <?php } // foreach?>

                </table>
            <?php } // if $prods ?>


     </div><!--/container-->
</section><!--/ mainBody-->
</main>


</div><!--/wrapper-->
<?php include 'includes/footer.php';?>