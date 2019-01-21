<?php

session_start();

if (isset($_SESSION['agency_id'])) {

require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/b_nav_bar.php';



   $agency_id = isset($_POST["agency_id"]) ? $_POST["agency_id"] : "";
$agency_name = isset($_POST["agency_name"]) ? $_POST["agency_name"] : "";


//--------------------------------------------------------//
//traitement du Submit
//--------------------------------------------------------//
if(isset($_POST['Modifier'])){
 if($agency_id){
  $sql = "UPDATE agency 
       SET agency_name=:agency_name,
      WHERE agency_id = :agency_id";
  
  try{
   $stmt = $bdd->prepare($sql);
   $stmt->bindparam(':agency_id',$agency_id);
   $stmt->bindparam(':agency_name',$agency_name);

   
  $retour = $stmt->execute();
  }
catch(Exception $e){
   echo "Erreur ! " .$e->getMessage();
  }
 }
}


//--------------------------------------------------------//
//Récupération des infromations du RDV si elles existent
//--------------------------------------------------------//
if($agency_id){
 $sql = "SELECT *
     FROM agency
     WHERE agency_id = :agency_id ";

 $a_datas = array(":agency_id"=>$agency_id);     
 try{ 
   $stmt = $bdd->prepare($sql);
   $retour = $stmt->execute();
   $result = $stmt->fetchAll(); //on stocke les resultats dans un array
  $array_result = $result[0];
   
               // Close connection
               $accounts->closeCursor();

              }
          
              ?>
          </div>
      </div>        
  </div>
</div>

<?php include '../modules/end.php';

} else {
  header('location:../pages/b_login.php');
}