<?php
	include "connection.php";
	global $conn;
	header("Content-Type:application/json");
	if (isset($_GET["mes"])):
		try {
			$mes = $_GET["mes"];
			$query = "select NOMBRE, '$mes' from precipitaciones";
			$result = $conn->query($query);
			$response;
			while($row = $result->fetch_assoc()):
				$response += "Nombre: " . $row[0]. " Mes: ". $row[1];
			endwhile;
			deliver_response(200, "Mes encotrada", $response);
		} catch (mysqli_sql_exception $e) {
			echo $e->getMessage();
		} finally {
			$conn->close();
		}
	endif;
	
	 function deliver_response($status, $status_message, $data) {
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_message'] = $status_message;
        $response['data'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
    }