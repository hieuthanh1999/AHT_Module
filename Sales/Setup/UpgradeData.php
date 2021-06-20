<?php

namespace AHT\Sales\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{

    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {

        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        if (version_compare($context->getVersion(), '1.0.5') < 0) {

            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_sales_agent', [
                'type' => 'int',
                'label' => 'Sales Agent',
                'input' => 'select',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'required' => true,
                'visible' => true,
                'position' => 333,
                'default' => 0,
                'system' => false,
                'backend' => '',
                'sort_order' => 1,
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'is_sales_agent')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit',
                ],
                ]);
            $attribute->save();
        }

            $setup->endSetup();
    }
}