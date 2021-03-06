<?php
declare(strict_types=1);

namespace Coolblue\Interview\Repository;

require_once '../src/Entity/ShoppingCart.php';
require_once '../src/Entity/ShoppingCartItem.php';
require_once '../src/Entity/ShoppingCartLine.php';

use Coolblue\Interview\Entity\ShoppingCart;
use Coolblue\Interview\Entity\ShoppingCartItem;
use Coolblue\Interview\Entity\ShoppingCartLine;

class ShoppingCartRepository
{
    /** @var \PDO */
    private $connection;
    private $engine;
    private $dbname = "coolblue";
    private $username = "interview";
    private $password = "interview";

    public function __construct()
    {
        $this->setEngine("mysql");
        $this->connection = new \PDO("$this->engine:host=interview_mysql;dbname=$this->dbname", "$this->username", "$this->password");
    }

    public function setEngine($engine){
        $this->engine = $engine;
    }

    /**
     * @param int $shoppingCartId
     * @return ShoppingCart
     */
    public function getShoppingCart($shoppingCartId): ShoppingCart
    {
        $stmt = $this->connection->prepare("select * from shoppingcart where shoppingcartid = $shoppingCartId");

        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $shoppingCartId = (int) $result['shoppingcartid'];

        return new ShoppingCart(
            $shoppingCartId,
            $this->getLines($shoppingCartId)
        );
    }

    /**
     * @param int $shoppingCartId
     * @return ShoppingCartLine[]
     */
    private function getLines(int $shoppingCartId): array
    {
        $stmt = $this->connection->prepare("select * from shoppingcart_line where shoppingcartid = :shoppingCartId");

        $stmt->execute([
            'shoppingCartId' => $shoppingCartId
        ]);

        $lines = [];

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $lineId = (int) $result['shoppingcartlineid'];
            $items = $this->getItems($lineId);

            $lines[] = new ShoppingCartLine(
                $lineId,
                $items
            );
        }

        return $lines;
    }

    /**
     * @param int $shoppingCartLineId
     * @return ShoppingCartLine[]
     */
    private function getItems(int $shoppingCartLineId): array
    {
        $stmt = $this->connection->prepare("select * from shoppingcart_item where shoppingcartlineid = :shoppingCartLineId");

        $stmt->execute([
            'shoppingCartLineId' => $shoppingCartLineId
        ]);

        $items = [];

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $items[] = new ShoppingCartItem(
                (int) $result['shoppingcartitemid'],
                (int) $result['quantity'],
                (int) $result['unitprice'],
                (string) $result['productname'],
                (string) $result['productclass']
            );
        }

        return $items;
    }
}
