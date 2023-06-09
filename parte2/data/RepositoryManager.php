<?php
namespace data;

use data\Operatori\OperatoreRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class RepositoryManager
{
    private $entityManager;

    function __construct()
    {
        $path = __ROOT_DIR__ . "/data";

        $config = ORMSetup::createAnnotationMetadataConfiguration([$path], __DEBUG__);
        $config->setProxyDir(__ROOT_DIR__ . "/data/proxies");
        $config->setProxyNamespace("data\proxies");
        $config->setAutoGenerateProxyClasses(true);

        $dbParams = getDbParams();

        $connectionParams = [
            "dbname" => $dbParams["dbname"],
            //Environment::getDbName(),
            "user" => $dbParams["username"],
            //Environment::getDbUser(),
            "password" => $dbParams["password"],
            //Environment::getDbPwd(),
            "charset" => "utf8mb4",
            "driver" => "pdo_mysql"
        ];

        $host = $dbParams["servername"]; //Environment::getDbHost();
        $port = $dbParams["serverport"]; //Environment::getDbPort();
        $unixSocket = $dbParams["unixsocket"]; //Environment::getDbUnixSocket();

        // if (!Strings::isNullOrEmpty($host)) {
        //     $connectionParams["host"] = $host;
        // }
        $connectionParams["host"] = $host;

        // if (!Strings::isNullOrEmpty($port)) {
        //     $connectionParams["port"] = $port;
        // }
        $connectionParams["port"] = $port;

        // if (!Strings::isNullOrEmpty($unixSocket)) {
        //     $connectionParams["unix_socket"] = $unixSocket;
        // }
        $connectionParams["unix_socket"] = $unixSocket;

        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

        $this->entityManager = EntityManager::create($conn, $config);
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function getRepOperatori(): OperatoreRepository
    {
        return new OperatoreRepository($this);
    }

    public function flushData()
    {
        $this->entityManager->flush();
    }
}