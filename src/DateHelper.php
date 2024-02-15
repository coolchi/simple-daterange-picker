<?php

namespace Coolchi\Daterangepicker;

use Illuminate\Support\Carbon;

class DateHelper
{
    const TODAY = 'TODAY';

    const YESTERDAY = 'YESTERDAY';

    const LAST_2_DAYS = 'LAST_2_DAYS';

    const LAST_7_DAYS = 'LAST_7_DAYS';

    const THIS_WEEK = 'THIS_WEEK';

    const LAST_WEEK = 'LAST_WEEK';

    const LAST_30_DAYS = 'LAST_30_DAYS';

    const THIS_MONTH = 'THIS_MONTH';

    const LAST_MONTH = 'LAST_MONTH';

    const LAST_6_MONTHS = 'LAST_6_MONTHS';

    const THIS_YEAR = 'THIS_YEAR';

    const LAST_YEAR = 'LAST_YEAR';

    const LAST_2_YEARS = 'LAST_2_YEARS';

    const LAST_3_YEARS = 'LAST_3_YEARS';

    const LAST_5_YEARS = 'LAST_5_YEARS';

    const LAST_10_YEARS = 'LAST_10_YEARS';

    const ALL_TIME = 'ALL_TIME';

    public static function getParsedDatesGroupedRanges($value): array
    {
        $start = Carbon::now()->setTime(0, 0, 0);
        $end = $start->clone()->setTime(23, 59, 59);

        switch ($value) {
            case 'TODAY':
                break;
            case 'YESTERDAY':
                $start->subDay(1);
                $end = $start->clone()->setTime(23, 59, 59);
                break;
            case 'LAST_2_DAYS':
                $start->subDays(1);
                break;
            case 'LAST_7_DAYS':
                $start->subDays(6);
                break;
            case 'THIS_WEEK':
                $start->startOfWeek(Carbon::MONDAY);
                break;
            case 'LAST_WEEK':
                $start->startOfWeek(Carbon::MONDAY)->subWeek(1);
                $end = $start->clone()->endOfWeek(Carbon::SUNDAY);
                break;
            case 'LAST_30_DAYS':
                $start->subDays(30);
                break;
            case 'THIS_MONTH':
                $start->startOfMonth();
                break;
            case 'LAST_MONTH':
                $start->startOfMonth()->subMonth();
                $end = $start->clone()->endOfMonth();
                break;
            case 'LAST_6_MONTHS':
                $start->subMonths(6);
                break;
            case 'THIS_YEAR':
                $start->startOfYear();
                break;
            case 'LAST_YEAR':
                $start->startOfYear()->subYear();
                $end = $start->clone()->endOfYear();
                break;
            case 'LAST_2_YEARS':
                $start->subYears(2);
                break;
            case 'LAST_3_YEARS':
                $start->subYears(3);
                break;
            case 'LAST_5_YEARS':
                $start->subYears(5);
                break;  
            case 'LAST_10_YEARS':
                $start->subYears(10);
                break;
            case 'ALL_TIME':
                break;
            default:
                //Ex. 2020-06-15 to 2023-06-15
                $parsed = explode(' to ', $value);
                if (count($parsed) == 1) {
                    $start = Carbon::createFromFormat('Y-m-d', $value)->setTime(0, 0, 0);
                    $end = $start->clone()->setTime(23, 59, 59);
                } elseif (count($parsed) == 2) {
                    $start = Carbon::createFromFormat('Y-m-d', $parsed[0])->setTime(0, 0, 0);
                    $end = Carbon::createFromFormat('Y-m-d', $parsed[1])->setTime(23, 59, 59);
                }
        }

        return [
            $start,
            $end,
        ];
    }
}
