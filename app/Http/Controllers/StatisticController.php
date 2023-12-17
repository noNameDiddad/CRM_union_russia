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


        $format = json_decode($format->format, true);
        // return $query;
        $result = [];
        $i = 0;
        foreach ($query as $item) {
            foreach ($format as $f => $fValue) {
                if (isset($fValue['GROUP_TITLE'])) {
                    foreach ($fValue as $row => $val) {
                        if ($row !== 'GROUP_TITLE') {
                            if ($item[$fValue['GROUP_TITLE']]) {
                                if (isset($item[$fValue['GROUP_TITLE']][$val]))
                                    foreach ($item[$fValue['GROUP_TITLE']] as $refM) {
                                        $result[$i][$f][$row] = isset($item[$fValue['GROUP_TITLE']][$val]['value']) ? $item[$fValue['GROUP_TITLE']][$val]['value'] : $item[$fValue['GROUP_TITLE']][$val];
                                    } else {
                                    $x = 0;
                                    foreach ($item[$fValue['GROUP_TITLE']] as $refM) {
                                        $result[$i][$f][$x][$row] = $refM[$val];
                                        $x++;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if (is_string($fValue)) {
                        $result[$i][$f] = $item[$fValue];
                    } else {
                        foreach ($fValue as $row => $val) {
                            if (isset($item[$val]['id'])) {
                                $result[$i][$f][$row] = $item[$val]['id'];
                            } else {
                                $result[$i][$f][$row] = $item[$val];
                            }
                            //
                        }
                    }
                }

            }
            $i++;
        }

        return response()->json($result);
    }

}
