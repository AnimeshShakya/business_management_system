<?php

namespace Modules\AI\Services;



use Modules\CategoryManagement\Entities\Category;
use Modules\ZoneManagement\Entities\Zone;

class ProductResourceService
{
    protected Category $category;
    protected Zone $zone;

    public function __construct()
    {
        $this->category = new Category();
        $this->zone = new Zone();
    }

    private function getCategoryEntityData($position = 1)
    {
        return $this->category
            ->where(['position' => $position])
            ->get(['id', 'name'])
            ->mapWithKeys(fn($item) => [strtolower($item->name) => $item->id])
            ->toArray();
    }

    private function getZoneEntityData()
    {
        return $this->zone
            ->get(['id', 'name'])
            ->mapWithKeys(fn($item) => [strtolower($item->name) => $item->id])
            ->toArray();
    }


    public function productGeneralSetupData(): array
    {
        $data = [
            'categories' => $this->getCategoryEntityData(1),
            'sub_categories' => $this->getCategoryEntityData(2),
        ];
        return $data;
    }

    public function getVariationData($category_id): array
    {
        $category = Category::with('zones')->find($category_id);

        return [
            'zones' => $category
                ? $category->zones->map(fn($z) => ['id' => $z->id, 'name' => $z->name])->toArray()
                : [],
        ];
    }


}
