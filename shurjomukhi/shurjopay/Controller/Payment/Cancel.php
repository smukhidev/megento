<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace shurjomukhi\shurjopay\Controller\Payment;
use Magento\Framework\Controller\ResultFactory;

/**
 * Responsible for loading page content.
 *
 * This is a basic controller that only loads the corresponding layout file. It may duplicate other such
 * controllers, and thus it is considered tech debt. This code duplication will be resolved in future releases.
 */
class Cancel extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * Load the page defined in view/frontend/layout/samplenewpage_index_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {   
        $paymentMethod = $this->_objectManager->create('shurjomukhi\shurjopay\Model\Shurjopay');
        $paymentMethod->errorAction();
        
        $mail = $this->_objectManager->create('shurjomukhi\shurjopay\Controller\Payment\Sendemail');
        // $mail->CancelEmail();
        $whitelist = array('127.0.0.1','::1');
        if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
		    $mail->CancelEmail();
		}

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('checkout/onepage/failure', ['_secure' => true]);
    }
}