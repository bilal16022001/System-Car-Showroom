<?php
/*
    this function her role checkItem is found in dtabase ?
*/
function checkitem($filed,$nameTable,$value1,$value2){
   global $con;

   $stmt = $con->prepare("SELECT $filed FROM $nameTable WHERE name = ? AND password = ?");
   $stmt->execute(array($value1,$value2));
   $count = $stmt->rowCount();
   return $count;

}

/*
   this function her role get anything in dtabase ?
   function v2.0
*/

function getdb($filed,$table,$NameWhere=null,$where=null,$valueWhere=null){
   global $con;

   $stmt = $con->prepare("SELECT $filed FROM $table $NameWhere $where $valueWhere");
   $stmt->execute();
   $data = $stmt->fetchAll();
   return $data;
}
/*

*/

 function deleteItem($nameTable,$id,$value){
    global $con;
    $stmt = $con->prepare("DELETE FROM  $nameTable WHERE $id = '$value'");
    $stmt->execute();
    $count = $stmt->rowCount();
    return $count;
 }

 /*
 
 */

 function CountItem($item,$nameTable,$condition=null){
       global $con;
       $stmt = $con->prepare("SELECT COUNT($item) FROM $nameTable $condition");
       $stmt->execute();
       return $stmt->fetchColumn();
 }




?>