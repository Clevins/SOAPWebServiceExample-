<?php

/*
 * Written by: Peter Gosling, DkIT
 * Copyright 2016
 * 
 */

require_once('php/database.php');

function getBookEntry($bookId) {
    global $db;
    $query = "SELECT * FROM book Where book_id = :bookId;";
    $statement = $db->prepare($query);
    $statement->bindValue(":bookId",$bookId);
    $statement->execute();
    
    $json = "[";
    if ($statement->rowCount() > 0) {
        /* Get field information for all fields */
        $isFirstRecord = true;
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            if (!$isFirstRecord) {
                $json .= ",";
            }
            $json .= '{"title":"' . $row->title . '","image":"' . $row->image . '","description":"' . $row->description . '","category":"' . $row->category . '","ISBN":"' . $row->ISBN . '","author":"' . $row->author . '","year":"' . $row->year . '"}';

            $isFirstRecord = false;
        }
    }
    $json .= "]";
    return $json;
}

function getAllBooks() {
    global $db;
    $query = "SELECT * FROM book;";
    $statement = $db->prepare($query);
    $statement->execute();
    
    $json = "[";
    if ($statement->rowCount() > 0) {
        /* Get field information for all fields */
        $isFirstRecord = true;
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            if (!$isFirstRecord) {
                $json .= ",";
            }
            $json .= '{"title":"' . $row->title . '","image":"' . $row->image . '","description":"' . $row->description . '","category":"' . $row->category . '","ISBN":"' . $row->ISBN . '","author":"' . $row->author . '","year":"' . $row->year . '"}';

            $isFirstRecord = false;
        }
    }
    $json .= "]";
    return $json;
}

function getBookCategory($bookCategory) {
    global $db;
    $query = "SELECT * FROM book Where category = :book_category;";
    $statement = $db->prepare($query);
    $statement->bindValue(":book_category",$bookCategory);
    $statement->execute();

    
    $json = "[";
    if ($statement->rowCount() > 0) {
        /* Get field information for all fields */
        $isFirstRecord = true;
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            if (!$isFirstRecord) {
                $json .= ",";
            }
            $json .= '{"title":"' . $row->title . '","image":"' . $row->image . '","description":"' . $row->description . '","category":"' . $row->category . '","ISBN":"' . $row->ISBN . '","author":"' . $row->author . '","year":"' . $row->year . '"}';

            $isFirstRecord = false;
        }
    }
    $json .= "]";
    return $json;
}


function getBookYear($year1 , $year2) {
    global $db;
    $query = "SELECT * FROM `book` WHERE (SELECT YEAR(year)) BETWEEN :year_1 AND :year_2;";
    $statement = $db->prepare($query);
    $statement->bindValue(":year_1",$year1);
    $statement->bindValue(":year_2",$year2);
    $statement->execute();

    
    $json = "[";
    if ($statement->rowCount() > 0) {
        /* Get field information for all fields */
        $isFirstRecord = true;
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            if (!$isFirstRecord) {
                $json .= ",";
            }
            $json .= '{"title":"' . $row->title . '","image":"' . $row->image . '","description":"' . $row->description . '","category":"' . $row->category . '","ISBN":"' . $row->ISBN . '","author":"' . $row->author . '","year":"' . $row->year . '"}';

            $isFirstRecord = false;
        }
    }
    $json .= "]";
    return $json;
}



ini_set("soap.wsdl_cache_enabled", "0");
$server = new SoapServer("book.wsdl");
$server->addFunction("getBookEntry");
$server->addFunction("getAllBooks");
$server->addFunction("getBookCategory");
$server->addFunction("getBookYear");
$func = $server->getFunctions();
$server->handle();
?>