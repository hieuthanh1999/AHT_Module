<?php
namespace AHT\ProductOrderGrid\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Framework\UrlInterface;

class CustomTab extends AbstractModifier
{

        /**
     * @var UrlInterface
     * @since 100.1.0
     */
    protected $urlBuilder;

      /**
     * @var LocatorInterface
     * @since 100.1.0
     */
    protected $locator;


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
    * @param array $meta
    *
    * @return array
    */
    public function modifyMeta(array $meta): array
    {
        $meta['test_fieldset_name'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Order'),
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
                                //'dataScope' => 'sales_order_grid',
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
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        $productId = $this->locator->getProduct()->getId();
        $data[$productId][self::DATA_SOURCE_DEFAULT]['current_product_id'] = $productId;
        return $data;
    }
}