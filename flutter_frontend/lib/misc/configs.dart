/// Esta constante contém o indereço IP da sua máquina, por favor trocar caso
/// estiver em uma máquina diferente.
const hostIpAddress = '192.168.1.69';
const laravelPort = '8000';

/// Indereço onde o servidor laravel deve estar executando
const ipAddress = 'http://$hostIpAddress:$laravelPort';

/** NOTE:
 * O IP tem de ser definido numa constante pois caso se queira testar a aplicação no celular,
 * isso vai garantir acesso do celular ao servidor Laravel se o computador e o celular
 * estiverem conectados na mesma rede Wifi.
 */