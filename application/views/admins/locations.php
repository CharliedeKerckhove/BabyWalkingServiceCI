<?php
/*select child information*/
$query1 ='SELECT * FROM `facilities`';
$smt1 = $DBH->prepare($query1);
$smt1->execute();

/*search results*/
$clause = " WHERE ";//Initial clause
$query2="SELECT * FROM `locations`  ";//Query stub
    if(isset($_POST['keyword'])){
        foreach($_POST['keyword'] as $c){
            if(!empty($c)){
                $query2 .= $clause."`facility_name` LIKE '%{$c}%'";
                $clause = " AND ";//Change  to OR after 1st WHERE
            }   
        }
    }
$smt2 = $DBH->prepare($query2);
$smt2->execute();
?>
<div class="locationContent">
    <div id="msg">
    </div>

    <div class="productsSorter">
        <h2 class="searchTitles">Sort By</h2>
        <form action="" method="post" class="facilityList">
            <?php
        if($smt1->rowCount()>0){
            while($row1=$smt1->fetch(PDO::FETCH_ASSOC)){ echo "
            <input name='keyword[]' type='checkbox' value='".$row1['FacilityName']."' pid='".$row1['FacilitiesID']."'/><label class='facilityGap'>".$row1['FacilityName']."</label> <br>
            ";}}
        ?>
         
        <input class="submitFacility" type="submit" name="submit" value="Submit">
        </form>
    </div>

    <main id="products" class="productsContainer">
        <?php
        if($smt2->rowCount()>0){
            while($row=$smt2->fetch(PDO::FETCH_ASSOC)){ echo "
                <div class='productBox'>

                    <h4 class='locationName'>".$row['LocationName']."</h4>
                    <h4 class='locationCityTown'>".$row['CityTown']."</h4>
                    <h4 class='locationPostcode'>".$row['Postcode']."</h4>
                    <button type='submit' id='product' class='facilitiesBtn' pid='".$row['LocationID']."'>View Facilities</button>
                </div>
            ";}
        }
        ?>
    </main>
</div>
