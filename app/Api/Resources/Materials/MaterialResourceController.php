<?php

namespace App\Api\Resources\Materials;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class MaterialResourceController extends ResourceController
{
    protected static string $model = Material::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $materials = $this->getModelQueryInstance()->get();

        return $materials->map(
            fn (Material $material) => $this->present($request, $material),
        );
    }

    public function show(Request $request, Material $material): Data
    {
        return $this->present($request, $material);
    }

    public function filters(): array
    {
        return [
            'customer' => Filters\Customer::class,
			'Custom' => Filters\Custom::class,
        ];
    }

    public function presenters(): array
    {
        return [
            
        ];
    }
}
