<?php
namespace AHT\Sales\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        // $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        // $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        // /** @var $attributeSet AttributeSet */
        // $attributeSet = $this->attributeSetFactory->create();
        // $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        // $customerSetup->addAttribute(Customer::ENTITY, 'is_sales_agent', [
        //     'type' => 'int',
        //     'backend' => '',
        //     'frontend' => '',
        //     'label' => 'Sales Agent',
        //     'input' => 'select',
        //     'class' => '',
        //     'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
        //     'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
        //     'visible' => true,
        //     'required' => true,
        //     'user_defined' => true,
        //     'default' => 0,
        //     'searchable' => true,
        //     'filterable' => true,
        //     'comparable' => true,
        //     'visible_on_front' => true,
        //     'sort_order' => 0,
        // ]);

        // $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'is_sales_agent')
        // ->addData([
        //     'attribute_set_id' => $attributeSetId,
        //     'attribute_group_id' => $attributeGroupId,
        //     'used_in_forms' => ['adminhtml_customer', 'adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'],//you can use other forms also ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address']
        // ]);
        // $attribute->save();

        //attribue Product
        $customerSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'sale_agent_id', [
            'group' => 'Product Sale Agent',
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 200,
            'label' => 'Sales Agent',
            'input' => 'select',
            'class' => '',
            'source' => 'AHT\Sales\Model\Sales\GetListCustomer',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'apply_to' => '',
        ]);

        //attribue Product
        $customerSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'commission_type',
            [
                'group' => 'Product Sale Agent',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Commission type',
                'input' => 'select',
                'class' => '',
                'source' => 'AHT\Sales\Model\Sales\CommissionType',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => '',
            ]
        );
        //attribue Product
        $customerSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'commission_value',
            [
                'group' => 'Product Sale Agent',
                'type' => 'decimal',
                'backend' => '',
                'frontend' => '',
                'label' => 'Commission value',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => '',
            ]
        );
    }
}
