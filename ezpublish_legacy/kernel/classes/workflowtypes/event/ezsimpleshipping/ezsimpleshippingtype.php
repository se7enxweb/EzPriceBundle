<?php
/**
 * File containing the eZSimpleShippingType class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZSimpleShippingType ezsimpleshippingtype.php
  \brief The class eZSimpleShippingType handles adding shipping cost to an order

*/
class eZSimpleShippingType extends eZWorkflowEventType
{
    const WORKFLOW_TYPE_STRING = 'ezsimpleshipping';

    /*!
     Constructor
    */
    function eZSimpleShippingType()
    {
        $this->eZWorkflowEventType( eZSimpleShippingType::WORKFLOW_TYPE_STRING, ezpI18n::tr( 'kernel/workflow/event', "Simple shipping" ) );
        $this->setTriggerTypes( array( 'shop' => array( 'confirmorder' => array ( 'before' ) ) ) );
    }

    function execute( $process, $event )
    {
        $ini = eZINI::instance( 'workflow.ini' );

        $cost = $ini->variable( "SimpleShippingWorkflow", "ShippingCost" );
        $description = $ini->variable( "SimpleShippingWorkflow", "ShippingDescription" );

        $parameters = $process->attribute( 'parameter_list' );

        if ( isset( $parameters['order_id'] ) )
        {
            $orderID = $parameters['order_id'];

            $order = eZOrder::fetch( $orderID );
            $orderItems = $order->attribute( 'order_items' );
            $addShipping = true;
            foreach ( $orderItems as $orderItem )
            {
                if ( $orderItem->attribute( 'type' ) == 'ezsimpleshipping' )
                {
                    $addShipping = false;
                    break;
                }
            }
            if ( $addShipping )
            {
                $productCollection = $order->attribute( 'productcollection' );
                $orderCurrency = $productCollection->attribute( 'currency_code' );

                $cost = eZShopFunctions::convertAdditionalPrice( $orderCurrency, $cost );

                $orderItem = new eZOrderItem( array( 'order_id' => $orderID,
                                                     'description' => $description,
                                                     'price' => $cost,
                                                     'type' => 'ezsimpleshipping' )
                                              );
                $orderItem->store();
            }
        }
        return eZWorkflowType::STATUS_ACCEPTED;
    }
}

eZWorkflowEventType::registerEventType( eZSimpleShippingType::WORKFLOW_TYPE_STRING, "eZSimpleShippingType" );

?>