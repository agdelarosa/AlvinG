<?php

namespace  AlvinG\CustomerApi\Api;

/**
 * Interface CustomerBoughtInterface
 * @package AlvinG\CustomerApi\Api
 * @author Alvin Glenn De La Rosa <alvinglenndelarosa@gmail.com>
 */
interface CustomerBoughtInterface
{
    /**
     * Get lists of product bought by customer
     *
     * @param int $customerId
     * @return mixed
     */
    public function getProductListBoughtByCustomer($customerId);
}