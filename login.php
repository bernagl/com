<?php


function req($xml){
    $URL = "http://64.251.10.6/Tintowin_WS/Tintowin_WS.asmx";
    $ch = curl_init($URL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function login($user, $password){
$llave = 'RmprD-2A4pm-s.q5H-27QPu-mdKrs-4w7yA-80Q5q-2YQNc-bdxly-4S53A-l.Q56-.uJdu-5doSK-4t7pA-n095W-uyQDr';    
$xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <WSLoginUsuario xmlns="HSI">
            <llave>'.$llave.'</llave>
            <usuario>'.$user.'</usuario>
            <password>'.$password.'</password>
        </WSLoginUsuario>
    </soap:Body>
</soap:Envelope>';

return req($xml);
}

function WsEstadoCtaCliente($uid, $meses){
$llave = 'RmprD-2A4pm-s.q5H-27QPu-mdKrs-4w7yA-80Q5q-2YQNc-bdxly-4S53A-l.Q56-.uJdu-5doSK-4t7pA-n095W-uyQDr';
$xml = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <WsEstadoCtaCliente xmlns="HSI">
            <llave>'.$llave.'</llave>
            <id_usuario>2733E17A-F5E</id_usuario>
            <solo_ultimos_meses>'.$meses.'</solo_ultimos_meses>
        </WsEstadoCtaCliente>
    </soap:Body>
</soap:Envelope>';

return req($xml);
}

function WsTicketsCliente($uid){
$llave = 'RmprD-2A4pm-s.q5H-27QPu-mdKrs-4w7yA-80Q5q-2YQNc-bdxly-4S53A-l.Q56-.uJdu-5doSK-4t7pA-n095W-uyQDr';
$xml = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <WsTicketsCliente xmlns="HSI">
            <llave>'.$llave.'</llave>
            <id_usuario>'.$uid.'</id_usuario>
            <modalidad>3</modalidad>
            <desde_año>2019</desde_año>
            <desde_mes>01</desde_mes>
            <hasta_año>2020</hasta_año>
            <hasta_mes>01</hasta_mes>
        </WsTicketsCliente>
    </soap:Body>
</soap:Envelope>';
return req($xml);
}

function DatosCliente($uid) {
$llave = 'RmprD-2A4pm-s.q5H-27QPu-mdKrs-4w7yA-80Q5q-2YQNc-bdxly-4S53A-l.Q56-.uJdu-5doSK-4t7pA-n095W-uyQDr';
$xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <WsDatosCliente xmlns="HSI">
            <llave>'.$llave.'</llave>
            <id_usuario>'.$uid.'</id_usuario>
            <modalidad>1</modalidad>
            <email></email>
        </WsDatosCliente>
    </soap:Body>
</soap:Envelope>';
return req($xml);
}

function TicketPDF($uid, $idTicket){
$llave = 'RmprD-2A4pm-s.q5H-27QPu-mdKrs-4w7yA-80Q5q-2YQNc-bdxly-4S53A-l.Q56-.uJdu-5doSK-4t7pA-n095W-uyQDr';
$xml = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
        <WsTicketPDF xmlns="HSI">
          <llave>'.$llave.'</llave>
          <id_usuario>'.$uid.'</id_usuario>
          <id_ticket>'.$idTicket.'</id_ticket>
        </WsTicketPDF>
      </soap:Body>
    </soap:Envelope>';
    return req($xml);
}

function Factura($uid, $idTicket){
    $llave = 'RmprD-2A4pm-s.q5H-27QPu-mdKrs-4w7yA-80Q5q-2YQNc-bdxly-4S53A-l.Q56-.uJdu-5doSK-4t7pA-n095W-uyQDr';
    $xml = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
        <WsFactura xmlns="HSI">
            <llave>'.$llave.'</llave>
            <id_usuario>'.$uid.'</id_usuario>
            <id_tickets>'.$idTicket.'</id_tickets>
        </WsFactura>
      </soap:Body>
    </soap:Envelope>';
    return req($xml);
    }
    
session_start();
$data = $_POST['data'];
$uid = $_SESSION['uid'];
switch($_POST['exec']) {
case "login":
$result = login($data['user'], $data['password']);
echo $result;
break;
case "WsEstadoCtaCliente":
$result = WsEstadoCtaCliente($uid, $data['meses'] || 5);
echo $result;
case "setLogin": $_SESSION['uid'] = $data['uid']; break;
case "WsTicketsCliente":
$resultt = WsTicketsCliente($uid);
echo $resultt; break;
case "DatosCliente":
$result = DatosCliente($uid);
echo $result; break;
case "TicketPDF":
$idTicket = $data['idTicket'];
$result = TicketPDF('A8BF0CE8-056',$idTicket);
echo $result; break;
case "Factura":
$idTicket = $data['idTicket'];
$result = Factura('A8BF0CE8-056',$idTicket);
echo $result; break;
case "xmlEstadoCliente": break;
}
?>