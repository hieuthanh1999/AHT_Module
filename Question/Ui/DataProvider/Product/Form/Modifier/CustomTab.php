<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Ui\DataProvider\Product\Form\Modifier;

/**
 * Class order
 */
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form;
use Magento\Framework\UrlInterface;
use Magento\Framework\Module\Manager as ModuleManager;
use Magento\Framework\App\ObjectManager;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Fieldset;
/**
 * order modifier for catalog product form
 *
 * @api
 * @since 100.1.0
 */
class CustomTab extends AbstractModifier
{
    const GROUP_order = 'order';
    const GROUP_CONTENT = 'content';
    const DATA_SCOPE_order = 'grouped';
    const SORT_ORDER = 20;
    const LINK_TYPE = 'associated';

    /**
     * @var LocatorInterface
     * @since 100.1.0
     */
    protected $locator;

    /**
     * @var UrlInterface
     * @since 100.1.0
     */
    protected $urlBuilder;

    /**
     * @var ModuleManager
     */
    private $moduleManager;

    /**
     * @param LocatorInterface $locator
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        LocatorInterface $locator,
        UrlInterface $urlBuilder
    ) {
        $this->locator = $locator;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @inheritdoc
     * @since 100.1.0
     */
    public function modifyMeta(array $meta)
    {
        $meta['test_fieldset_name'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Label For Fieldset'),
                        'sortOrder' => 50,
                        'collapsible' => true,
                        'componentType' => Fieldset::NAME
                    ]
                ]
            ],
            'children' => [
                'sales_order_grid' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'autoRender' => true,
                                'componentType' => 'insertListing',
                                'dataScope' => 'sales_order_grid',
                                'externalProvider' => 'sales_order_grid.sales_order_grid_data_source',
                                'selectionsProvider' => 'sales_order_grid.sales_order_grid.product_columns.ids',
                                'ns' => 'sales_order_grid',
                                'render_url' => $this->urlBuilder->getUrl('mui/index/render'),
                                'realTimeLink' => false,
                                'behaviourType' => 'simple',
                                'externalFilterMode' => true,
                                'imports' => [
                                    'productId' => '${ $.provider }:data.product.current_product_id'
                                ],
                                'exports' => [
                                    'productId' => '${ $.externalProvider }:params.current_product_id'
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ];

        return $meta;
    }

    /**
     * @inheritdoc
     * @since 100.1.0
     */
    public function modifyData(array $data)
    {
        // $productId = $this->locator->getProduct()->getId();

        // $data[$productId][self::DATA_SOURCE_DEFAULT]['current_product_id'] = $productId;

        return $data;
    }
}