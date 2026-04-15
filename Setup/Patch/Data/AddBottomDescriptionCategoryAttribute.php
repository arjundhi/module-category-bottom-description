<?php
declare(strict_types=1);

namespace Rameera\CategoryBottomDescription\Setup\Patch\Data;

use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Rameera\CategoryBottomDescription\Setup\CategorySetupFactory;

class AddBottomDescriptionCategoryAttribute implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;

    private CategorySetupFactory $categorySetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function apply(): self
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);
        $attributeCode = 'bottom_description';

        if ($eavSetup->getAttributeId(Category::ENTITY, $attributeCode)) {
            $eavSetup->updateAttribute(Category::ENTITY, $attributeCode, 'frontend_label', 'Bottom Description');
            $eavSetup->updateAttribute(Category::ENTITY, $attributeCode, 'is_wysiwyg_enabled', 1);
            $eavSetup->updateAttribute(Category::ENTITY, $attributeCode, 'is_html_allowed_on_front', 1);
            $eavSetup->updateAttribute(Category::ENTITY, $attributeCode, 'is_pagebuilder_enabled', 1);
            $eavSetup->updateAttribute(Category::ENTITY, $attributeCode, 'sort_order', 90);
            $eavSetup->updateAttribute(Category::ENTITY, $attributeCode, 'group', 'Content');
        } else {
            $eavSetup->addAttribute(
                Category::ENTITY,
                $attributeCode,
                [
                    'type' => 'text',
                    'label' => 'Bottom Description',
                    'input' => 'textarea',
                    'required' => false,
                    'sort_order' => 90,
                    'global' => ScopedAttributeInterface::SCOPE_STORE,
                    'visible' => true,
                    'wysiwyg_enabled' => true,
                    'is_wysiwyg_enabled' => true,
                    'is_html_allowed_on_front' => true,
                    'is_pagebuilder_enabled' => true,
                    'group' => 'Content',
                    'default' => ''
                ]
            );
        }

        $this->moduleDataSetup->getConnection()->endSetup();

        return $this;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
