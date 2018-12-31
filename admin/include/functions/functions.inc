<?php
    function checkItem($select,$table,$value){
        global $con;
        $stmt=$con->prepare("SELECT $select FROM $table WHERE $select=?");
        $stmt->execute(array($value));
        $count=$stmt->rowCount();
        return $count;
    }


    function countItem($column,$table){
        global $con;
        $stmt=$con->prepare("SELECT COUNT($column)FROM($table)");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
//    function to count exceptions
    function itemException($select,$table,$exception){
        global $con;
        $stmt=$con->prepare("SELECT $select FROM $table WHERE $select=?");
        $stmt->execute(array($exception));
        $count=$stmt->rowCount();
        return $count;
    }

    function deleteItem($select,$table,$delete){
        global $con;
        $stmt=$con->prepare("DELETE FROM $table WHERE $select=?");
        $stmt->execute(array($delete));
        $count=$stmt->rowCount();
        return $count;
    }
?>