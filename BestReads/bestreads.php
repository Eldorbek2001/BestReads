<?php
  // File name: bestreads.php
  // Author: Ali Elbekov
  
$whatToSend = $_GET['message'];

$coursesImages =  array("2001spaceodyssey", "alannathe1stadventure", "aliceinwonderland",
    "aroundtheworld80days", "callofthewild", "colorofmagic",
    "computernetworks", "harrypotter", "hobbit", "insomnia", "kakuro", "pokemon",
    "theoryofcomputation", "wizardofoz"
);

if($whatToSend=="home"){
    $arrReady = array();
    for($i = 0; $i<sizeof($coursesImages); $i++){
        $bookName = $coursesImages[$i];
        
        $eachBook = "<div class = 'onebook'>";
        $eachBook.= '<img src="books/'.$bookName.'/cover.jpg" onclick = "pageOpener('."'".$bookName."'".')">';
        $eachBook .= "</div>";
        array_push($arrReady, $eachBook);
    }
    echo json_encode($arrReady);
}else{
    $arrReady = array();  
    $eachBook = '"books/'.$whatToSend.'/cover.jpg"';
    $description = file("books/".$whatToSend."/description.txt");
    $info = file("books/".$whatToSend."/info.txt");
    $review = file("books/".$whatToSend."/review.txt");
     
    array_push($arrReady, $eachBook);
    array_push($arrReady, $info);
    array_push($arrReady, $description);
    array_push($arrReady, $review);
    $retString  = stringCreator($arrReady);
    
    echo json_encode($retString);
}

function stringCreator($array) {
    $retString  = "<div class = 'onereview'><img src =";
    $retString .= $array[0].">";
    $details  = "<div class = 'thedetails'>";
    $details .= "<strong>". $array[1][0]."</strong>";
    $details .= "<div>" . $array[1][1]. "</div><br>";
    
    $details .= "<div>" . $array[2][0] . "</div><br>";
    $details .= "<div><strong>" . $array[3][0];
    $starsNumber = (int)($array[3][1]);
    $stars = "";
    while($starsNumber!=0){
        $stars .= "*";
        $starsNumber --;
    }
    $details .= $stars. "</strong></div><div>";
    $details .= $array[3][2]."</div></div>";
            
    return $retString.$details;

}


?> 