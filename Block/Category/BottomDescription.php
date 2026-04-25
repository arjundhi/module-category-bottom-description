<?php
declare(strict_types=1);

namespace MageMatch\CategoryBottomDescription\Block\Category;

use Magento\Catalog\Model\Category;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class BottomDescription extends Template
{
    private Registry $registry;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }

    public function getCurrentCategory(): ?Category
    {
        $category = $this->registry->registry('current_category');

        return $category instanceof Category ? $category : null;
    }

    public function getBottomDescriptionHtml(): string
    {
        $category = $this->getCurrentCategory();

        if ($category === null) {
            return '';
        }

        $content = (string) $category->getData('bottom_description');

        return trim($content);
    }

    public function canRender(): bool
    {
        return $this->getBottomDescriptionHtml() !== '';
    }
}
