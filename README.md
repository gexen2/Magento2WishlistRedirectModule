# Scripting conundrum: 
PHP doesn't allow multiple class inheritance. 
Add.php is based on Magento\Wishlist\Controller\Index\Add
Config.php needs to inherit from \Magento\Framework\App\Action\Action to work
Config.php needs access to $resultRedirect variable declared in Add.php to work as intended
WTF?
