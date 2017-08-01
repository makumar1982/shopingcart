<?php
session_start();
include 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>On Line Shopping Cart</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container" style="width: 60%">
            <h2 align="center">On Line Shopping Cart</h2>
            <?php
            $query = mysqli_query($con,"select * from product ORDER BY pid ASC");
            if(mysqli_num_rows($query)>0){
                while($row = mysqli_fetch_assoc($query)){ ?>
            <div class="col-md-4">
                <form method="post" action="shop.php?action=add&id=<?php echo $row['pid'];?>">
                    <div style="border: 1px solid red; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 10px" align ="center">
                        <img src="images/<?php echo $row['image'];?>" class="img-responsive">
                        <h5 class="text-info"><?php echo $row['pname'];?></h5>
                        <h5 class="text-danger"><?php echo $row['price'];?></h5>
                        <input type="text" name="quantity" class="form-control" value="1">
                        <input type="hidden" name="hidden_name" value="<?php echo $row['pname'];?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $row['price'];?>">
                        <input type="submit" name="add" style="margin-top:5px" class="btn btn default" value="ADD TO CART">
                    </div> 
                </form>
            </div>
                <?php }
            }
            ?>
            <div style="clear: both"></div>
            <h2>My Shopping Details</h2>
            <div class="table responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Product Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price Detail</th>
                        <th width="20%">Total Order</th>
                        <th width="5%">Action</th>
                    </tr>
                    <?php
                    if(!empty($_SESSION['cart'])){
                        $total = 0;
                        foreach($_SESSION['cart'] as $key => $value){ ?>
                    <tr>
                        <td><?php echo $value['item_name'];?> </td>
                        <td><?php echo $value['item_quantity'];?> </td>
                        <td><?php echo $value['product_price'];?> </td>
                        <td><?php echo number_format($value['item_quantity']*$value['product_price'],2);?> </td>
                        <td><a href="shop.php?action=delete?id=<?php echo $row['pid'];?>"><span class="text-danger">X</span></a></td>
                    </tr>
                        <?php 
                        $total = $total + ($value['item_quantity'] * $value['product_price']);
                        } ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>  
                        <td align="right" >$<?php echo number_format($total,2);?></td>
                        <td></td>
                    </tr>
                        
                    <?php }
                    ?>
                </table>
                
            </div>
        </div>
    </body>
</html>
