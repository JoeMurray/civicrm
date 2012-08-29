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
require_once 'CRM/Report/Form/Extended.php';

class CRM_Report_Form_Price_Contributionbased extends CRM_Report_Form_Extended {

    protected $_baseTable = 'civicrm_contribution' ;

    function __construct( ) {

      $this->_columns = $this->getContactColumns()
      + $this->getContributionColumns()
      + $this->getPriceFieldColumns()
      + $this->getPriceFieldValueColumns()
      + $this->getLineItemColumns();
      parent::__construct( );
    }

    function fromClauses( ) {
      return array(
        'lineItem_from_contribution',
        'contact_from_contribution',
        'priceFieldValue_from_lineItem',
        'priceField_from_lineItem'
      );
    }

    function selectClause($tableName, $groupBys, $fieldName, $field){
      if($tableName == 'civicrm_contribution' && $fieldName == 'total_amount'){
        $stat = 'sum';
        $label = 'Total Amount';
        $this->_columnHeaders["{$tableName}_{$fieldName}_{$stat}"]['title'] = $label;
        $this->_columnHeaders["{$tableName}_{$fieldName}_{$stat}"]['type'] = $field['type'];
        return "sum(ifnull( line_item_civireport.line_total,contribution_civireport.total_amount)) as civicrm_contribution_total_amount_sum";
      }
    }
}

