<?php
$llave = 'RmprD-2A4pm-s.q5H-27QPu-mdKrs-4w7yA-80Q5q-2YQNc-bdxly-4S53A-l.Q56-.uJdu-5doSK-4t7pA-n095W-uyQDr';
$xml_data = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <WSLoginUsuario xmlns="HSI">
      <llave>'.$llave.'</llave>
      <usuario>Mobkii</usuario>
      <password>MobkiiTinto!</password>
    </WSLoginUsuario>
  </soap:Body>
</soap:Envelope>';
$URL = "http://64.251.10.6/Tintowin_WS/Tintowin_WS.asmx";

$xml_dafta = '
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <WSAltaModificaUsuario xmlns="HSI">
      <llave>'.$llave.'</llave>
      <usuario>Mobkii</usuario>
      <password>MobkiiTinto!</password>
      <codigo_cliente>7786</codigo_cliente>
      <folio_ticket>10178678</folio_ticket>
      <monto_total_ticket>304.00</monto_total_ticket>
      <prendas_totales_ticket>5</prendas_totales_ticket>
    </WSAltaModificaUsuario>
  </soap:Body>
</soap:Envelope>';

$xmlDatosCliente = '
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <WsDatosCliente xmlns="HSI">
      <llave>'.$llave.'</llave>
      <id_usuario>A8BF0CE8-056</id_usuario>
      <modalidad>1</modalidad>
      <email></email>
    </WsDatosCliente>
  </soap:Body>
</soap:Envelope>';

$xmlEstadoCliente = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <WsEstadoCtaCliente xmlns="HSI">
      <llave>'.$llave.'</llave>
      <id_usuario>A8BF0CE8-056</id_usuario>
      <solo_ultimos_meses>5</solo_ultimos_meses>
    </WsEstadoCtaCliente>
  </soap:Body>
</soap:Envelope>';

$xmlWsTicketsCliente = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <WsTicketsCliente xmlns="HSI">
    <llave>'.$llave.'</llave>
    <id_usuario>A8BF0CE8-056</id_usuario>
    <modalidad>3</modalidad>
    <desde_año>2018</desde_año>
    <desde_mes>01</desde_mes>
    <hasta_año>2019</hasta_año>
    <hasta_mes>01</hasta_mes>
    </WsTicketsCliente>
  </soap:Body>
</soap:Envelope>';

$wstc = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>s
    <WsTicketsCliente xmlns="HSI">
      <llave>'.$llave.'</llave>
      <id_usuario>A8BF0CE8-056</id_usuario>
      <modalidad>3</modalidad>
      <desde_año>2018</desde_año>
      <desde_mes>01</desde_mes>
      <hasta_año>2019</hasta_año>
      <hasta_mes>01</hasta_mes>
    </WsTicketsCliente>
  </soap:Body>
</soap:Envelope>';

$WsTicketPDF = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <WsTicketPDF xmlns="HSI">
      <llave>'.$llave.'</llave>
      <id_usuario>A8BF0CE8-056</id_usuario>
      <id_ticket>10178614</id_ticket>
    </WsTicketPDF>
  </soap:Body>
</soap:Envelope>';

$ch = curl_init($URL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlWsTicketsCliente");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);


print_r($output);