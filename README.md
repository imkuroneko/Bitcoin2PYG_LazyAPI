## 💰 Bitcoin2PYG Lazy API [v2.0b]
Script utilizado para obtener la cotización del Bitcoin de los siguientes sitios:
 - Coinbase
 - Bitstamp
 - Blockchain
 - Xapo
 - Bitfinex
 - Bitexla
 - Kraken

La cotización del dolar es tomada de:
 - MaxiCambios

------
#### ¿Por qué Lazy?
Por que obtiene la información únicamente cuando este archivo es ejecutado~

#### ¿Qué mas hace?
Una vez obtenido las cotizaciones, realiza la conversión a PYG y posteriormente toda la información lo guarda en un archivo JSON. Cada vez que este script sea ejecutado, se sobreescribirá el contenido de dicho archivo.

------
#### Cambios sustanciales
> v2.0b
> - [x] Se reescribió por completo el proyecto
> - [x] Se actualizaron los endpoints de los sitios
> - [x] Implementación de GuzzleHTTP para obtener el contenido (en vez de file_get_contents)