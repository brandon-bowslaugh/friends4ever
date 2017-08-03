<?php
class item{
    public $id;
    public $item_name;
    public $paid;
    public $quantity;
}
// paypal requires this
/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/

// send the data to paypal to verify they were the ones that sent the information

header('HTTP/1.1 200 OK');
// store it all for us
/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$ourStuff=[];

foreach($raw_post_array as $val){
    $curVal = substr($val, strpos($val, "=") + 1);   
    $curName = explode("=", $val, 2)[0];
    $ourStuff[$curName] = $curVal;
}
$myPost = [];
/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/
foreach ($raw_post_array as $keyval) {
    $keyval = explode('=', $keyval);
    if (count($keyval) == 2) {
        // Since we do not want the plus in the datetime string to be encoded to a space, we manually encode it.
        if ($keyval[0] == 'payment_date') {
            if (substr_count($keyval[1], '+') === 1) {
                $keyval[1] = str_replace('%2B', '+', $keyval[1]);
            }
        } 
        $myPost[$keyval[0]] = rawurldecode($keyval[1]);
    }
}
/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/


$req = 'cmd=_notify-validate';
/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/
foreach ($myPost as $key => $value) {
    $value = rawurlencode(stripslashes($value));
   	$value = str_replace('%2B', '+', $value);
    $req .= "&$key=$value";
}
/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/
file_put_contents('raw.txt', $raw_post_data);
file_put_contents('req.txt', $req);
file_put_contents('post.txt', $myPost);


/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/
$header = "POST /cgi-bin/webscr/ HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n";
$header .= "Connection: close\r\n\r\n";

/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/


$errno = '';
$errstr = '';
$fh = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
file_put_contents('theurl.txt', $header . $req);
if(!$fh){
	// lost communication with our web server, and cant reach paypal
	file_put_contents('fh.txt', 'fuck');
	exit();
	/*

	                                                                                                                                                                                                                                            
	                                                                                                                                                                                                                                            
	 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
	| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
	| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
	| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
	| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
	| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
	| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
	|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
	                                                                                                                       
	                                                                                                                       
	                                                                                                                       
	                                                                                                                                                                                                                                            
	                                                                                                                                                                                                                                            
	                                                                                                                                                                                                                                            
	                                                                                                                                                                                                                                            
	                                                                                                                                                                                                                                            
	                                                                                                                                                                                                                                            
	                                                                                                                                                                                                                                            

	*/



} else {
	fputs ($fh, $header . $req);
	// testing stuff
	$readresp = stream_get_contents($fh, 5000);
	if (preg_match('/VERIFIED/', $readresp)){

		$checker = 'VERIFIED';
	    
	} else {
		$checker = 'INVALID';
	}
	/*
































	you can touch after here




	*/	
	
		if (strcmp ($checker, "VERIFIED") == 0){
			
			$paymentStatus = $ourStuff['payment_status'];
			if($paymentStatus == 'Completed'){
                include_once('db_connect.php');
				$mcGross = $ourStuff['mc_gross'];
				$txnID = $ourStuff['txn_id'];
				$userID = $ourStuff['custom'];
                $version = $ourStuff['item_number'];
				$verification = 'VERIFIED';
                $payerEmail = str_replace('%40', '@', $ourStuff['payer_email']);
                $first = str_replace('+', ' ', $ourStuff['first_name']);
                $last = str_replace('+', ' ', $ourStuff['last_name']);
                                
				$sql = "SELECT txnID FROM transactions WHERE txnID = '$txnID'";
				$query = mysqli_query($conn, $sql);
				$numrows = mysqli_num_rows($query);
				if($numrows > 0){
					exit();
				}
                
                $date = date('Y-m-d H:i:s');
                if($mcGross != 0.30){ // TODO change for live
                    $sql = "INSERT INTO transactions(txnID, paymentDate, email, amount, userID, verification, paymentStatus) VALUES('$txnID', '$date', '$payerEmail', $mcGross, 0, 'FAILED')";
                    $query = mysqli_query($conn, $sql);
                    exit();
                } else {
                    if($version == 1){
                        $sql = "INSERT INTO transactions(txnID, paymentDate, email, amount, userID, verification, paymentStatus) VALUES('$txnID', '$date', '$payerEmail', $mcGross, $userID, 1, 'PAID')";
                        $query = mysqli_query($conn, $sql);
                        $sql = "INSERT INTO user_account(user_id, account_id) VALUES($userID, 0)"; 
                        $query = mysqli_query($conn, $sql);
                        $date = date('Y-m-d', strtotime("+30 days"));
                        $sql = "INSERT INTO subscription(paid_until, user_id, account_id) VALUES('$date', $userID, 0)";
                        $query = mysqli_query($conn, $sql);
                    } else if($version == 2){
                        $sql = "INSERT INTO transactions(txnID, paymentDate, email, amount, userID, verification, paymentStatus) VALUES('$txnID', '$date', '$payerEmail', $mcGross, $userID, 1, 'PAID')";
                        $query = mysqli_query($conn, $sql);
                        $date = date('Y-m-d H:i:s', strtotime("+30 days"));
                        $sql = "UPDATE subscription SET paid_until='$date' WHERE account_id = $userID";
                        $query = mysqli_query($conn, $sql);
                    } else {
                        file_put_contents('brandon.txt', 'brandon fucked up');
                    }
                }

            
            }

		} else if (strcmp($checker, "INVALID") == 0){
			include_once('db_connect.php');
			$paymentDate = $ourStuff['payment_date'];
			$payerEmail = $ourStuff['payer_email'];
			$mcGross = $ourStuff['mc_gross'];
			$txnID = $ourStuff['txn_id'];
			$userID = $ourStuff['custom'];
			$verification = 'INVALID';
			
			$sql = "INSERT INTO transactions(paymentDate, payerEmail, mcGross, txnID, userID, verification, paymentStatus) VALUES('$paymentDate', '$payerEmail', $mcGross, '$txnID', $userID, 0, 'INVALID')";
            $query = mysqli_query($conn, $sql);
		} else {
			
			// they shouldnt be here

			/*

				you can code up to here






























			




			*/
/*

                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
 /$$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$$       /$$$$$$$$ /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$       /$$$$$$ /$$$$$$$$
| $$__  $$ /$$__  $$| $$$ | $$|__  $$__/      |__  $$__//$$__  $$| $$  | $$ /$$__  $$| $$  | $$      |_  $$_/|__  $$__/
| $$  \ $$| $$  \ $$| $$$$| $$   | $$            | $$  | $$  \ $$| $$  | $$| $$  \__/| $$  | $$        | $$     | $$   
| $$  | $$| $$  | $$| $$ $$ $$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$$$$$$$        | $$     | $$   
| $$  | $$| $$  | $$| $$  $$$$   | $$            | $$  | $$  | $$| $$  | $$| $$      | $$__  $$        | $$     | $$   
| $$  | $$| $$  | $$| $$\  $$$   | $$            | $$  | $$  | $$| $$  | $$| $$    $$| $$  | $$        | $$     | $$   
| $$$$$$$/|  $$$$$$/| $$ \  $$   | $$            | $$  |  $$$$$$/|  $$$$$$/|  $$$$$$/| $$  | $$       /$$$$$$   | $$   
|_______/  \______/ |__/  \__/   |__/            |__/   \______/  \______/  \______/ |__/  |__/      |______/   |__/   
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                            

*/
			fclose($fh);
			exit();
		}

			// if we dont get in here then paypal never sent us this information
			//if(strcmp($res, 'VERIFIED') == 0){
				
				//file_put_contents('paypalData.txt', $fullText);
				
			//} //else if ($strcmp($res, 'INVALID') == 0){
				//file_put_contents('wefuckedup.txt', 'fuck');
		//}
	
	
	fclose($fh);
}



?>