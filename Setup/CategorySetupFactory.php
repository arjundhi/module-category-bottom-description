<?php
declare(strict_types=1);

namespace Rameera\CategoryBottomDescription\Setup;

use Magento\Catalog\Setup\CategorySetup;
use Magento\Framework\ObjectManagerInterface;

class CategorySetupFactory
{
    private ObjectManagerInterface $objectManager;

    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create(array $data = []): CategorySetup
    {
        return $this->objectManager->create(CategorySetup::class, $data);
    }
}