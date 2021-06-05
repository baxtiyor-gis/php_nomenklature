<?php

class Nomenklatura
{
    public $lat;
    public $long;
    public $masshtab;



    public function zone()
    {
        $m = (int)($this->long / 6) + 31;
        $n = (int)($this->lat / 4) + 1;
        $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z'];
        $letter = '';
        for ($i = 0; $i < count($alphabet); $i++) {
            if ($i == $n - 1) {
                $letter = $alphabet[$i];
                break;
            }
        }
        $l = (int)$this->lat;
        $l1 = (int)$this->long;
        $lat1 = '';
        for ($i = 0; $i < 90; $i += 4) {
            if ($l > $i && $l <= $i + 4) {
                $lat1 = $i;
            }
        }
        
        // for ($i = 0; $i < 180; $i += $dlong) {
        //     if ($degree_long > $i && $degree_long <= $i + $dlong) {
        //         $long1 = $i;
        //         $long2 = $dlong;
        //     }
        // }
        return [
            'masshtab' => '1:1000 000',
            'nomenklatura' => $letter . ' - ' . $m,
            'latitude' => [
                'start' => $l,
                'end' => $l + 4,
            ],
            'longitude' => [
                'start' => $l1,
                'end' => $l1 + 6,
            ]
        ];
    }



    public function five_hundred()
    {
        $degree_lat = (int) $this->lat;
        $degree_long = (int) $this->long;
        $dlat = 2;
        $dlong = 3;
        $lat1 = $lat2 = $long1 = $long2 = $num = '';
        $lat_start = $this->zone()['latitude']['start'];
        $lat_end = $this->zone()['latitude']['end'];
        $long_start = $this->zone()['longitude']['start'];
        $long_end = $this->zone()['longitude']['end'];

        if (($degree_lat > $lat_start) && ($degree_lat < $lat_start + 2)) {

            $lat1 = $lat_start;
            $lat2 = $lat1 + 2;
            $num = 'A';
        }

        if (($degree_lat > $lat_start + 2) && ($degree_lat < $lat_end)) {

            $lat1 = $lat_start;
            $lat2 = $lat1 + 2;
            $num = 'B';
        }


        return [
            'masshtab' => '1:500 000',
            'nomenklatura' => $this->zone()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $lat_start,
                'end' => $lat_end,
            ],
            'longitude' => [
                'start' => 1,
                'end' => 1,
            ]
        ];
    }

    public function hundred()
    {
        $degree_lat = (int) $this->lat;
        $degree_long = (int) $this->long;
        $dlat = 4;
        $dlong = 6;
        $lat1 = $lat2 = $long1 = $long2 = '';

        for ($i = 0; $i < 90; $i += $dlat) {
            if ($degree_lat > $i && $degree_lat <= $i + $dlat) {
                $lat1 = $i;
                $lat2 = $dlat;
            }
        }

        for ($i = 0; $i < 180; $i += $dlong) {
            if ($degree_long > $i && $degree_long <= $i + $dlong) {
                $long1 = $i;
                $long2 = $dlong;
            }
        }

        $l = (int)($this->lat - $lat1) / (20 / 60) + 1;
        $l1 = (int)($this->long - $long1) / (30 / 60) + 1;
        $num = (12 - $l) * 12 + $l1;
        return [
            'masshtab' => '1:100 000',
            'nomenklatura' => $this->zone() . ' - ' . $num,
            'latitude' => [
                'start' => $lat1 + (($l - 1) * 20 / 60),
                'end' => $lat1 + ($l * 20 / 60),
            ],
            'longitude' => [
                'start' => $long1 + (($l1 - 1) * 30 / 60),
                'end' => $long1 + ($l * 30 / 60),
            ]
        ];
    }
}
