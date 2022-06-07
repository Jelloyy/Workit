<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$startFrom = ($page-1) * $resultPerPage;
if($onlyLogged===1){
$query = "SELECT * FROM users WHERE logged='1' ORDER BY ID ASC LIMIT $startFrom, ".$resultPerPage;
}elseif($onlyLogged===0){
    $query = "SELECT * FROM users ORDER BY ID ASC LIMIT $startFrom, ".$resultPerPage;
}
$result = mysqli_query($con, $query);

$query2 = "SELECT COUNT(ID) AS total FROM users";
$result2 = mysqli_query($con, $query2);
$site = mysqli_fetch_assoc($result2);
$total_pages = ceil($site['total'] / $resultPerPage);