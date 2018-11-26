<?php


$client = new SoapClient("book.wsdl");
$func = filter_input(INPUT_POST, 'data');



if ($func === "getAllBooks") {
    getAllBooks();
} elseif ($func === "getAllTags") {
    getAllTags();
} elseif($func === "getBookCategory"){
    $bookCategory = filter_input(INPUT_POST,'tagsValue');
    getBookCategory($bookCategory);
} elseif($func === "getBookYear"){
    $year1 = filter_input(INPUT_POST,'yearValue1');
    $year2 = filter_input(INPUT_POST,'yearValue2');
    getBookYear($year1, $year2);
}

function getAllBooks() {
    global $client;
    $allBooks = $client->getAllBooks();
    $allBooksDecode = json_decode($allBooks, true);

    foreach ($allBooksDecode as $row) {
        echo '<div class="col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">' . $row['title'] . '</a>
                  </h4>
                 
                  <p class="card-text">' . $row['description'] . '</p>
                </div>
                <div class="card-footer">
                <h6>By ' . $row['author'] . '</h6>
                </div>
                <div class="card-footer">
                <p>Released  ' . $row['year'] . '</p>
                </div>
              </div>
            </div>';
    }
}

function getAllTags() {
    global $client;
    $allTags = $client->getAllBooks();
    $allTagsDecode = json_decode($allTags, true);

    foreach ($allTagsDecode as $row) {
        echo ' <a href="#" class="list-group-item" onclick={ajaxGetBookCategory("' . $row['category'] . '")}>' . $row['category'] . ' </a>';
    }
}

function getBookCategory($bookCategory) {
    global $client;
    $allBooksCategory= $client->getBookCategory($bookCategory);
    $allBooksCategoryDecode = json_decode($allBooksCategory, true);
    
    foreach ($allBooksCategoryDecode as $row) {
        echo '<div class="col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">' . $row['title'] . '</a>
                  </h4>
                  
                  <p class="card-text">' . $row['description'] . '</p>
                </div>
                <div class="card-footer">
                <h6>By ' . $row['author'] . '</h6>
                </div>
                <div class="card-footer">
                <p>Released  ' . $row['year'] . '</p>
                </div>
              </div>
            </div>';
    }
}

function getBookYear($year1,$year2){
    global $client;
    $allBooksYear = $client->getBookYear($year1, $year2);
    $allBooksYearDecode = json_decode($allBooksYear, true);
    foreach ($allBooksYearDecode as $row) {
        echo '<div class="col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">' . $row['title'] . '</a>
                  </h4>
                  
                  <p class="card-text">' . $row['description'] . '</p>
                </div>
                <div class="card-footer">
                <h6>By ' . $row['author'] . '</h6>
                </div>
                <div class="card-footer">
                <p>Released  ' . $row['year'] . '</p>
                </div>
              </div>
            </div>';
    }
}
?>