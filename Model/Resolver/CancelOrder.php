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
use Lof\CancelOrder\Api\CancelOrderManagementInterface;

/**
 * CancelOrder data resolver
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
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return bool|\Magento\Framework\GraphQl\Query\Resolver\Value|mixed|string
     * @throws GraphQlAuthorizationException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (false === $context->getExtensionAttributes()->getIsCustomer()) {
            throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
        }
        if (!isset($args["order_id"])) {
            throw new GraphQlInputException(__("'order_id' input argument is required."));
        }
        if (!isset($args["customer_comment"])) {
            throw new GraphQlInputException(__("'customer_comment' input argument is required."));
        }
        $customer_id = 0;
        if(false !== $context->getExtensionAttributes()->getIsCustomer()){
            $customer_id = $context->getUserId();
        }
        $order = $this->repository->cancelOrder($customer_id, $args["order_id"],$args["customer_comment"]);

        return $order;
    }
}
