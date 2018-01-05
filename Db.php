<?php
/**
 * Clase para conexion a base de datos con Mysqli
 * Mejora realiazada modificacion del 25/03/2013 cambio de Mysql a Mysqli.
 * Fecha Creacion: 10/04/2012
 * Fecha Modificacion: 25/03/2013
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_DataBase
 */
class DB {

    private $user;
    private $host;
    private $pass;
    private $schema;
    private $link;
    private $query;
    private $die_on_query_error = true;
    private $Log = true;
    private $HtmlError = true;
    private $NewLog = false;
    private $Show_Error = true;
    public $errorNo;
    public $errorMsg;
    /**
     * Toma el valor de resource devuelto por las consultas a la base de datos. 
     * @var resource 
     */
    public $stmt;
    /**
     * Objeto data_set que contiene los data_table que representan los resultados devueltos una ejecucion de query en la base.
     * @var resource 
     */
    private $data_set;
    /**
     *  Nombre del archivo de log de errores.
     * @var string 
     */
    public $name = "Default";
    /**
     * Crea un link de conexion al servidor de base de datos.
     * Conecta mediante la funcion connect().
     * @param string $host El servidor MySQL. También se puede incluir un número de puerto.
     * @param string $user El nombre de usuario. El valor por defecto está definido por mysql.default_user.
     * @param string $pass La contraseña. El valor por defecto está definido por mysql.default_password.
     * @param bool $newLink Si se realiza una segunda llamada a mysql_connect() con los mismos argumentos, 
     * un nuevo enlace no será establecido, pero en su lugar, será devuelto el identificador de enlace del enlace 
     * ya abierto. El parámetro new_link modifica éste comportamiento y hace que mysql_connect() siempre abra un 
     * nuevo enlace, aun si mysql_connect() fue llamada antes con los mismos parámetros. En SQL safe mode, éste 
     * parámetro es ignorado.
     * @param int $flags El parámetro client_flags puede ser una combinación de las siguientes constantes: 128 (habilita el manejo de LOAD DATA LOCAL), MYSQL_CLIENT_SSL, MYSQL_CLIENT_COMPRESS, MYSQL_CLIENT_IGNORE_SPACE o MYSQL_CLIENT_INTERACTIVE. Lea la sección sobre Constantes del cliente MySQL para más información. En SQL safe mode, éste parámetro es ignorado.
     * @return link Devuelve un identificador de enlace de MySQL en caso de éxito o FALSE en caso de error.
     */
    public function __construct($host, $user, $pass) {

        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;

        return $this->connect();
    }
    /**
     * Crea un link de conexion al servidor de base de datos.
     * Uso interno de la clase.
     * @return boolean True si la conexion fue satisfactoria. Die y Muestra errores, si falla.
     * @access private
     */
    private function connect() {
        $this->link = mysqli_connect($this->host, $this->user, $this->pass) or die($this->print_errors());
        //$this->run_queryi("SET NAMES 'utf8'");
        return true;
    }
    /**
     * Selecciona la base de datos en la que se trabajara.
     * @param string $schema Base de datos a la que se desea conectar.
     * @return boolean True si la conexion fue satisfactoria. die y print_errors() si falla.
     */
    public function selectDb($schema) {
        $this->schema = $schema;
        mysqli_select_db($this->link, $this->schema) or die($this->print_errors());
        return true;
    }
    /**
     * Define si se generar un archivo de log nuevo, eliminando el anterior, 
     * o se agregaran los resultados al log existente si lo hubiera.
     * 
     * @param bool $bool Generar un nuevo archivo de log o agregar logs al ya existente.
     */
    public function NewLog($bool) {
        $this->NewLog = $bool;
    }
    /**
     * Define si muestra el error generado en pantalla.
     * @param boll $bool
     */
    public function ShowError($bool){
        $this->Show_Error = $bool;
    }
    /**
     * Define como va a mostrar el error. Texto plano o Html. Por default es Html.
     * 
     * @param bool $bool True: Muestra en pantalla una tabla con errores, false muestra texto plano.
     */
    public function IsHtmlError($bool) {
        $this->HtmlError = $bool;
    }
    /**
     * Imprime en pantalla si se da algun error conectando o ejecutando querys en la base de datos.
     * Si esta habilitada la opcion de loguear, genera un log en logs/Error_mysql.txt
     * @access private
     */
    private function print_errors() {
        
        if ($this->HtmlError) {
            $style = "<style type='text/css'>"
                    . "#mysql_error_table{text-align:left; border: 1px solid black; width:100%;margin:auto;"
                    . "background-color: #F6CECE}"
                    . "#mysql_error_table th{ background-color: #F2F5A9; text-align:center}"
                    . "#mysql_error_table tr{ background-color: #F2F5A9}"
                    . "#mysql_error_table td{ border:1px solid #DDD}"
                    . "</style>";
            $table = "<table id='mysql_error_table'>"
                    . "<tr><th colspan='2'> Error </th></tr>"
                    . "<tr><td> Fecha: </td><td>" . date("D d M Y H:i:s") . "</td></tr>"
                    . "<tr><td> Directorio: </td><td>" . dirname(__FILE__) . "</td></tr>"
                    . "<tr><td> Nro. Error: </td><td>" . mysqli_errno($this->link) . "</td></tr>"
                    . "<tr><td> Descripcion: </td><td>" . mysqli_error($this->link) . "</td></tr>"
                    . "<tr><td> Query: </td><td>" . $this->query . "</td></tr>"
                    . "<tr><td> Ip: </td><td>" . $_SERVER['REMOTE_ADDR'] . "</td></tr>"
                    . "<tr><td> IpHost: </td><td>" . $_SERVER['REMOTE_HOST'] . "</td></tr>"
                    . "<tr><td> User Agent: </td><td>" . $_SERVER['HTTP_USER_AGENT'] . "</td></tr>"
                    . "<tr><td> Accept: </td><td>" . $_SERVER['HTTP_ACCEPT'] . "</td></tr>"
                    . "</table>";
            print $style;
            if($this->Show_Error){
                print $table;
            } else {
                    print "<table id='mysql_error_table'>"
                    . "<tr><th colspan='2'> Error </th></tr>"
                    . "<tr><td> Ha ocurrido un error en la p&aacute;gina."
                    . "Para una mejor experiencia de navegaci&oacute;n recomendamos utilizar Google Chrome, Mozilla Firefox, Opera Browser , Internet explorer 9 &oacute; superior."
                    . "Para continuar recargue la pagina y realice una nueva b&uacute;squeda."
                    . "</td></tr>";
            }
            $this->SendErrorMail($style . $table);
        } else {
            if($this->Show_Error){
                print "Ha ocurrido un error en base de datos. Por favor recarge la p&aacute;gina e intentelo nuevamente";
            }
            $this->SendErrorMail("Ha ocurrido un error en base de datos."
                    . "Fecha: " . date("D d M Y H:i:s")
                    . "\r\nNro. Error: " . mysqli_errno($this->link)
                    . "\r\nDescripcion: " . mysqli_error($this->link)
                    . "\r\nQuery: " . $this->query
                    . "\r\nIP: " . $_SERVER['REMOTE_ADDR']
                    . "\r\nIPHost: " . $_SERVER['REMOTE_HOST']
                    . "\r\nUser Agent: " . $_SERVER['HTTP_USER_AGENT']
                    . "\r\nHttp Accept: " . $_SERVER['HTTP_ACCEPT']);
        }
        if ($this->Log) {
            $this->loguear();
        }
    }
    /**
     * Configura el accionar del objeto ante un error en la query. 
     * 
     * @param boolean $bool true: Para todo e imprime el error. false: continua ejecutando si es posible.
     */
    public function die_on_query_error($bool) {
        $this->die_on_query_error = $bool;
    }
    /**
     * Ejecuta una sentencia en la base de datos y asigna el resultado a $stmt.
     * $stmt es un resource devuelto por mysql_query()
     * Imprime el error en pantalla o loguea directamente, segun configuracion de die_on_query_error
     * @param string $query Consulta a ejecutar en base de datos.
     * @return boolean true si ok, false si error.
     * @deprecated since version 2
     */
    public function run_query($query) {
        $this->query = mysqli_real_escape_string($this->link,$query);
        $this->query = $query;
        if ($this->die_on_query_error) {
            $this->stmt = mysqli_query($this->link, $this->query) or die($this->print_errors());
        } else {
            if (!$this->stmt = mysqli_query($this->link, $this->query)) {
                $this->loguear();
                return false;
            }
        }
        return true;
    }
    /**
     * Retorna el data_set que contiene los data_table.
     * Por ahora retorna un array. Sera modificado a objeto en próxima version.
     * @return array
     */
    public function get_data_set() {
        return $this->data_set;
    }
    /**
     * Retorna el data_table indicado por el parametro $index.
     * Por ahora retorna un array. Sera modificado a objeto en próxima version.
     * @return array
     */
    public function get_data_table($index) {
        if ($this->data_set->count()-1 >= $index)
            return $this->data_set->get_data_table($index);
        else
            return null;
    }
    /**
     * Ejecuta una o varias sentencia en la base de datos, permitiendo obtener como resultado una o mas tablas de resultado.
     * Por cada resultado crea un data_table que lo inserta en $this->data_set.
     * Al mejor estilo maicrochot
     * Imprime el error en pantalla o loguea directamente, segun configuracion de die_on_query_error
     * @param string $query Consulta a ejecutar en base de datos.
     * @return data_set Retorna el data_set, que contiene los data_table obtenidos.
     */
    public function run_queryi($query) {
        $this->query = $query;
        $ds = new data_set();
        if (mysqli_multi_query($this->link, $this->query)) {
            do {
                if ($result = mysqli_store_result($this->link)) {
                    $dt = new data_table();
                    $dt->column_count(mysqli_field_count($this->link));

                    for ($i = 0; $i < $dt->column_count(); $i += 1) {
                        $campo = mysqli_fetch_field_direct($result, $i);
                        $dt->add_column($campo->name);
                    }
                    while ($row = mysqli_fetch_row($result)) {
                        $dt->add_row($row);
                    }
                    $ds->add_data_table($dt);
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($this->link));
            $this->data_set = $ds;
        } else { // Fallo en la ejecucion de la(s) sentencia(s)
            if ($this->die_on_query_error)
                $this->print_errors();
            else
                $this->loguear();
        }
        return $this->data_set;
    }
    /**
     * Convierte el stmt (Tabla MySql devuelta por un select) en una tabla html.
     * De comportamiento dinamico, no es necesario indicar nombres ni cantidad de columnas devueltas.
     * @Param resource $stmt Es un resource devuelto por un mysql_query / execute
     */
    public function QueryToTable($stmt, $id = false) {
        if (!$stmt)
            return ("El parametro 1 debe ser un resource devuelto RunQuery()");
        if ($id)
            $id = "id='$id'";
        if (!$columnas = mysqli_num_fields($stmt)) {
            $this->print_errors(mysqli_error());
        }

        $tabla = "<table $id >";

        for ($i = 0; $i < $columnas; $i += 1) {
            $campo = mysqli_fetch_field_direct($stmt, $i);
            $tabla .= '<th>' . $campo->name . '</th>';
        }

        while ($reg = mysqli_fetch_array($stmt)) {
            $tabla = $tabla . "<tr>";
            for ($c = 0; $c < $columnas; $c++) {
                $tabla = $tabla . "<td>" . $reg[$c] . "</td>";
            }
            $tabla = $tabla . "</tr>";
        }

        $tabla.="</table>";

        return ($tabla);
    }
    /**
     * Convierte el stmt (Tabla MySql devuelta por un select) en un xml.
     * De comportamiento dinamico, no es necesario indicar nombres ni cantidad de columnas devueltas.
     * Crea un Xml solo de tags sin atributos. Genérico. 
     * @Param resource $stmt: es un resource devuelto por un mysql_query / execute
     */
    public function QueryToXml($stmt) {
        if (!$stmt)
            return ("El parametro 1 debe ser un resource devuelto RunQuery()");
        if (!$columnas = mysqli_num_fields($stmt)) {
            $this->print_errors(mysql_error());
        }

        $xml = new DOMDocument("1.0", "utf-8");

        $xml_OutData = $xml->createElement("OutData");

        while ($reg = mysqli_fetch_array($stmt)) {

            $xml_RowData = $xml->createElement("RowData");

            for ($i = 0; $i < $columnas; $i += 1) {
                $campo = mysqli_fetch_field_direct($stmt, $i);

                $xml_Campo = $xml->createElement($campo->name);
                $xml_Campo->appendChild($xml->createTextNode(utf8_encode($reg[$i])));

                $xml_RowData->appendChild($xml_Campo);
            }
            $xml_OutData->appendChild($xml_RowData);
        }
        $xml->appendChild($xml_OutData);
        $xml->formatOutput = true;
        $xml_result = $xml->saveXML();
        return ($xml_result);
    }
    /**
     * Obtiene la cantidad de filas devueltas por la consulta.
     * @return int Cantidad de filas.
     */
    public function numRows() {
        return mysqli_num_rows($this->stmt);
    }
    /**
     * Obtiene el resultado de la consulta. (Tabla MySql)
     * @return resource
     */
    public function fetchAssoc() {
        return mysqli_fetch_assoc($this->stmt);
    }
    /**
     * Obtiene la fila $row del data_table $dt
     * @param $dt Indice del data_table.
     * @param $row Indice de la fila del data_table.
     * @return data_table row
     */
    public function get_row($dt = false, $row = false) {
        if (!$dt) {
            $dt = 0;
            $row = 0;
        }
        $dt = $this->data_set->get_data_table($dt);
        $row = $dt->get_row($row);
        return $row;
    }
    /**
     * Desconecta del servidor.
     * @return boolean true si ok, false si error.
     * @access private
     */
    private function disconnect() {
        return mysql_close($this->link);
    }
    /**
     * Habilita o deshabilita Log de errores. true por Default.
     * @param boolean $bool 
     */
    public function Log($bool) {
        $this->Log = $bool;
    }
    /**
     * Loguea informacion de errores devuletos por el Servidor de BD.
     * @access private
     */
    private function loguear() {
        $this->errorNo = mysqli_errno($this->link);
        $this->errorMsg = mysqli_error($this->link);
        $directorio = str_replace("class", "logs/", dirname(__FILE__));
        $contenido = "Host: " . $this->host . "\r\n"
                . "Db: " . $this->schema . "\r\n"
                . "Query: " . $this->query . "\r\n"
                . "Nro. Error: " . mysqli_errno($this->link) . "\r\n"
                . "Descripcion: " . mysqli_error($this->link) . "\r\n"
                . "IP: " . $_SERVER['REMOTE_ADDR'] . "\r\n"
                . "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n"
                . "-------------------------------------------------";
        if ($this->NewLog) {
            if (is_file($directorio . $this->name . ".txt")) {
                unlink($directorio . $this->name . ".txt");
            }
            $this->NewLog(false);
        };

        $fp = fopen($directorio . $this->name . ".txt", "a+");
        fwrite($fp, "[" . date("Y-m-d H:i:s", time()) . "]\r\n" . utf8_encode($contenido) . "\r\n");
        fclose($fp);
    }
    /**
     * Envia email de errores.
     * @param string $contenido Cuerpo del mensaje
     * @access private
     */
    private function SendErrorMail($contenido) {
        include_once("phpMailer_v2.3/class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'utf-8';
        $mail->Host = Config::EMAIL_HOST;
        $mail->From = Config::EMAIL_FROM;
        $mail->FromName = Config::EMAIL_FROM_NOMBRE;
        $mail->Subject = "Error DB";
        //$Emails = split(';',Config::EMAIL_TO);
        foreach (Config::$FULL_ADDRESSES as $Nombre => $Direccion)
        {
            $mail->AddAddress($Direccion, $Nombre);
        }
        $mail->IsHTML($this->HtmlError);
        $mail->Body = $contenido;
        if (!$mail->Send()) {
            $this->loguear();
        }
    }
}
/**
 * Clase data_table, que representa el resultado de una ejecucion de query en base de datos.
 * Mejora realiazada modificacion del 06/08/2013 incorporación de la funcion get_associative_array();
 * Mejora realiazada modificacion del 26/08/2013 incorporación de la funcion set_item();
 * Fecha Creacion: 25/03/2013
 * Fecha Modificacion: 26/08/2013
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_DataBase
 */
class data_table {

    private $row_count = 0;
    private $column_count;
    private $column_names = array();
    private $rows_data = array();
    /**
     * Convierte todas las filas del data_table en arrays asosciativos.
     * Preparado para convertir en json con json_encode o json_readable_encode.
     * Para PHP version < 4  usar json_readable_decode() para que sea legible, no es nativa. Se encuentra en el fichero Json.php, o bien buscala en internet.
     * Para PHP version >= 4 se puede usar json_decode con $Options-> JSON_PRETTY_PRINT.
     * Cada fila es convertida a: array("NombreColumna N" => "Valor [fila N, columna N]")
     * @return array
     */
    public function to_associative_array()
    {
      $array = array();
      foreach ($this->rows_data as $rowindex => $row) {
        $array_row = array();
        foreach($row as $index => $value){
            $array_row[$this->column_name($index)] = $value;
        }
        $array["Fila " . $rowindex] = $array_row;
        }
      return $array;
    }
    /**
     * Devuelve el nombre de la columna en el indice ·c
     * @param int $c
     * @return string
     */
    public function column_name($c) {
        if (!is_string($c))
            return $this->column_names[$c];
    }
    /**
     * Setea u obtiene el valor de column_count. Cantidad de columnas del data_table.
     * @param int $v
     * @return int 
     */
    public function column_count($v = false) {
        if (!$v)
            return $this->column_count;
        else
            $this->column_count = $v;
    }
    /**
     * Setea u obtiene el valor de row_count. Cantidad de filas del data_table.
     * @param int $v
     * @return int 
     */
    public function row_count($v = false) {
        if (!$v)
            return $this->row_count;
        else
            $this->row_count = $v;
    }
    /**
     * Devuelve todas las filas asociadas al data_table.
     * @return array
     */
    public function get_rows()
     {
            return $this->rows_data;
     }
    /**
     * Devuelve una fila del data table como array.
     * @param int $i Indice de la fila requerida.
     * @return array
     */
    public function get_row($i) {
        return $this->rows_data[$i];
    }
    /**
     * Devuelve una fila del data table como array asociativo.
     * @param int $i Indice de la fila requerida.
     * @return array
     */
    public function get_associative_row($i) {
        $array_row = array();
        foreach($this->rows_data[$i] as $index => $value){
            $array_row[$this->column_name($index)] = $value;
        }
      return $array_row;
    }
    /**
     * Agrega una fila al data_table.
     * @param array $row Array con informacion de la fila.
     */
    public function add_row($row) {
        $this->row_count += 1;
        $this->rows_data[] = $row;
    }
    /**
     * Agrega una columna al data_table.
     * Funciona independientemente de $rows_data, es a modo informativo.
     * @param string $column Nombre de la columna que se agrega.
     */
    public function add_column($column) {
        //$this->column_count += 1;
        $this->column_names[] = $column;
    }
    public function new_column($column) {
        $this->column_count += 1;
        $this->column_names[] = $column;
     for ($i = 0; $i < $this->row_count; $i++)  
     {
         $this->rows_data[$i][] = "";
     }
    }
    /**
     * Obtiene el valor de la Fila r en la Columna c.
     * @param int $c Indice o Nomre de la columna
     * @param int $r Indice de la fila
     * @return mixed Retorna el resultado si existe la posicion pedida, y false si no.
     */
    public function get_item($c, $r) {
        if (is_string($c)) {
            foreach ($this->column_names as $col_key => $name) {
                if ($c == $name) {
                    return $this->get_item($col_key, $r);
                }
            }
        } else {
            foreach ($this->rows_data as $row_k => $row) {
                if ($row_k == $r) {
                    return $row[$c];
                }
            }
            return false;
        }
    }
    /**
     * Setea el valor de la Fila r en la Columna c.
     * @param mixed $v Valor a asignar
     * @param int $c Indice o Nomre de la columna
     * @param int $r Indice de la fila
     * @return mixed Retorna true si existe la posicion pedida, y false si no.
     */
    public function set_item($v, $c, $r) {
        if (is_string($c)) {
            foreach ($this->column_names as $col_key => $name) {
                if ($c == $name) {
                    return $this->set_item($v, $col_key, $r);
                }
            }
        } else {
            foreach ($this->rows_data as $row_k => $row) {
                if ($row_k == $r) {
                    $this->rows_data[$row_k][$c] = $v;
                    return true;
                }
            }
            return false;
        }
    }
}
/**
 * Clase data_set, que representa un conjunto de data_table.
 * Fecha Creacion: 25/03/2013
 * Fecha Modificacion: 25/03/2013
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_DataBase 
 */
class data_set {

    private $data_set_table_count;
    private $data_set_table = array();

    /**
     * Devuelve la cantidad de data_tables del data_set.
     * @return int
     */
    public function count() {
        return $this->data_set_table_count;
    }
    /**
     * Agrega un data_table al data set.
     * @param data_table $dt
     */
    public function add_data_table($dt) {
        $this->data_set_table_count += 1;
        array_push($this->data_set_table, $dt);
    }
    /**
     * Obtiene el data_table $i en el data_set.
     * @param int $i
     * @return data_table
     */
    public function get_data_table($i) {
        return $this->data_set_table[$i];
    }
}
?>
