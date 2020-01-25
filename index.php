<?	
	include 'elems/init.php';
	include 'elems/sql.php';
	
	// $_SESSION['auth']= false;
	if(!empty($_SESSION['message']['reg'])) {
		$content = "<p class=\"message_auth\">{$_SESSION['message']['reg']}</p>";
		$_SESSION['message']['reg'] = null;
	} else {
		$content = '';
	}
	

	if(!empty($_SESSION['message']['auth'])) {
		$content = "<p class=\"message_auth\">{$_SESSION['message']['auth']}</p>";
		$_SESSION['message']['auth'] = null;
	} else {
		$content = '';
	}
	
	$content .= '
			<img id="index" src="img/index_.jpg"> 
			<p>
			jas;dflkjasd;flkjasd f;lkajsdf;lkasjdf;laksjdf;alskdjf ;
			</p>
			<p>sd;fkajsdf;laksd sadflkjasd flkasjdf asdkfja;sdlfkjas dfaskdfj;asdlfkjas dflkjasdf a;slkddgsdfgsdfgsdfjasldkjf asdfksdajf;asldkfj asdf;lkjasdf; lkasjdf;asldkfj;a sldkfjas;dlkfjas; dlfjas;dflkjasd;flkjasd f;lkajsdf;lkasjdf;laksjdf;alskdjf ;
			</p>
			<p>sd;fkajsdf;laksd sadflkjasd flkasjdf asdkfja;sdlfkjas dfaskdfj;asdlfkjas dflkjasdf a;slkdfjasldkjfsdfgsdfgsdfg asdfksdajf;asldkfj asdf;lkjasdf; lkasjdf;asldkfj;a sldkfjas;dlkfjas; dlfjas;dflkjasd;flkjasd f;lkajsdf;lkasjdf;laksjdf;alskdjf ;
			</p>
	';
	
	
	$title = 'Купи шлак бай';	
	include 'layout.php';





