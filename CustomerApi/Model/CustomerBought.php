<?php

namespace AlvinG\CustomerApi\Model;

use Magento\Sales\Model\OrderFactory;
use Magento\Catalog\Model\ProductRepository;

/**
 * Interface CustomerBoughtInterface
 * @package AlvinG\CustomerApi\Api
 * @author Alvin Glenn De La Rosa <alvinglenndelarosa@gmail.com>
 */
class CustomerBought implements \AlvinG\CustomerApi\Api\CustomerBoughtInterface
{
    /**
     * @var OrderFactory
     */
    private $order;
    /**
     * @var ProductRepository
     */
    private $product;

    /**
     * CustomerBought constructor.
     * @param OrderFactory $order
     * @param ProductRepository $product
     */
    public function __construct(OrderFactory $order, ProductRepository $product)
    {
        $this->order = $order;
        $this->product = $product;
    }

    /**
     * @param int $customerId
     * @return array|mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductListBoughtByCustomer($customerId)
    {
        $orders = $this->order->create()->getCollection()->addFieldToFilter("customer_id", $customerId);
        $products = [];
        foreach ($orders as $order) {
            foreach ($order->getAllVisibleItems() as $item) {
                $products[] = $item->getProductId();
            }
        }
        $product_list = array_unique($products);
        $productCollection = [];
        foreach ($product_list as $item) {
            $productCollection[] = $this->product->getById($item)->getName();
        }
        return $productCollection;
    }
}