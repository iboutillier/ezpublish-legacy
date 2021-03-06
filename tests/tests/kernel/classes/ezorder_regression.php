<?php
/**
 * File containing the eZOrderRegression class
 *
 * @copyright Copyright (C) 1999-2014 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPLv2
 * @package tests
 */

class eZOrderRegression extends ezpDatabaseTestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->setName( "eZOrder Regression Tests" );
    }

    public function testIssue18233()
    {
        // insert orders
        $orderData = array( 'account_identifier' => 'ez',
                            'created' => 130252369,
                            'data_text_1' => '\<?xml ?\>',
                            'email' => 'xc@ez.no',
                            'productcollection_id' => '5',
                            'status_modifier_id' => '14',
                            'user_id' => 14 );
        $order = new eZOrder( $orderData );
        $order->store();
        $oldOrderNR = $order->attribute( 'order_nr' );
        $order->activate();
        $this->assertEquals( $oldOrderNR+1, $order->attribute( 'id' ) );
        $this->assertEquals( 0, $order->attribute( 'is_temporary' ) );
    }

}
?>
