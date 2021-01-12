<?php
	include "connection.php";
	global $conn;
	header("Content-Type:application/json");
	//echo "no hay get";
	if (isset($_GET["anual"])):
		try {
			$anual = $_GET["anual"];
			$query = "select NOMBRE, ANUAL from precipitaciones";
			$result = $conn->query($query);
			$response = array();
			while($row = $result->fetch_array()):
				array_push($response, "Nombre: " . $row[0]. " ANUAL: ". $row[1]);
			endwhile;
			deliver_response(200, "Anual encotrada", $response);
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