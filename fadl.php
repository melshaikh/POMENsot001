<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PHP Find Nearest Location using Latitude and Longitude Example</title>
</head>
<body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Location List</h2>
                    </div>
                    <?php
 
                       require_once "db.php";
 
                        if (isset($_POST['submit'])) {
 
                            $lat = $_POST['lat'];
                            $long = $_POST['long'];
 
                            $sql = "SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( $lat - LatOnTable) *  pi()/180 / 2), 2) +COS( $lat * pi()/180) * COS(LatOnTable * pi()/180) * POWER(SIN(( $long - LongOnTable) * pi()/180 / 2), 2) ))) as distance  
                                from locations  
                                having  distance <= 10 
                                order by distance";
 
                            $result = mysqli_query($conn, $sql);
 
                        }
                    ?>
 
 
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                      <table class='table table-bordered table-striped'>
                       
                      <tr>
                        <td>Address</td>
                      </tr>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["address"]; ?></td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                    </table>
                     <?php
                    }
                    else{
                        echo "No result found";
                    }
                    ?>
 
                </div>
            </div>     
        </div>
 
</body>
</html>