<?php
/**
 * BeykarWebs
 * User: Hamid Khaldi
 * Date: 26/04/2018
 * Time: 14:00
 *
 * this is the cart/basket file
 */


    include 'includes/utilities.php';
    include 'includes/header.php';
    include 'includes/nav.php';



    #### DELETING AN ORDER

        if (isset($_GET['d_id'])) {


            $d_id = (int)$_GET['d_id'];

            // using the product id rather than the order id to delete all instances of the product.

            $dq = "
            DELETE FROM
              `" . DBN . "`.`order`
              
            WHERE 
              `order`.`p_id` = '$d_id'
        
        ";


            $dRes = $mysqli->query($dq);


            if ($mysqli->affected_rows === 1) {

                echo "<h3 class='deleted'>order deleted successfully!</h3>";
            } else {
                echo "<h3 class='deleted'>could not delete order.</h3>";
            }

        }// delete mode


        ### SELECTING THE ORDER FROM THE TABLE


        $oq = "
            SELECT *
                      
            FROM
            `" . DBN . "`.`order`
        INNER JOIN
            `" . DBN . "`.`product`
        ON
            (`order`.`p_id` = `product`.`pID`)
              
        GROUP BY
            `order`.`p_id`
        ORDER BY
            `product`.`pPrice`
        DESC    
          
    
    ";


      //echo $oq;
        $oRes = $mysqli->query($oq);

        //trace($oRes);

       if ($oRes->num_rows > 0){
             $prods =[];
           $overallSubTot = 0;

             while ($row = $oRes->fetch_assoc()){
                 $row["sub_total"] = $row["pPrice"] * $row["p_qty"];
                 $overallSubTot += $row["sub_total"];
                 array_push($prods, $row);
             }

             //trace($prods);

             ##### discount becomes applicable if there are more than 3 items ordered  ###
             if (count($prods)> 3){
                     $discount = $overallSubTot * .19;
                     $grandTotal = $overallSubTot - $discount;

             } else {
                 $grandTotal = $overallSubTot;
             }
         }

?>

<section class="mainBody">
    <div class="container">

        <div><h1>Third Bridge Test - Hamid Khaldi</h1></div>

        <?php if( isset($prods) ){ ?>

            <h2 class="sectionTitle">CART SUMMARY</h2>


            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>

                    <th>remove item</th>

                </tr>

                <?php foreach ($prods as $prod) {?>

                    <tr>
                        <td><?php echo $prod["oID"]; ?></td>
                        <td><?php echo $prod["p_id"]; ?></td>
                        <td><?php if(isset($prod["pName"])){ echo $prod["pName"]; } else { echo "--"; }?></td>
                        <td>&pound;<?php if(isset($prod["pPrice"])){ echo $prod["pPrice"]; } else { echo "--"; }?></td>
                        <td><?php if(isset($prod["p_qty"])){ echo $prod["p_qty"]; } else { echo "--"; }?></td>
                        <td>&pound;<?php if(isset($prod["sub_total"])){ echo ($prod["sub_total"]) ; } else { echo "--"; }?></td>
                        <td><a href="cart.php?d_id=<?php echo $prod[">remove item</a></td>
                    </tr>
                <?php } // foreach?>

            </table>

        <table>
            <tr>
                <th>SUBTOTAL</th>
                <th>19% DISCOUNT</th>
                <th>GRAND TOTAL</th>

            </tr>

            <tr>
                    <td>&pound;<?php
                        if(isset($overallSubTot)){
                            echo number_format($overallSubTot, 2);
                        } else {
                            echo "0.00";
                        }?></td>
                    <td>&pound;<?php
                        if(isset($discount)){
                            echo number_format($discount, 2);
                        } else {
                            echo "0.00";
                        }?></td>
                    <td>&pound;<?php
                        if(isset($grandTotal)){
                            echo number_format($grandTotal, 2);
                        } else {
                            echo "0.00";
                        }?></td>
                </tr>
        </table>
        <?php }  else {
           echo"<div><h1>Cart is empty - no products to display.</h1></div>";

        }// if $prods ?>
    </div><!--/container-->
</section><!--/ mainBody-->
</main>

