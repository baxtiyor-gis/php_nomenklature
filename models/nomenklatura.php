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
        $degree_lat = $this->lat;
        $degree_long = $this->long;
        $dlat = 4;
        $dlong = 6;
        $lat1 = $long1  = $num =  '';

        for ($i = 0; $i < 90; $i += $dlat) {
            if ($degree_lat > $i && $degree_lat < $i + $dlat) {
                $lat1 = $i;
            }
        }

        for ($i = 0; $i < 180; $i += $dlong) {
            if ($degree_long > $i && $degree_long <= $i + $dlong) {
                $long1 = $i;
            }
        }

        $l = (int)($this->lat - $lat1) / (20 / 60) + 1;
        $l1 = (int)($this->long - $long1) / (30 / 60) + 1;
        $num = (12 - $l) * 12 + $l1;

        return [
            'masshtab' => '1:100 000',
            'nomenklatura' => $this->zone()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $lat1 + (($l - 1) * 20 / 60),
                'end' => $lat1 + ($l * (20 / 60))
            ],
            'longitude' => [
                'start' => $long1 + (($l1 - 1) * (30 / 60)),
                'end' => $long1 + $l1 * (30 / 60)
            ]
        ];
    }


    public function fifty()
    {
        $lat1 = $this->hundred()['latitude']['start'];
        $lat2 = $this->hundred()['latitude']['end'];
        $lat3 = ($lat1 + $lat2) / 2;
        $long1 = $this->hundred()['longitude']['start'];
        $long2 = $this->hundred()['longitude']['end'];
        $long3 = ($long1 + $long2) / 2;
        $num = $latStart = $longStart = '';

        if ($this->lat > $lat1 &&  $this->lat < $lat3) {
            $latStart = $lat1;
            if ($this->long > $long1 &&  $this->long < $long3) {
                $num = "В";
                $longStart = $long1;
            } else {
                $num = "Г";
                $longStart = $long3;
            }
        } else {
            $latStart = $lat3;
            if ($this->long > $long1 &&  $this->long < $long3) {
                $longStart = $long1;
                $num = "А";
            } else {
                $longStart = $long3;
                $num = "Б";
            }
        }



        return [
            'masshtab' => '1:50 000',
            'nomenklatura' => $this->hundred()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $latStart,
                'end' => $latStart + (10 / 60),
            ],
            'longitude' => [
                'start' => $longStart,
                'end' => $longStart + (15 / 60),
            ]
        ];
    }





    public function tventy_five()
    {
        $lat1 = $this->fifty()['latitude']['start'];
        $lat2 = $this->fifty()['latitude']['end'];
        $lat3 = ($lat1 + $lat2) / 2;
        $long1 = $this->fifty()['longitude']['start'];
        $long2 = $this->fifty()['longitude']['end'];
        $long3 = ($long1 + $long2) / 2;
        $num = $latStart = $longStart = '';

        if ($this->lat > $lat1 &&  $this->lat < $lat3) {
            $latStart = $lat1;
            if ($this->long > $long1 &&  $this->long < $long3) {
                $num = "в";
                $longStart = $long1;
            } else {
                $num = "г";
                $longStart = $long3;
            }
        } else {
            $latStart = $lat3;
            if ($this->long > $long1 &&  $this->long < $long3) {
                $longStart = $long1;
                $num = "а";
            } else {
                $longStart = $long3;
                $num = "б";
            }
        }



        return [
            'masshtab' => '1:25 000',
            'nomenklatura' => $this->fifty()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $latStart,
                'end' => $latStart + (5 / 60),
            ],
            'longitude' => [
                'start' => $longStart,
                'end' => $longStart + (7.5 / 60),
            ]
        ];
    }

    public function teen()
    {
        $lat1 = $this->tventy_five()['latitude']['start'];
        $lat2 = $this->tventy_five()['latitude']['end'];
        $lat3 = ($lat1 + $lat2) / 2;
        $long1 = $this->tventy_five()['longitude']['start'];
        $long2 = $this->tventy_five()['longitude']['end'];
        $long3 = ($long1 + $long2) / 2;
        $num = $latStart = $longStart = '';

        if ($this->lat > $lat1 &&  $this->lat < $lat3) {
            $latStart = $lat1;
            if ($this->long > $long1 &&  $this->long < $long3) {
                $num = "3";
                $longStart = $long1;
            } else {
                $num = "4";
                $longStart = $long3;
            }
        } else {
            $latStart = $lat3;
            if ($this->long > $long1 &&  $this->long < $long3) {
                $longStart = $long1;
                $num = "1";
            } else {
                $longStart = $long3;
                $num = "2";
            }
        }



        return [
            'masshtab' => '1:10 000',
            'nomenklatura' => $this->tventy_five()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $latStart,
                'end' => $latStart + (2.5 / 60),
            ],
            'longitude' => [
                'start' => $longStart,
                'end' => $longStart + (3.75 / 60),
            ]
        ];
    }

    public function five()
    {
        $lat1 = $this->teen()['latitude']['start'];
        $lat2 = $this->teen()['latitude']['end'];
        $lat3 = ($lat1 + $lat2) / 2;
        $long1 = $this->teen()['longitude']['start'];
        $long2 = $this->teen()['longitude']['end'];
        $long3 = ($long1 + $long2) / 2;
        $num = $latStart = $longStart = '';
        $dlat = (1 / 60) + (15 / 3600);
        $dlong = (1 / 60) + (52.5 / 3600);

        for ($i = $lat1; $i < $lat2; $i += $dlat) {
            if ($this->lat > $i && $this->lat < $i + $dlat) {
                $latStart = $i;
            }
        }

        for ($j = $long1; $j < $long2; $j += $dlong) {
            if ($this->long > $j && $this->long < $j + $dlong) {
                $longStart = $j;
            }
        }
        $row = (int)(($latStart - $lat1) / $dlat);
        $column = (int)(($longStart - $long1) / $dlong) + 1;

        $num = 241 - ($row * 16) + $column;




        return [
            'masshtab' => '1:10 000',
            'nomenklatura' => $this->hundred()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $latStart,
                'end' => $latStart + (2.5 / 60),
            ],
            'longitude' => [
                'start' => $longStart,
                'end' => $longStart + (3.75 / 60),
            ]
        ];
    }

    public function two()
    {
        $lat1 = $this->five()['latitude']['start'];
        $lat2 = $this->five()['latitude']['end'];

        $long1 = $this->five()['longitude']['start'];
        $long2 = $this->five()['longitude']['end'];

        $num = $latStart = $longStart = '';
        $dlat = (25 / 3600);
        $dlong = (37.5 / 3600);

        if ($this->lat > $lat1 &&  $this->lat < $lat1 + $dlat) {
            $latStart = $lat1;
            if ($this->long > $long1 &&  $this->long < $long1 + $dlong) {
                $num = "ж";
                $longStart = $long1;
            }
            if ($this->long > $long1 + $dlong &&  $this->long < $long2 - $dlong) {
                $num = "з";
                $longStart = $long1 + $dlong;
            }
            if ($this->long > $long1 + $dlong &&  $this->long < $long2 - $dlong) {
                $num = "и";
                $longStart = $long2 - $dlong;
            }
        }

        if ($this->lat > $lat1 + $dlong &&  $this->lat < $lat2 - $dlat) {
            $latStart = $lat1 + $dlat;
            if ($this->long > $long1 &&  $this->long < $long1 + $dlong) {
                $num = "г";
                $longStart = $long1;
            }
            if ($this->long > $long1 + $dlong &&  $this->long < $long2 - $dlong) {
                $num = "д";
                $longStart = $long1 + $dlong;
            }
            if ($this->long > $long1 + $dlong &&  $this->long < $long2 - $dlong) {
                $num = "е";
                $longStart = $long2 - $dlong;
            }
        }

        if ($this->lat > $lat2 - $dlong &&  $this->lat < $lat2) {
            $latStart = $lat2 - $dlat;
            if ($this->long > $long1 &&  $this->long < $long1 + $dlong) {
                $num = "а";
                $longStart = $long1;
            }
            if ($this->long > $long1 + $dlong &&  $this->long < $long2 - $dlong) {
                $num = "б";
                $longStart = $long1 + $dlong;
            }
            if ($this->long > $long1 + $dlong &&  $this->long < $long2 - $dlong) {
                $num = "в";
                $longStart = $long2 - $dlong;
            }
        }





        return [
            'masshtab' => '1:10 000',
            'nomenklatura' => $this->hundred()['nomenklatura'] . ' - ' . $num,
            'latitude' => [
                'start' => $latStart,
                'end' => $latStart + $dlat,
            ],
            'longitude' => [
                'start' => $longStart,
                'end' => $longStart + $dlong,
            ]
        ];
    }
}
