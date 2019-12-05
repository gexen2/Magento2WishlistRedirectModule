<?php
namespace Crealevant\AddToWishlistNotRedirect\Controller\Index;

use Crealevant\AddToWishlistNotRedirect\Controller\Index\Add;

class Config extends \Magento\Framework\App\Action\Action
{
  //$helper = $this->helper('Crealevant\AddToWishlistNotRedirect\Helper\Data');
  //$wishlistRedirect = $helper->getConfig('wishlist/general/redirect');
  // Collects helper for use
  //$helperDataConf = $this->helper('Crealevant\AddToWishlistNotRedirect\Helper\Data');
  /*
  protected $helperData;

  function __construct(\Magento\Framework\App\Action\Context $context, \Crealevant\AddToWishlistNotRedirect\Helper\Data $helperData)
  {
    $this->helperData = $helperData;
    return parent::__construct($context);
  }
  */
  // Gets config value using helper. Stores config value in $wishlistRedirectConfigValue variable
  //$wishlistRedirectConfigValue = $helperData->getConfig('wishlist/general/redirect');
  public function execute()
  {
    // Checks if config value is 0
    //if($wishlistRedirectConfigValue == 0)
    /*
    if($this->helperData->getConfig('wishlist/general/redirect') == 0)
    {
      //Redirects to wishlist page
      $resultRedirect->setPath('*', ['wishlist_id' => $wishlist->getId()]);
      return $resultRedirect;
    }
    // Checks if config value is 1
    //elseif ($wishlistRedirectConfigValue == 1)
    elseif ($this->helperData->getConfig('wishlist/general/redirect') == 1)
    {
      //No redirect
      $resultRedirect->setUrl($this->_redirect->getRefererUrl());
      return $resultRedirect;
    }
    /*
    {
      //No redirect
      $resultRedirect->setUrl($this->_redirect->getRefererUrl());
      return $resultRedirect;
    }
    */
    // !!!!! IF ADDING MORE CONFIG OPTIONS IN THE FUTURE !!!!!!!
    // !!!!! CREATE NEW ELSE IF STATEMENTS WITH BEHAVIOUR HERE !!!!!!

    // If config value is greater then 1 or less then 0
    /*
    else
    {
      // Failsafe. Default Magento behaviour. Redirects to wishlist page.
      // Insurance that module doesn't crash and burn, if adding more config options in the future
      $resultRedirect->setPath('*', ['wishlist_id' => $wishlist->getId()]);
      return $resultRedirect;
    }
    */
  }
}

/*
namespace Crealevant\AddToWishlistNotRedirect\Controller\Index;

use Crealevant\AddToWishlistNotRedirect\Controller\Index\Add;

class Config extends \Magento\Framework\App\Action\Action
{
  protected $helperData;

  function __construct(\Magento\Framework\App\Action\Context $context, \Crealevant\AddToWishlistNotRedirect\Helper\Data $helperData)
  {
    $this->helperData = $helperData;
    return parent::__construct($context);
  }

  public function execute()
  {
    if($this->helperData->getWishlistRedirectConfigValue() == 0)
    {
      //Redirect
      $resultRedirect->setPath('*', ['wishlist_id' => $wishlist->getId()]);
      return $resultRedirect;
    }
    elseif ($this->helperData->getWishlistRedirectConfigValue() == 1)
    {
      //No redirect
      $resultRedirect->setUrl($this->_redirect->getRefererUrl());
      return $resultRedirect;
    }
    else
    {
      //Failsafe
    }
  }
}
*/
/*
namespace Crealevant\AddToWishlistNotRedirect\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{
	protected $helperData;
  protected $functionality;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
    \Crealevant\AddToWishlistNotRedirect\Helper\Data $helperData,
    \Crealevant\AddToWishlistNotRedirect\Controller\Index\Add $functionality
    )
	{
		$this->helperData = $helperData;
    $this->functionality = $functionality;
		return parent::__construct($context);
	}

	public function execute()
	{
		// TODO: Implement execute() method.
    $resultRedirect = $this->functionality->getResultRedirect();

		$configValue = $this->helperData->getWishlistRedirectConfigValue();

    if($configValue == 0)
    {
      $resultRedirect->setPath('*', ['wishlist_id' => $wishlist->getId()]);
      return $resultRedirect;
    }
    elseif ($configValue == 1)
    {
      $resultRedirect->setUrl($this->_redirect->getRefererUrl());
      return $resultRedirect;
    }
    else
    {
      return $resultRedirect;
    }
		exit();
	}
}
*/
// https://www.mageplaza.com/magento-2-module-development/create-system-xml-configuration-magento-2.html
