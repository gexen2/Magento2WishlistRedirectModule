<?php
namespace Crealevant\AddToWishlistNotRedirect\Controller\Index;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Controller\ResultFactory;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Add extends \Magento\Wishlist\Controller\AbstractIndex
{
    /**
     * @var \Magento\Wishlist\Controller\WishlistProviderInterface
     */
    protected $wishlistProvider;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var Validator
     */
    protected $formKeyValidator;

    /**
     * @param Action\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Wishlist\Controller\WishlistProviderInterface $wishlistProvider
     * @param ProductRepositoryInterface $productRepository
     * @param Validator $formKeyValidator
     */
    public function __construct(
        Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Wishlist\Controller\WishlistProviderInterface $wishlistProvider,
        //Gets helper (custom code) --->
        \Crealevant\AddToWishlistNotRedirect\Helper\Data $helperData,
        ProductRepositoryInterface $productRepository,
        Validator $formKeyValidator
    ) {
        $this->_customerSession = $customerSession;
        $this->wishlistProvider = $wishlistProvider;
        // Assign helper to $helperData variable (custom code) ---->
        $this->helperData = $helperData;
        $this->productRepository = $productRepository;
        $this->formKeyValidator = $formKeyValidator;
        parent::__construct($context);
    }

    /**
     * Adding new item
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     * @throws NotFoundException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            return $resultRedirect->setPath('*/');
        }

        $wishlist = $this->wishlistProvider->getWishlist();
        if (!$wishlist) {
            throw new NotFoundException(__('Page not found.'));
        }

        $session = $this->_customerSession;

        $requestParams = $this->getRequest()->getParams();

        if ($session->getBeforeWishlistRequest()) {
            $requestParams = $session->getBeforeWishlistRequest();
            $session->unsBeforeWishlistRequest();
        }

        $productId = isset($requestParams['product']) ? (int)$requestParams['product'] : null;
        if (!$productId) {
            $resultRedirect->setPath('*/');
            return $resultRedirect;
        }

        try {
            $product = $this->productRepository->getById($productId);
        } catch (NoSuchEntityException $e) {
            $product = null;
        }

        if (!$product || !$product->isVisibleInCatalog()) {
            $this->messageManager->addErrorMessage(__('We can\'t specify a product.'));
            $resultRedirect->setPath('*/');
            return $resultRedirect;
        }

        try {
            $buyRequest = new \Magento\Framework\DataObject($requestParams);

            $result = $wishlist->addNewItem($product, $buyRequest);
            if (is_string($result)) {
                throw new \Magento\Framework\Exception\LocalizedException(__($result));
            }
            if ($wishlist->isObjectNew()) {
                $wishlist->save();
            }
            $this->_eventManager->dispatch(
                'wishlist_add_product',
                ['wishlist' => $wishlist, 'product' => $product, 'item' => $result]
            );

            $referer = $session->getBeforeWishlistUrl();
            if ($referer) {
                $session->setBeforeWishlistUrl(null);
            } else {
                $referer = $this->_redirect->getRefererUrl();
            }

            $this->_objectManager->get(\Magento\Wishlist\Helper\Data::class)->calculate();

            $this->messageManager->addComplexSuccessMessage(
                'addProductSuccessMessage',
                [
                    'product_name' => $product->getName(),
                    'referer' => $referer
                ]
            );
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage(
                __('We can\'t add the item to Wish List right now: %1.', $e->getMessage())
            );
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('We can\'t add the item to Wish List right now.')
            );
        }
        // <---- All code above is vendor/magento/module-wishlist/Controller/Index/Add.php
        // unless otherwise specified

        // -----> Uses getConfig method inside helper
        // located in Crealevant/AddToWishlistNotRedirect/Helper/Data.php

        // Config path is defined in Crealevant/AddToWishlistNotRedirect/etc/adminhtml/system.xml
        // with convention section/group/field

        // Checks if config value in config path crealevantWishlist/crealevantGeneral/wishlistRedirect is 0
        // Config value is located in "core_config_data"-table in database
        if($this->helperData->getConfig('crealevantWishlist/crealevantGeneral/wishlistRedirect') == 0)
        {
          //Redirects to wishlist page (Default Magento behaviour)
          $resultRedirect->setPath('*', ['wishlist_id' => $wishlist->getId()]);
          return $resultRedirect;
        }
        // Checks if config value in config path wishlist/general/redirect is 1
        elseif ($this->helperData->getConfig('crealevantWishlist/crealevantGeneral/wishlistRedirect') == 1)
        {
          //No redirect (Modified behaviour)
          $resultRedirect->setUrl($this->_redirect->getRefererUrl());
          return $resultRedirect;
        }
    }
}
