<?php
	include "connection.php";
	global $conn;
	header("Content-Type:application/json");
	//echo "no hay get";
	if (isset($_GET["ciudad"])):
		try {
			$nombre = $_GET["ciudad"];
			$query = "select * from precipitaciones where NOMBRE = '$nombre'";
			$result = $conn->query($query);
			$response;
			$row = $result->fetch_assoc();
				$response = "Nombre: " . $row["NOMBRE"]. " Enero: ". $row["ENE"]. " Febrero: " . $row["FEB"]." Marzo: " . $row["MAR"]. " Abril: " . $row["ABR"].
				" Mayo: " . $row["MAY"]. " Junio: " . $row["JUN"]. " Julio: " . $row["JUL"]. " Agosto: " . $row["AGO"]. " Septiembre: " . $row["SEP"]. " Octubre: " . $row["OCT"].
				" Noviembre: " . $row["NOV"]. " Diciembre: " . $row["DIC"];
			 deliver_response(200, "Ciudad encotrada", $response);
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