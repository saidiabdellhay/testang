<script type="text/javascript">
 /* var myDate = new Date(30600);
  console.log(myDate);*/
</script>

<?php

/*$dt = new DateTime("2017-07-13 19:38:39");
$date = $dt->format('Y-m-d');
$time = strtotime($date);
echo date('d/m/Y', strtotime('+1 months',$time));*/

//echo date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."+2 days"));

$villes = array("Agadir", "Assilah","Casablanca", "Meknes","El Jadida", "Fes",
                "Kenitra", "Larache","Marrakech", "Mohammedia",
                "Rabat", "Sala Al Jadida","Sale", "Settat",
                "Tanger", "Temara");

echo in_array("Agadir",$villes);
 
  /*echo $today = date("ymd");*/
  // Date d'aujourd'hui
 // $today = new DateTime(date('Y-m-d'));
  
 // echo  $token = bin2hex(openssl_random_pseudo_bytes(32));
  /*echo $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +3 months"));*/

 //echo bin2hex(openssl_random_pseudo_bytes(4))

  /*echo " ". date("Y-m-d H:i:s")<$newTime;*/
  //echo date("Ymd");
  
  /*$today2 = new DateTime(date('Y-m-d'));*/

/*echo date('d/m/Y', strtotime('+1 months'));*/

/*$gsm1 = '0656011827';
$regex = '/(\\d{2})(\\d{2})(\\d{2})(\\d{2})(\\d{2})/';
 $gsm2 = preg_replace($regex, '$1 $2 $3 $4 $5', $gsm1);
 $gsm3 = preg_replace($regex, '$1.$2.$3.$4.$5', $gsm1);
echo $gsm4 = substr($gsm2, 1);*/
 /* $today = new DateTime('2017-6-13');
  $naissance =  new DateTime('2016-11-09');


  $interval = date_diff($today, $naissance);


  $diffJours =  $interval->format('%R%a jours ');

  if($diffJours>=7 && $diffJours<=146){
      echo "box1 :".$diffJours;
  }
  else if($diffJours<=-7 && $diffJours>=-122){
      echo "box2 : ".$diffJours;
  }
  else if($diffJours<=-183 && $diffJours>=-305){
      echo "box3 : ".$diffJours;  
  }else{

    echo $diffJours."aucune box <br/> ";
  }*/

  /*$today = date("dmY");
  echo $today."OX"."1";
*/
/*  include('config.php');
  $product['id_box']=3;
  $idProduct = addProduct2($product['id_box']);
  echo $idProduct;*/

 
/*  //Ajout de 3 mois sur la date d'aujourd'hui
    $dateInThreeMonth = $today->add(new DateInterval('P3M'));
*/
/*
  $khalid['a']="b";
  $khalid['b']="c";
  echo json_encode($khalid);*/



/*  require_once('Logging.php');

  $log = new Logging();

  // set path and name of log file (optional)
  $log->lfile('mylog.txt');

  // write message to the log file
  $log->lwrite('Test message1');
  $log->lwrite('Test message2');
  $log->lwrite('Test message3');

  // close log file
  $log->lclose();
  */

  /*require('tools/mailin.php');
    $mailin = new Mailin("https://api.sendinblue.com/v2.0","YUAxmzIyZSO4EJw9");
    $data = array( "email" => "salimelqalbfz@gmail.com","listid" => array(34));
  var_dump($mailin->get_user($data));*/


  


 /* require('tools/mailin.php');
    $mailin = new Mailin("https://api.sendinblue.com/v2.0","YUAxmzIyZSO4EJw9");
  $data = array( "email" => "khalid.essalhi8@gmail.com",
        "attributes" => array("GYNECO"=>"none"),
        "listid" => array(34)
    ); 
    var_dump($mailin->create_update_user($data));*/

  
/*  function notification_email ($data){
    
        $semi_rand = md5(time());
        $mime_boundary = "Oumbx_Mpart_Bound_x{$semi_rand}x";
        $headers= "Sender: khalid.essalhi8@gmail.com\n";
//      $headers.= "Return-Path: lead@dclabs.fr\n";
        $headers.= "From: khalid.essalhi8@gmail.com\n";

        $headers .= "MIME-Version: 1.0\n" .
             "Content-Type: text/html; charset=UTF-8;format=flowed\n" .
                 "Content-Transfer-Encoding: 8bit\n".
                                 "X-Mailer: PHP\n".
                                 " boundary=\"{$mime_boundary}\"";
        $message="<html><table>";
       foreach ($data as $key => $value) {
        $message.="<tr><td>".$key."</td><td>".$value."</td></tr>";
    }
        $message.="</table></html>";
  
    $subj = "[Formulaire CSS] Nouvelle inscription";
    $to ="khalid.essalhi8@gmail.com,khalid.essalhi8@gmail.com,khalid.essalhi8@gmail.com";
    $ok = mail($to, $subj, $message, $headers);
    return $ok;
}

  $data["nom"]="khalid";
  notification_email($data);*/

  /*$emailFrom = "khalid.essalhi8@gmail.com"; // match this to the domain you are sending email from
$email = "khalid.essalhi8@gmail.com";
$subject = "Email Request";
$headers = 'From:' . 'khalid' . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Return-path: " . $email;
$message = "Your password is ".'password'.".";
mail($email, $subject, $message, $headers);*/
?>
<!-- <!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

      function initMap() {
        var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBrZqwoiE2SFo32PmyTGZo3D-jvfw5Y10&callback=initMap">
    </script>
  </body>
</html>



</script>
</body>
</html> -->
<?php 
/*$id = intval(base64_decode('MjQ5'));
echo $id;*/

/*validateByEmail("khalid",111);

function validateByEmail($email,$id){

   try {
$myId=base64_encode($id);
$message = <<<EOT
'<html>
    <head>
        <title>Email Verification</title>
    </head>
    <body>
        <h1>Hi ESSALHI!</h1>
        <p><a href="oumtest.k4mshost.odns.fr/activate.php?id=$myId">CLICK TO ACTIVATE YOUR ACCOUNT</a>
    </body>
</html>'        
EOT;

echo $message;

        $semi_rand = md5(time());
        $mime_boundary = "Oumbx_Mpart_Bound_x{$semi_rand}x";
        $headers= "Sender: khalid.essalhi8@gmail.com\n";
//      $headers.= "Return-Path: lead@dclabs.fr\n";
        $headers.= "From: khalid.essalhi8@gmail.com\n";

        $headers .= "MIME-Version: 1.0\n" .
             "Content-Type: text/html; charset=UTF-8;format=flowed\n" .
                 "Content-Transfer-Encoding: 8bit\n".
                                 "X-Mailer: PHP\n".
                                 " boundary=\"{$mime_boundary}\"";
  
        $subj = "Confirmation du mot de passe";
        $to ="khalid.essalhi8@gmail.com";
        $ok = mail($to, $subj, $message, $headers);
        return $ok;
    } catch (Exception $ex) {
      echo $msg = $ex->getMessage();
    }
}*/




/*echo secondsToTime(70200);
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%hH%I');
}*/
 ?>




 <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="oumdev_leads";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
   
}
getAllRelais($conn);
function getAllRelais($conn){
  $villes = array("AGADIR", "ASSILAH","CASABLANCA", "HAYSTACK","HAYSTACK", "HAYSTACK",
                "KENITRA", "LARACHE","MARRAKECH", "MOHAMMEDIA",
                "RABAT", "SALA AL JADIDA","SALE", "SETTAT",
                "TANGER", "TEMARA");
  try
       {
          $stmt = $conn->prepare("SELECT r.*,v.name FROM relais r INNER JOIN ville v ON v.id=r.id_ville");
          $stmt->execute();
          $relais = array();
          if ($stmt->execute()) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  if(in_array(strtoupper($row['name']), $villes)){
                    $row['prix']=25; 
                  }else{
                    $row['prix']=30;
                  }
                  print_r( $row);
                  $relais[] = $row;

              }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
       return  $relais;
}



 ?>
