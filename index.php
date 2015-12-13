<?php
	require_once 'Application/Classes/TTAM/Auth/Authenticator.php';
?>

<html>
	<head>
			<script src="https://api.23andme.com/res/js/ttam-0.3.js"></script>
			<script src="Application/js/jquery-2.1.4.js"></script>
			<script src="Application/js/Authenticator.js"></script>
	</head>
	
	<body>
			<div id="connectButton"></div>
			<div id="snpTable"></div>
			
			<script>
			    window.onload = function () {
			        var ttam = TTAM(clientId);
			        ttam.connectButton('connectButton', ['basic']);

			        ttam.snpTable('snpTable', 'rs2476601', {
			            AA: 'Moderately higher odds of developing hypothyroidism.',
			            AG: 'Slightly higher odds of developing hypothyroidism.',
			            GG: 'Typical odds of developing hypothyroidism.',
			            order: 'AA,AG,GG'
			        }, {
			            width: 450
			        });
			    };
			</script>
	</body>
</html>

<?php 
	if (isset($_GET['code'])) {
		route('TTAM', 'Authenticator', 'getToken');
	}
	
	function route($handler, $module, $action) {
		if ($handler == 'TTAM') {
			if ($module == 'Authenticator') {
				$auth = new Authenticator();
				
				if ($action = 'getToken') {
					$authCode = $_GET['code'];
					$data = $auth->getToken($authCode);
				}
			}
		}
	}
?>
