<?php

require_once "../modelos/ubigeos.modelo.php";

//=========================================================================================
// PETICIONES POST
//=========================================================================================
if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {

        case 'obtener_departamentos':

            $response = UbigeosModelo::mdlObtenerDepartamentos();
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;


        case 'obtener_municipios':

            $response = UbigeosModelo::mdlObtenerMunicipiosPorDepartamento($_POST["id_filtro"]);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;


        case 'obtener_ubigeo':

            $response = UbigeosModelo::mdlObtenerUbigeoPorDepMun($_POST["departamento"], $_POST["municipio"]);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;
    }
}
