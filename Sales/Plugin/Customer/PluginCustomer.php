<?php
namespace AHT\Sales\Plugin\Customer;

class PluginCustomer
{   
    // public function beforGetFirstname(\Magento\Customer\Model\Data\Customer $subject, $result)
    // {
    //     if($subject->getCustomAttribute("is_sales_agent")) {
    //         if($subject->getCustomAttribute("is_sales_agent")->getValue() == 1)
    //         {
    //             $result = str_replace("SA:")
    //         }
    //     }
    // }

    public function afterGetFirstname(\Magento\Customer\Model\Data\Customer $subject, $result)
    {
        if($subject->getCustomAttribute("is_sales_agent")) {
            return $subject->getCustomAttribute("is_sales_agent")->getValue() == 1?"SA:".$result:$result;
        }
    }
}