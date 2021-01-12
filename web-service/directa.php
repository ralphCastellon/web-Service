<?php
	include "connection.php";
	global $conn;
	header("Content-Type:application/json");
	if (isset($_GET["ciudad"]) && isset($_GET["mes"])):
		try {
			$nombre = $_GET["ciudad"];
			$mes = $_GET["mes"];
			$query = "select NOMBRE, ? from precipitaciones where NOMBRE = '$nombre'";
			$stm = $conn->prepare($query);
			$stm->bind_param("s",$mes);
			$stm->execute();
			$result = $stm->get_result();;
			$stm->close();
			$response = array();
			while($row = $result->fetch_array()):
				array_push($response, "Nombre: " . $row[0]. " Mes '$mes': ". $row[1]);
			endwhile;
			deliver_response(200, "Mes y ciudad encotrados", $response);
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