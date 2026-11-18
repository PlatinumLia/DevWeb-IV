# FTP / IoT

## Objetivo

Ver como funciona o FTP e IoT usando Arduino

**Tecnologias:**
- Wokwi: Interface de programação online para Arduino
- Alwaysdata: Hospedagem dos dados 

## Fluxo

Usando um ESP32, com um sensor DHT22

Os dados gerados serão registrados

Atraves de uma conexão wifi, os dados serão enviado para o banco via json

No banco firebase, ele serão captura via GET, e salvo atraves do arquivo.php

![ESP32 & DHT22][1]

![Conexões de cabos][2]

[1]:./img/componentes.png
[2]:./img/conexoes.png
