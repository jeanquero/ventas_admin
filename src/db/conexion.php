<?php
class MysqlDB
{
    private $host = "localhost:3307";
    private $usuario ="root";
    private $pass ="root";
    private $db ="ventas4";


    private $connection;

    public function connect()
    {
        $this->connection = mysqli_connect(
            $this->host,
            $this->usuario,
            $this->pass,
            $this->db
        );
        try {
            $this->connection->set_charset("utf8");
        } catch (Exception $e) {
            print("error al conectarse");
        }


        if (mysqli_connect_errno()) {
            print("error al conectarse");
        }
    }

    public function getConnect() {
        return $this->connection;
    }

    /**
     * @param $sql
     * @return array
     * @throws Exception
     */
    public function getData($sql): array
    {
        $data = array();
        $result = mysqli_query($this->connection, $sql);

        $error = mysqli_error($this->connection);

        if (empty($error)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data, $row);
                }
            }
        } else {
            throw new UnexpectedValueException($error);
        }
        return $data;
    }

    /**
     * @throws Exception
     */
    public function numRows($sql): int
    {
        $result = mysqli_query($this->connection, $sql);
        $error = mysqli_error($this->connection);

        if (empty($error)) {
            return mysqli_num_rows($result);
        } else {
            throw new UnexpectedValueException($error);
        }
    }

    /**
     * @throws Exception
     */
    public function getDataSingle($sql)
    {
        $result = mysqli_query($this->connection, $sql);

        $error = mysqli_error($this->connection);

        if (empty($error)) {
            if (mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            }
        } else {
            throw new UnexpectedValueException($error);
        }
        return null;
    }


    /**
     * @throws Exception
     */
    public function executeInstruction($sql)
    {
        $success = mysqli_query($this->connection, $sql);

        $error = mysqli_error($this->connection);

        if (empty($error)) {
            return $success;
        } else {
            throw new UnexpectedValueException($error);
        }
    }

    public function close()
    {
        mysqli_close($this->connection);
    }

    public function getLastId()
    {
        return mysqli_insert_id($this->connection);
    }
}

/* Probar conexion */
/*
$conex = new MysqlDB();
$conex->connect();
$consulta = [];
$sql = "SELECT * FROM persona";
$conex->connect();

try {
    $consulta = $conex->getDataSingle($sql);
} catch (Exception $e) {
    print $e;
}
print_r($consulta);*/
