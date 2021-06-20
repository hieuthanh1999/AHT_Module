<?php

namespace AHT\CustomerAttribute\Setup;

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


        if (version_compare($context->getVersion(), '1.0.6') < 0) {

          $customerSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'organization_name',
                [
                    'group' => 'Customer Attribute',
                    'type'         => 'varchar',
                    'label'        => 'Organization Name',
                    'input'        => 'text',
                    'required'     => false,
                    'visible'      => true,
                    'user_defined' => true,
                    'position'     => 999,
                    'system'       => 0,
                ]
            );
            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'organization_name');
            $attribute->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit',
                ],
                ]);
            $attribute->save();
        }
        

        
        if (version_compare($context->getVersion(), '1.0.7') < 0) {

            $customerSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'contact_phone_number',
                [
                    'group'        => 'Customer Attribute',
                    'type'         => 'varchar',
                    'label'        => 'Contact Phone Number',
                    'input'        => 'text',
                    'required'     => false,
                    'visible'      => true,
                    'user_defined' => true,
                    'position'     => 999,
                    'system'       => 0,
                ]
            );
            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'contact_phone_number');
            $attribute->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit',
                ],
                ]);
            $attribute->save();

          }


          if (version_compare($context->getVersion(), '1.0.9') < 0) {
            $customerSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'company_type',
                [
                    'group'        => 'Customer Attribute',
                    'type'         => 'varchar',
                    'label'        => 'Company Type',
                    'input'        => 'select',
                    'source'       => 'AHT\CustomerAttribute\Model\Source\CompanyType',
                    'required'     => false,
                    'visible'      => true,
                    'user_defined' => true,
                    'position'     => 999,
                    'system'       => 0,
                ]
            );
            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'company_type');
            $attribute->addData(['used_in_forms' => [
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