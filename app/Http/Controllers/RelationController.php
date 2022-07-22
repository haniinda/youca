<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Advservice;
use App\Models\Category;
use App\Models\Company;
use App\Models\Type;
use Illuminate\Http\Request;

/**
 * Class RelationController
 * @package App\Http\Controllers
 */
class RelationController extends Controller
{
    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function get_advs_for_service(int $id)
    {
        $adv = Advservice::query()->findOrFail($id);
        return $adv->adv;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function get_advs_for_category($id)
    {
        $cat = Category::query()->findOrFail($id);
        return $cat->adv;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function servicecategory($id)
    {
        $adv = Advservice::query()->findOrFail($id);
        return $adv->category;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function get_company_by_type($id)
    {
        $comp = Type::query()->findOrFail($id);
        return $comp->company;
    }
}
