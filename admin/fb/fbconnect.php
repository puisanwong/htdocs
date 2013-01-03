<?php
if(!isset($_SESSION['user']))
{
	//Application Configurations
	$app_id		= "501886946523321";
	$app_secret	= "6d571e52bb5e871ed2b7c088800351f5";
	$site_url	= "https://www.facebook.com/appcenter/comopcupcake";

	try{
		include_once "src/facebook.php";
	}catch(Exception $e){
		error_log($e);
	}
	// Create our application instance
	$facebook = new Facebook(array(
		'appId'		=> $app_id,
		'secret'	=> $app_secret,
		));

	// Get User ID
	$user = $facebook->getUser();
	// We may or may not have this data based 
	// on whether the user is logged in.
	// If we have a $user id here, it means we know 
	// the user is logged into
	// Facebook, but we don’t know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	//print_r($user);
	if($user){
		// Get logout URL
		$logoutUrl = $facebook->getLogoutUrl();
	}else{
		// Get login URL
		$loginUrl = $facebook->getLoginUrl(array(
			'scope'			=> 'read_stream, publish_stream, email, user_about_me',
			'redirect_uri'	=> $site_url,
			));
	}

	if($user){

		try{
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
		//Connecting to the database. You would need to make the required changes in the common.php file
		//In the common.php file you would need to add your Hostname, username, password and database name!
		mysqlc();
		
		$name = GetSQLValueString($user_profile['name'], "text");
		$email = GetSQLValueString($user_profile['email'], "text");
		$gender = GetSQLValueString($user_profile['gender'], "text");
		$bio = GetSQLValueString($user_profile['bio'], "text");
		$query = sprintf("SELECT * FROM newmember WHERE email = %s",$email);
		$res = mysql_query($query) or die('Query failed: ' . mysql_error() . "<br />\n$sql");
		if(mysql_num_rows($res) == 0)
		{
			$iquery = sprintf("INSERT INTO newmember values('',%s,%s,%s,%s,'yes')",$name,$email,$gender,$bio);
			$ires = mysql_query($iquery) or die('Query failed: ' . mysql_error() . "<br />\n$sql");
			$_SESSION['user'] = $user_profile['email'];
			$_SESSION['id'] = $user_profile['id'];
		}
		else
		{
			$row = mysql_fetch_array($res);
			$_SESSION['user'] = $row['email'];
			$_SESSION['id'] = $user_profile['id'];
		}
		}catch(FacebookApiException $e){
				error_log($e);
				$user = NULL;
			}
		
	}
}
?>