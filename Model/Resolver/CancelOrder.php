<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\CancelOrderGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\GraphQl\Model\Query\ContextInterface;
use Lof\CancelOrder\Api\CancelOrderManagementInterface;

/**
 * CancelOrder data reslover
 */
class CancelOrder implements ResolverInterface
{

    /**
     * @var CancelOrderManagementInterface
     */
    private $repository;

    /**
     * @param CancelOrderManagementInterface $repository
     */
    public function __construct(
        CancelOrderManagementInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {        
        if (false === $context->getExtensionAttributes()->getIsCustomer() && !$enabled_guest_api) {
            throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
        }
        $order_id = isset($args["order_id"])?trim($args["order_id"]):"";
        $customer_id = 0;
        if(false !== $context->getExtensionAttributes()->getIsCustomer()){
            $customer_id = $context->getUserId();
        }
        
        $cancelOrder = $this->repository->cancelOrder($customer_id, $order_id);
        return $cancelOrder;
    }
}
