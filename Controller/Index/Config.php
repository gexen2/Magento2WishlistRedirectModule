<?php
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
