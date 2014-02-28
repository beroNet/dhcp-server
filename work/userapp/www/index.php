<html>
    <head>
        <title>Udhcpd Server</title>
	 <style>
            .area { width: 400px; height: 80px }
        </style>
	<script>

	function resetServer() {
		document.config.server.value=function(){/*
# The start and end of the IP lease block

start           192.168.0.20    #default: 192.168.0.20
end             192.168.0.254   #default: 192.168.0.254


# The interface that udhcpd will use

interface       eth0  
*/}.toString().slice(14,-3);
	}

	</script>
    </head>
    <body>
	
        <?php

	$serverConf = '/usr/conf/userapp/dhcp-server/udhcpd.conf';

	function Read($file){
		echo @file_get_contents($file);
	};

	function Write($file,$type){
		$data = $_POST[$type];
		file_put_contents($file, $data);
	};

	if ($_POST["submit_check"]){
		Write($serverConf, "server");
	};
	
	?>      


        <form name="config" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

	Server Config File:(only needed in server mode)<input type="submit" value="Reset" onclick="resetServer();"><br>
        <textarea class="area" name="server"><?php Read($serverConf); ?></textarea>
	<br>
	<br>
        <input type="submit" name="submit" value="Update"> Files
        <input type="hidden" name="submit_check" value="1">
        </form>

        <form name="restart" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" name="Start" value="start"> DHCP Server
        <input type="submit" name="Stop" value="stop"> DHCP Server 
        </form>

                <?php
        if ($_POST["submit_check"]){
            echo 'Files Updated';
        };

	if ( $_POST['Start'] == "start" ){
            echo 'Starting DHCP Server<br>';
	    system("/apps/dhcp-server/init/S01dhcp-server start >/dev/null");
            echo '<br>DHCP Server started<br>';
        };

	if ( $_POST['Stop'] == "stop" ){
            echo 'Stopping DHCP Server<br>';
	    system("/apps/dhcp-server/init/S01dhcp-server stop >/dev/null");
            echo '<br>DHCP Server stopped<br>';
        };

        ?>      


    </body>
</html>


