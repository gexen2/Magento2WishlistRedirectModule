<?php

namespace Crealevant\AddToWishlistNotRedirect\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

  //protected $_scopeConfig;
  const XML_PATH_WISHLISTREDIRECT = 'wishlist/general/redirect';

  public function getConfigValue($field, $storeId = null)
  {
    return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeId);
  }

  public function getWishlistRedirectConfigValue($storeId = null)
  {
    return $this->getConfigValue(self::XML_PATH_WISHLISTREDIRECT, $storeId);
  }
/*
  public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
  {
    $this->_scopeConfig = $scopeConfig;
  }
  //return $this->_scopeConfig->getValue("wishlist/general/redirect",
  //\Magento\Store\Model\ScopeInterface::SCOPE_STORE
  //);

  //const $wishlistRedirectPath = "wishlist/general/redirect";

  public function getWishlistRedirectConfigValue()
  {
    $wishlistconfigValue = $this->_scopeConfig->getValue('wishlist/general/redirect', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    //return $wishlistconfigValue;
    //return $_scopeConfig;
    //return $this->scopeConfig->getValue($wishlistRedirectPath,
    //\Magento\Store\Model\ScopeInterface::SCOPE_STORE
  //);
  }
*/
  //echo $this->scopeConfig->getValue($wishlistRedirectPath, $storeScope);
}

/*
  public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
  {
    $this->_scopeConfig = $scopeConfig;
  }
  echo $this->scopeConfig->getValue($wishlistRedirectPath, $storeScope);
}
// https://www.mageplaza.com/magento-2-module-development/create-system-xml-configuration-magento-2.html

//https://firebearstudio.com/blog/how-to-add-magento-2-system-configuration-fields-get-core-config-data-programmatically.html
