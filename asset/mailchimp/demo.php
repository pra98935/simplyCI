
<?php
require_once 'MCAPI.class.php';
$apikey='93c77a576d8de071c33fae46ecd70735-us11'; // Enter your MailChimp API key here
$api = new MCAPI($apikey);
$retval = $api->lists();

foreach ($retval['data'] as $list){
echo $list['name']; echo "&nbsp"; echo "&nbsp"; echo "&nbsp"; echo "&nbsp"; echo "&nbsp";
echo $list['id'];
echo "<br />";
}
?>


<?php
require_once 'MCAPI.class.php';
$apikey='93c77a576d8de071c33fae46ecd70735-us11'; // Enter your API key
$api = new MCAPI($apikey);
$retval = $api->lists();
$listid='adfab85044'; // Enter list Id here
$email='asharma.ror123@gmail.com'; // Enter subscriber email address
$name='Ashish'; // Enter subscriber first name
$lname='Sharma'; // Enter subscriber last name

// By default this sends a confirmation email - you will not see new members
// until the link contained in it is clicked!

$merge_vars = array('FNAME' => $name, 'LNAME' => $lname);
if($api->listSubscribe($listid, $email,$merge_vars) === true) {
echo 'success';
}
?>
