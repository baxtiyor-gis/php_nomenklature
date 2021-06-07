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
            if ($this->lat >= $i && $this->lat <= $i + 4) {
                $lat1 = $i;
            }
        }

        $long1 = '';
        for ($i = 0; $i < 180; $i += 6) {
            if ($this->long >= $i && $this->long <= $i + 6) {
                $long1 = $i;
            }
        }

        return [
            'masshtab' => '1:1000 000',
            'nomenklatura' => $letter . ' - ' . $m,
            'latitude' => [
                'start' => $lat1,
                'end' => $lat1 + 4,
            ],
            'longitude' => [
                'start' => $long1,
                'end' => $long1 + 6,
            ]
        ];
    }



    public function five_hundred()
    {
        $degree_lat = $this->lat;
        $degree_long = $this->long;
        $lat1 = $long1  = $num = '';
        $lat_start = $this->zone()['latitude']['start'];
        $lat_end = $this->zone()['latitude']['end'];
        $long_start = $this->zone()['longitude']['start'];
        $long_end = $this->zone()['longitude']['end'];


        if (($degree_lat > $lat_start) && ($degree_lat < $lat_start + 2)) {
            $lat1 = $lat_start;
            if (($degree_long > $long_start) && ($degree_long < $long_start + 3)) {
                $long1 = $long_start;
                $num = 'B';
            } else {
                $long1 = $long_end - 3;
                $num = 'Г';
            }
        }



        if (($degree_lat > $lat_start + 2) && ($degree_lat < $lat_end)) {
            $lat1 = $lat_start + 2;

            if (($degree_long > $long_start) && ($degree_long < $long_start + 3)) {
                $long1 = $long_start;
                $num = 'A';
            } else {
                $long1 = $long_end - 3;
                $num = 'Б';
            }
        }


        return [
            'masshtab' => '1:500 000',
            'nomenklatura' => $this->zone()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $lat1,
                'end' => $lat1 + 2,
            ],
            'longitude' => [
                'start' => $long1,
                'end' => $long1 + 3,
            ]
        ];
    }

    public function three_hundred()
    {
        $degree_lat = $this->lat;
        $degree_long = $this->long;
        $lat1 = $long1  = $num = '';
        $dlat = 1 + (20 / 60);
        $dlong = 2;
        $lat_start = $this->zone()['latitude']['start'];
        $lat_end = $this->zone()['latitude']['end'];
        $long_start = $this->zone()['longitude']['start'];
        $long_end = $this->zone()['longitude']['end'];


        if (($degree_lat > $lat_start) && ($degree_lat < $lat_start + $dlat)) {
            $lat1 = $lat_start;
            if (($degree_long > $long_start) && ($degree_long < $long_start + 2)) {
                $long1 = $long_start;
                $num = 'VI';
            }
            if (($degree_long > $long_start + 2) && ($degree_long < $long_end - 2)) {
                $long1 = $long_start + 2;
                $num = 'VII';
            }
            if (($degree_long > $long_end - 2) && ($degree_long < $long_end)) {
                $long1 = $long_start + 2;
                $num = 'VII';
            }
        }
        if (($degree_lat > $lat_start + $dlat) && ($degree_lat < $lat_end - $dlat)) {
            $lat1 = $lat_start + $dlat;
            if (($degree_long > $long_start) && ($degree_long < $long_start + 2)) {
                $long1 = $long_start;
                $num = 'IV';
            }
            if (($degree_long > $long_start + 2) && ($degree_long < $long_end - 2)) {
                $long1 = $long_start + 2;
                $num = 'V';
            }
            if (($degree_long > $long_end - 2) && ($degree_long < $long_end)) {
                $long1 = $long_end - 2;
                $num = 'VI';
            }
        }
        if (($degree_lat > $lat_end - $dlat) && ($degree_lat < $lat_end)) {
            $lat1 = $lat_end - $dlat;
            if (($degree_long > $long_start) && ($degree_long < $long_start + 2)) {
                $long1 = $long_start;
                $num = 'I';
            }
            if (($degree_long > $long_start + 2) && ($degree_long < $long_end - 2)) {
                $long1 = $long_start + 2;
                $num = 'II';
            }
            if (($degree_long > $long_end - 2) && ($degree_long < $long_end)) {
                $long1 = $long_end - 2;
                $num = 'III';
            }
        }




        return [
            'masshtab' => '1:300 000',
            'nomenklatura' => $this->zone()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $lat1,
                'end' => $lat1 + $dlat,
            ],
            'longitude' => [
                'start' => $long1,
                'end' => $long1 + 2,
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
