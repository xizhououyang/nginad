<?php
/**
 * NGINAD Project
 *
 * @link http://www.nginad.com
 * @copyright Copyright (c) 2013-2016 NginAd Foundation. All Rights Reserved
 * @license GPLv3
 */

namespace buyrtbfidelity\workflows;

class DisplayWorkflow
{
    public function process_business_rules_workflow(&$Logger, &$ParentWorkflow, \model\openrtb\RtbBidRequest &$RtbBidRequest, &$RtbBidRequestImp, &$InsertionOrderLineItem, &$InsertionOrderLineItemRestrictionsFactory) {

    	// Check banner type: FIDELITY SPECIFIC REQUIREMENT
    	if (\buyrtbfidelity\workflows\tasklets\display\insertionorderlineitem\CheckIsCorrectType::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem) === false):
    		return false;
    	endif;
    	
    	// Check banner height and width match
    	if (\buyrtbfidelity\workflows\tasklets\display\insertionorderlineitem\CheckDisplayBannerDimensions::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem) === false):
    		return false;
    	endif;
    	 
    	// Check is mobile web, phone, tablet, native iOS or native Android
    	if (\buyrtbfidelity\workflows\tasklets\display\insertionorderlineitem\CheckIsMobile::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem) === false):
    		return false;
    	endif;
    	 
    	// Check banner restrictions
    	if (\buyrtbfidelity\workflows\tasklets\display\insertionorderlineitem\BannerRestrictionsWorkflow::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictionsFactory) === false):
    		return false;
    	endif;
    	
    	return true;
    	
    }


}
