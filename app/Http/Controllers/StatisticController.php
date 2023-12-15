<?php

namespace App\Http\Controllers;

use App\Helpers\FormatterHelper;
use App\Http\Resources\EntityValueResource;
use App\Http\Resources\StatisticResource;
use App\Models\Entity;
use App\Models\StatisticFormat;
use App\Services\EntityValueService;

class StatisticController extends Controller
{

    public function getStatistics($action)
    {
        $format = StatisticFormat::where('action', $action)->first();

        $queryHelper = new FormatterHelper();
        $query = $queryHelper->getFormatted($format);

        // $format = StatisticFormat::where('action', $action)->first();
        // $entity = Entity::where('hash', $format->hash)->first();
        // $entity_table = "table_" . $format->hash;
        // $this->service = new EntityValueService($entity_table);

        // $format = json_decode($format->format, true);
        // $query = EntityValueResource::collection($this->service->getAllByEntity($entity));

        // $query = $query->toJson();
        // $query = json_decode($query, true);

        $result = [];
        $i = 0;
        foreach ($query as $item) {
            foreach ($format as $unit => $row) {
                if (isset($row['GROUP_TITLE'])) {
                    foreach ($row as $subUnit => $subUnitRow) {
                        if ($subUnit != 'GROUP_TITLE') {
                            $tmp = $item[$row['GROUP_TITLE']];
                            $result[$i][$unit][$subUnit] = $tmp[$subUnitRow];
                        }
                    }
                } else {
                    $result[$i][$unit] = $item[$row];
                }

            }
            $i++;
        }

        return response()->json($result);
    }

}
