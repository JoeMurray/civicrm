<?php

/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.0                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2011                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2011
 * $Id$
 *
 */

require_once 'CRM/Report/Form.php';
require_once 'CRM/Contribute/PseudoConstant.php';
require_once 'CRM/Report/Form/Price/Lineitem.php';

class CRM_Report_Form_Price_Lineitemdatetime extends CRM_Report_Form_Price_Lineitem {
    protected $_addressField = false;

    protected $_emailField   = false;

    protected $_summary      = null;

    protected $_customGroupExtends = array( 'Contribution' );
    
    protected $_baseTable = 'civicrm_line_item';
    
    protected $_aclTable = 'civicrm_contact';
    
    function __construct() {

        $this->_columns = $this->getContactColumns()
   
                        + $this->getLineItemColumns()    
                        + $this->getPriceFieldValueColumns()
                        + $this->getPriceFieldColumns()
                        + $this->getParticipantColumns()
                        + $this->getEventColumns()
                        + $this->getContributionColumns()  
     
                        ;

        parent::__construct( );
    }

    function preProcess( ) {
        parent::preProcess( );
    }

    function select( ) {
        parent::select( ); }
  

    function groupBy( ) {
       parent::groupBy();
       
    }

    function orderBy( ) {
       parent::orderBy();
    }

    function statistics( &$rows ) {
        return parent::statistics( $rows );
    }

    function postProcess( ) {
      
      parent::postProcess( );
    }

    function alterDisplay( &$rows ) {
       parent::alterDisplay($rows);
       
    }
    function addDateRange( $name, $label = 'From:', $dateFormat = 'searchDate', $required = false ) {
        $this->addDateTime( $name . '_from', $label   , $required, array( 'formatType' => $dateFormat ) ); 
        $this->addDateTime( $name . '_to'  , ts('To:'), $required, array( 'formatType' => $dateFormat ) ); 
    }
}